package br.zerokol.mobile.android;

import android.app.Activity;
import android.os.Bundle;

public class main extends Activity {
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        CompassView cv = new CompassView(this);
        setContentView(cv);
        cv.setBearing(145);
    }
}