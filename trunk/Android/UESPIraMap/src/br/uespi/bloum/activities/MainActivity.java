package br.uespi.bloum.activities;

import br.uespi.bloum.R;
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;

public class MainActivity extends Activity{
	
	private Button navigateButton;
	private Button helpButton;
	
	/** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        
        navigateButton = (Button) findViewById(R.id.main_menu_navigate_button);
        helpButton = (Button) findViewById(R.id.main_menu_help_button);
        
        setup();
    }
    
    public void setup(){
    	navigateButton.setOnClickListener(new OnClickListener() {					
			@Override
			public void onClick(View v) {	
				Intent intent = new Intent(MainActivity.this, NavigateActivity.class);
				startActivity (intent);
			}
		});
    	
    	helpButton.setOnClickListener(new OnClickListener() {					
			@Override
			public void onClick(View v) {	
				Intent intent = new Intent(MainActivity.this, HelpActivity.class);
				startActivity (intent);
		    }
		});
    }
}