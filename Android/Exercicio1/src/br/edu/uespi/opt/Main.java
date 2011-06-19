package br.edu.uespi.opt;

import java.text.DecimalFormat;

import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;

public class Main extends Activity {
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        
        Spinner spinner = (Spinner) findViewById(R.id.slList);
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this, R.array.select_list, android.R.layout.simple_spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner.setAdapter(adapter);
        
        final Button button 	= (Button) findViewById(R.id.btButton);
        final EditText value 	= (EditText) findViewById(R.id.tfValue);
        final Spinner list 		= (Spinner) findViewById(R.id.slList);
        final TextView tvResult = (TextView) findViewById(R.id.tvResult);
        final DecimalFormat df = new DecimalFormat("#,###.00");

        
        button.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
            	int temp = (int) list.getSelectedItemId();
            	double val = Double.valueOf(value.getText().toString());
            	String result = "";
                switch(temp){
                	case 0 : result = val+"Km são " + String.valueOf(df.format(val / 1.609344)) + "Mi."; break;
                	case 1 : result = val+"Mi são " + String.valueOf(df.format(val * 1.609344)) + "Km."; break;
                	case 2 : result = val+"°F são " + String.valueOf(df.format(val / 1.8 - 32)) + "°C."; break;
                	case 3 : result = val+"°C são " + String.valueOf(df.format(val * 1.8 + 32)) + "°F."; break;
                	case 4 : result = val+"m são " + String.valueOf(df.format(val / 0.0254)) + "\"."; break;
                	case 5 : result = val+"\" são " + String.valueOf(df.format(val * 0.0254)) + "m."; break;
                	default : result = "ERRO!";
                }
                
                tvResult.setText("Resultado: \n"+result);
            }
        });
    }
}