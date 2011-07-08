package com.zerokol.remindme.activities;

import java.util.Calendar;

import com.zerokol.remindme.R;

import android.app.Activity;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.app.TimePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.DatePicker;
import android.widget.TextView;
import android.widget.TimePicker;

public class CreateNoteActivity extends Activity {
	private TextView finishAtTextfield;
	private int mYear;
	private int mMonth;
	private int mDay;

	private int mhour;
	private int mminute;

	static final int TIME_DIALOG_ID = 1;

	static final int DATE_DIALOG_ID = 0;

	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.create_note);

		finishAtTextfield = (TextView) findViewById(R.id.create_note_textfield_finish_at);

		// Pick time's click event listener
		finishAtTextfield.setOnClickListener(new View.OnClickListener() {
			public void onClick(View v) {
				// TODO Auto-generated method stub
				showDialog(TIME_DIALOG_ID);
			}
		});

		final Calendar c = Calendar.getInstance();
		mYear = c.get(Calendar.YEAR);
		mMonth = c.get(Calendar.MONTH);
		mDay = c.get(Calendar.DAY_OF_MONTH);
		mhour = c.get(Calendar.HOUR_OF_DAY);
		mminute = c.get(Calendar.MINUTE);

	}

	private void updateDate() {
		finishAtTextfield.setText(new StringBuilder()
				// Month is 0 based so add 1
				.append(mDay).append("/").append(mMonth + 1).append("/")
				.append(mYear).append(" ").append(finishAtTextfield.getText().toString()));
	}

	public void updatetime() {
		finishAtTextfield.setText(new StringBuilder().append(pad(mhour))
				.append(":").append(pad(mminute)));
	}

	private static String pad(int c) {
		if (c >= 10)
			return String.valueOf(c);
		else
			return "0" + String.valueOf(c);
	}

	private DatePickerDialog.OnDateSetListener mDateSetListener = new DatePickerDialog.OnDateSetListener() {
		public void onDateSet(DatePicker view, int year, int monthOfYear,
				int dayOfMonth) {
			mYear = year;
			mMonth = monthOfYear;
			mDay = dayOfMonth;
			updateDate();
		}
	};

	private TimePickerDialog.OnTimeSetListener mTimeSetListener = new TimePickerDialog.OnTimeSetListener() {
		public void onTimeSet(TimePicker view, int hourOfDay, int minute) {
			mhour = hourOfDay;
			mminute = minute;
			updatetime();
			showDialog(DATE_DIALOG_ID);
		}
	};

	@Override
	protected Dialog onCreateDialog(int id) {
		switch (id) {
		case DATE_DIALOG_ID:
			return new DatePickerDialog(this, mDateSetListener, mYear, mMonth,
					mDay);
		case TIME_DIALOG_ID:
			return new TimePickerDialog(this, mTimeSetListener, mhour, mminute,
					false);
		}
		return null;
	}
}