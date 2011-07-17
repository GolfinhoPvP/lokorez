package br.com.bloum.optativa.cadastrosimples;

import android.app.Activity;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;

public class SignUpActivity extends Activity {

	private EditText editTextName;
	private EditText editTextAge;
	private EditText editTextEmail;
	private Button buttonSignUp;
	User user = new User();

	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

		setContentView(R.layout.sign_up);

		editTextName = (EditText) findViewById(R.id.sign_up_name_text_field);
		editTextAge = (EditText) findViewById(R.id.sign_up_age_text_field);
		editTextEmail = (EditText) findViewById(R.id.sign_up_email_text_field);
		buttonSignUp = (Button) findViewById(R.id.sign_up_button);

		inicia();
	}

	private void inicia() {
		ETdata.setOnClickListener(new View.OnClickListener() {
			// @Override
			public void onClick(View v) {

				final Calendar c = Calendar.getInstance();
				int y = c.get(Calendar.YEAR);
				int m = c.get(Calendar.MONTH);
				int d = c.get(Calendar.DAY_OF_MONTH);

				DatePickerDialog dp = new DatePickerDialog(
						DinheiroActivity.this,
						new DatePickerDialog.OnDateSetListener() {
							@Override
							public void onDateSet(DatePicker view, int year,
									int monthOfYear, int dayOfMonth) {
								String erg = "";
								erg = String.valueOf(dayOfMonth);
								erg += "/" + String.valueOf(monthOfYear + 1);
								erg += "/" + year;
								ETdata.setText(erg);
								data = new Date(year - 1900, monthOfYear,
										dayOfMonth);
							}

						}, y, m, d);

				dp.setTitle("Data");
				dp.show();

			}
		});

		btAdiciona.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				salvar();
			}
		});

	}

	private void salvar() {
		if (Util.VerificaDataEntrada(data)) {
			if (!ETvalor.getText().toString().equals("")) {

				if (data == null) {
					data = new Date();
				}

				entrada.setData(data);
				entrada
						.setValor(Float
								.parseFloat(ETvalor.getText().toString()));
				entrada.setDescricao(ETdescricao.getText().toString());
				entrada
						.setCategoria(categoriaService
								.listar(
										SPNSelectCategoria.getSelectedItem()
												.toString()).get(0));
				entrada = entradaService.salvar(entrada);

				dinheiro.setEntrada(entrada);
				dinheiroService.salvar(dinheiro);

				Toast.makeText(getApplicationContext(),
						"Opera��o realizada com sucesso!", Toast.LENGTH_SHORT)
						.show();
				setResult(RESULT_OK);
				DinheiroActivity.this.finish();

			} else {
				Toast.makeText(getApplicationContext(),
						"Valor n�o pode ser vazio!", Toast.LENGTH_SHORT).show();
			}
		} else {
			Toast.makeText(getApplicationContext(),
					"Data de entrada n�o pode ser uma data futura!",
					Toast.LENGTH_LONG).show();
		}
	}

}
