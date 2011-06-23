package br.uespi.bloum.activities;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.Date;

import br.uespi.bloum.R;
import br.uespi.bloum.graphics.LightingRenderer;
import br.uespi.bloum.graphics.Model3D;
import br.uespi.bloum.models.Model;
import br.uespi.bloum.parsers.ObjParser;
import br.uespi.bloum.parsers.ParseException;
import br.uespi.bloum.utils.AssetsFileUtil;
import br.uespi.bloum.utils.BaseFileUtil;

import android.app.ProgressDialog;
import android.content.res.Resources;
import android.graphics.Bitmap;
import android.graphics.Bitmap.CompressFormat;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.view.SurfaceHolder;
import android.view.View;
import android.view.View.OnTouchListener;
import android.widget.Toast;
import edu.dhbw.andar.ARToolkit;
import edu.dhbw.andar.AndARActivity;
import edu.dhbw.andar.exceptions.AndARException;

public class NavigateActivity extends AndARActivity implements
		SurfaceHolder.Callback {

	// Opções do menu
	private final int MENU_ROTATE = 0;
	private final int MENU_SCREENSHOT = 1;
	private final int MENU_POINT_LIST = 2;

	private int action = 3;
	
	private Model model;
	private Model3D model3d;
	private ProgressDialog waitDialog;
	private Resources res;

	ARToolkit artoolkit;

	public NavigateActivity() {
		super(false);
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		super.setNonARRenderer(new LightingRenderer());

		res = getResources();
		artoolkit = getArtoolkit();
		
		//configurando o novo listener de touch
		getSurfaceView().setOnTouchListener(new TouchEventHandler());
		//pegando o surfface da câmera
		getSurfaceView().getHolder().addCallback(this);
	}

	// Criando o menu de opções
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		menu.add(0, MENU_ROTATE, 0, res.getText(R.string.rotate)).setIcon(
				R.drawable.transform_rotate_icon);
		menu.add(0, MENU_SCREENSHOT, 0, res.getText(R.string.take_screenshot))
				.setIcon(R.drawable.screenshot_icon);
		menu.add(0, MENU_POINT_LIST, 0, res.getText(R.string.point_list))
				.setIcon(R.drawable.list_tree_icon);
		return true;
	}
	
	// Manipulando as seleções do menu
	public boolean onOptionsItemSelected(MenuItem item) {
		switch (item.getItemId()) {
		case MENU_ROTATE:
			action = MENU_ROTATE;
			return true;
		case MENU_SCREENSHOT:
			new TakeScreenshot().execute();
			return true;
		case MENU_POINT_LIST:
			//LISTAR OS PONTOS
			return true;
		}
		return false;
	}

	// Listener para manipular os toques na tela
	class TouchEventHandler implements OnTouchListener {

		private float lastX = 0;
		private float lastY = 0;

		@Override
		public boolean onTouch(View v, MotionEvent event) {
			if (model != null && action == MENU_ROTATE) {
				switch (event.getAction()) {
					// Action started
					default:
					case MotionEvent.ACTION_DOWN:
						lastX = event.getX();
						lastY = event.getY();
						break;
					// Action ongoing
					case MotionEvent.ACTION_MOVE:
						float dX = lastX - event.getX();
						float dY = lastY - event.getY();
						lastX = event.getX();
						lastY = event.getY();
						model.setXrot(-1 * dX);// dY-> Rotation um die
						// X-Achse
						model.setYrot(-1 * dY);// dX-> Rotation um die
						// Y-Achse
						break;
					// Action ended
					case MotionEvent.ACTION_CANCEL:
					case MotionEvent.ACTION_UP:
						lastX = event.getX();
						lastY = event.getY();
						break;
				}
			}
			return true;
		}
	}

	@Override
	public void surfaceCreated(SurfaceHolder holder) {
		super.surfaceCreated(holder);
		// carregar o modelo
		// para ter certeza que o surface foi criado, iniciamos um waitDialog
		// enquanto o modelo carrega
		if (model == null) {
			waitDialog = ProgressDialog.show(this, "", getResources().getText(
					R.string.loading), true);
			waitDialog.show();
			new ModelLoader().execute();
		}
	}

	// Informar o usuário de erro em operaão em alguma Thread em background
	@Override
	public void uncaughtException(Thread thread, Throwable ex) {
		System.out.println("");
	}

	// Thread que carrega o modelo e o seu material
	private class ModelLoader extends AsyncTask<Void, Void, Void> {

		@Override
		protected Void doInBackground(Void... params) {
			String modelFileName = "android.obj";
			BaseFileUtil fileUtil = null;
			fileUtil = new AssetsFileUtil(getResources().getAssets());
			fileUtil.setBaseFolder("models/");

			// read the model file:
			if (modelFileName.endsWith(".obj")) {
				ObjParser parser = new ObjParser(fileUtil);
				try {
					if (fileUtil != null) {
						BufferedReader fileReader = fileUtil
								.getReaderFromName(modelFileName);
						if (fileReader != null) {
							model = parser.parse("Model", fileReader);
							model3d = new Model3D(model);
						}
					}
				} catch (IOException e) {
					e.printStackTrace();
				} catch (ParseException e) {
					e.printStackTrace();
				}
			}
			return null;
		}

		@Override
		protected void onPostExecute(Void result) {
			super.onPostExecute(result);
			waitDialog.dismiss();

			// registrando o modelo
			try {
				if (model3d != null)
					artoolkit.registerARObject(model3d);
			} catch (AndARException e) {
				e.printStackTrace();
			}
			startPreview();
		}
	}

	// Thread que tira uma foto da tela
	class TakeScreenshot extends AsyncTask<Void, Void, Void> {

		private String errorMsg = null;

		@Override
		protected Void doInBackground(Void... params) {
			Bitmap bm = takeScreenshot();
			FileOutputStream fos;
			try {
				fos = new FileOutputStream("/sdcard/UESPImap/screenshots"
						+ new Date().getTime() + ".png");
				bm.compress(CompressFormat.PNG, 100, fos);
				fos.flush();
				fos.close();
			} catch (FileNotFoundException e) {
				errorMsg = e.getMessage();
				e.printStackTrace();
			} catch (IOException e) {
				errorMsg = e.getMessage();
				e.printStackTrace();
			}
			return null;
		}

		protected void onPostExecute(Void result) {
			if (errorMsg == null) {
				Toast.makeText(NavigateActivity.this,
						getResources().getText(R.string.screenshot_saved),
						Toast.LENGTH_SHORT).show();
			} else {
				Toast.makeText(
						NavigateActivity.this,
						getResources().getText(R.string.screenshot_failed)
								+ errorMsg, Toast.LENGTH_SHORT).show();
			}
		};
	}
}
