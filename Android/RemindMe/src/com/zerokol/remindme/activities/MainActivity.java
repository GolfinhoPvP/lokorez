package com.zerokol.remindme.activities;

import com.zerokol.remindme.R;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;

public class MainActivity extends Activity {
	private Button createNoteButton;
	
	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

		setContentView(R.layout.main);
		createNoteButton = (Button) findViewById(R.id.main_button_create_note);

		setup();
	}

	public void setup() {
		createNoteButton.setOnClickListener(new OnClickListener() {
			public void onClick(View v) {
				Intent intent = new Intent(MainActivity.this,
						CreateNoteActivity.class);
				startActivity(intent);
			}
		});
	}
}