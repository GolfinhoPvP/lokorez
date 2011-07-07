package com.zerokol.remindme.utils;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteException;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

/*
 * Class to implement my adapter to hold the database requests
 * */
public class RemindMeAdapter {
	// Constants
	private static final String DATABASE_NAME = "RemindMe.db";
	private static final int DATABASE_VERSION = 1;

	private OpenHelper open;
	private SQLiteDatabase db = null;

	public RemindMeAdapter(Context ctx) {
		this.open = new OpenHelper(ctx);
		Log.i("RemindMe", "RemindMe's Data Base Connection was opened.");
	}

	public SQLiteDatabase getConnection() {
		if (this.db == null) {
			try {
				db = this.open.getWritableDatabase();
			} catch (SQLiteException ex) {
				db = this.open.getReadableDatabase();
			}
		}
		return this.db;
	}

	public void closeConnection() {
		if (this.db != null && this.db.isOpen()) {
			this.db.close();
			Log.i("RemindMe",
					"RemindMe's Data Base Connection was successfully closed.");
		} else {
			Log.e("RemindMe",
					"RemindMe's Data Base Connection cannot be closed.");
		}
	}

	// Inner class to help and manager when the database must be created or
	// updated before opened
	private static class OpenHelper extends SQLiteOpenHelper {
		public OpenHelper(Context context) {
			super(context, DATABASE_NAME, null, DATABASE_VERSION);
		}

		@Override
		public void onCreate(SQLiteDatabase db) {
			Log.w("RemindMe",
					"Creating and setting the Data Base main configuration.");

			/*
			 * Frequencies holds the frequency of events will happens: _id :
			 * unique referrer from this table fre_value : value in seconds that
			 * the event alert fre_name : human readable name for this frequency
			 */
			db.execSQL("" + " CREATE TABLE [frequencies] ( "
					+ " [_id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, "
					+ " [fre_value] UNSIGNED INTEGER NOT NULL, "
					+ " [fre_name] VARCHAR(25) NOT NULL);");

			/*
			 * Icons holds the path uri for an icon image: _id : unique referrer
			 * from this table ico_uri : path for the image
			 */
			db.execSQL("" + " CREATE TABLE [icons] ( "
					+ " [_id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, "
					+ " [ico_uri] VARCHAR(100) NOT NULL);");

			/*
			 * Colors holds the color values for event box backgrounds: _id :
			 * unique referrer from this table col_value : value in RGB for this
			 * color col_name : human readable name for this color
			 */
			db.execSQL("" + " CREATE TABLE [colors] ( "
					+ " [_id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, "
					+ " [col_value] VARCHAR(10) NOT NULL, "
					+ " [col_name] VARCHAR(25) NOT NULL);");

			/*
			 * Types holds the type of event, it separates the events in
			 * distinct categories: _id : unique referrer from this table ico_id
			 * : Referrer for the image icon for this category type col_id :
			 * Referrer for the color of background's box for these event
			 * typ_name : human readable name for this frequency
			 */
			db
					.execSQL(""
							+ " CREATE TABLE [types] ( "
							+ " [_id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, "
							+ " [ico_id] INTEGER NOT NULL REFERENCES icons(_id) ON UPDATE CASCADE ON DELETE CASCADE, "
							+ " [col_id] INTEGER NOT NULL REFERENCES colors(_id) ON UPDATE CASCADE ON DELETE CASCADE, "
							+ " [typ_name] VARCHAR(25) NOT NULL);");

			/*
			 * Cold_Case_Notes holds finished events notes: _id : unique
			 * referrer from this table typ_id : Referrer for the type event for
			 * this note fre_id : Referrer for the frequency each iteration for
			 * this note not_note : Description note to remember not_start_at :
			 * datetime when the alerts will begin not_finish_at : datetime when
			 * the alerts will finish not_alert_at : datetime for each alert
			 * iteration, based in the frequency
			 */
			db
					.execSQL(""
							+ " CREATE TABLE [cold_case_notes] ( "
							+ " [_id] UNSIGNED INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, "
							+ " [typ_id] INTEGER DEFAULT 0 REFERENCES types(_id) ON UPDATE CASCADE ON DELETE SET DEFAULT, "
							+ " [fre_id] INTEGER NOT NULL REFERENCES frequencies(_id) ON UPDATE CASCADE ON DELETE CASCADE, "
							+ " [not_note] VARCHAR(100) NOT NULL, "
							+ " [not_start_at] DATETIME NOT NULL, "
							+ " [not_finish_at] DATETIME NOT NULL, "
							+ " [not_alert_at] DATETIME NOT NULL);");

			/*
			 * Hot_Case_Notes holds the current events notes: _id : unique
			 * referrer from this table typ_id : Referrer for the type event for
			 * this note fre_id : Referrer for the frequency each iteration for
			 * this note not_note : Description note to remember not_start_at :
			 * datetime when the alerts will begin not_finish_at : datetime when
			 * the alerts will finish not_alert_at : datetime for each alert
			 * iteration, based in the frequency
			 */
			db
					.execSQL(""
							+ " CREATE TABLE [hot_case_notes] ( "
							+ " [_id] UNSIGNED INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, "
							+ " [typ_id] INTEGER DEFAULT 0 REFERENCES types(_id) ON UPDATE CASCADE ON DELETE SET DEFAULT, "
							+ " [fre_id] INTEGER NOT NULL REFERENCES frequencies(_id) ON UPDATE CASCADE ON DELETE CASCADE, "
							+ " [not_note] VARCHAR(100) NOT NULL, "
							+ " [not_start_at] DATETIME NOT NULL, "
							+ " [not_finish_at] DATETIME NOT NULL, "
							+ " [not_alert_at] DATETIME NOT NULL);");
		}

		@Override
		public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
			Log.w("RemindMe",
					"Upgrading database, this will drop tables and recreate.");
			db.execSQL("DROP TABLE IF EXISTS frequencies");
			db.execSQL("DROP TABLE IF EXISTS icons");
			db.execSQL("DROP TABLE IF EXISTS colors");
			db.execSQL("DROP TABLE IF EXISTS types");
			db.execSQL("DROP TABLE IF EXISTS cold_case_notes");
			db.execSQL("DROP TABLE IF EXISTS hot_case_notes");
			onCreate(db);
		}
	}
}
