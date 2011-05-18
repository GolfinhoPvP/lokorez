package com.zerokol.android.utils;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

public class Connection {
	private OpenHelper open;
	private SQLiteDatabase db = null;	
	
	public Connection(Context ctx) {							
		this.open = new OpenHelper(ctx);
		Log.i("RemindMe", "The Data Base Connection was opened.");
	}
	
	public SQLiteDatabase getConexao(){
		if (this.db == null){
			this.db = this.open.getWritableDatabase();
		}
		Log.i("RemindMe", "The Data Base Connection was reached.");
		return this.db;	
	}
	
	public void closeConnection(){
		if(this.db != null && this.db.isOpen()){
			this.db.close();
			Log.i("RemindMe", "The Data Base Connection was successfully closed.");
		}else{
			Log.e("RemindMe", "The Data Base Connection cannot be closed.");
		}
	}
	
	private static class OpenHelper extends SQLiteOpenHelper {
		public OpenHelper(Context context) {
			super(context, "perfin", null, 1);
	    }

		@Override
		public void onCreate(SQLiteDatabase db) {
			Log.w("RemindMe", "Creating and setting the Data Base main configuration.");
  
			db.execSQL(""+
					" CREATE TABLE [categoria] ( "+
					" [_id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, "+
					" [descricao] varchar(45) NOT NULL);");
		}

		@Override
		public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
			Log.w("perfin", "Upgrading database, this will drop tables and recreate.");
			//db.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME);
			onCreate(db);
		}
	}
}
