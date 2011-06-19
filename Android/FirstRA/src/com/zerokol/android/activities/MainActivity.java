package com.zerokol.android.activities;

import com.zerokol.android.views.CustomCameraView;
import android.app.Activity;
import android.os.Bundle;
import android.widget.FrameLayout;

public class MainActivity extends Activity {
	CustomCameraView cv;

	public void onCreate(Bundle savedInstanceState) {
		try {
			super.onCreate(savedInstanceState);
			cv = new CustomCameraView(this.getApplicationContext());
			FrameLayout rl = new FrameLayout(this.getApplicationContext());
			setContentView(rl);
			rl.addView(cv);
		} catch (Exception e) {
		}
	}
}
