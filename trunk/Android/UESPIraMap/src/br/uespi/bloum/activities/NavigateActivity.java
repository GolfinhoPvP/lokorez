package br.uespi.bloum.activities;

import java.io.BufferedReader;
import java.io.IOException;

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
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.SurfaceHolder;
import edu.dhbw.andar.ARToolkit;
import edu.dhbw.andar.AndARActivity;
import edu.dhbw.andar.exceptions.AndARException;

public class NavigateActivity extends AndARActivity implements SurfaceHolder.Callback {
	private Model model;
	private Model3D model3d;
	private ProgressDialog waitDialog;
	@SuppressWarnings("unused")
	private Resources res;
	
	ARToolkit artoolkit;
	
	public NavigateActivity() {
		super(false);
	}
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		super.setNonARRenderer(new LightingRenderer());//or might be omited
		res=getResources();
		artoolkit = getArtoolkit();
		getSurfaceView().getHolder().addCallback(this);
	}
	
	

	/**
	 * Inform the user about exceptions that occurred in background threads.
	 */
	@Override
	public void uncaughtException(Thread thread, Throwable ex) {
		System.out.println("");
	}
    
    @Override
    public void surfaceCreated(SurfaceHolder holder) {
    	super.surfaceCreated(holder);
    	//load the model
    	//this is done here, to assure the surface was already created, so that the preview can be started
    	//after loading the model
    	if(model == null) {
			waitDialog = ProgressDialog.show(this, "", 
	                getResources().getText(R.string.loading), true);
			waitDialog.show();
			new ModelLoader().execute();
		}
    }
    
	private class ModelLoader extends AsyncTask<Void, Void, Void> {
    	@Override
    	protected Void doInBackground(Void... params) {
			String modelFileName = "android.obj";
			BaseFileUtil fileUtil= null;
			fileUtil = new AssetsFileUtil(getResources().getAssets());
			fileUtil.setBaseFolder("models/");
			
			//read the model file:						
			if(modelFileName.endsWith(".obj")) {
				ObjParser parser = new ObjParser(fileUtil);
				try {
					if(fileUtil != null) {
						BufferedReader fileReader = fileUtil.getReaderFromName(modelFileName);
						if(fileReader != null) {
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
    		
    		//register model
    		try {
    			if(model3d!=null)
    				artoolkit.registerARObject(model3d);
			} catch (AndARException e) {
				e.printStackTrace();
			}
			startPreview();
    	}
    }
}
