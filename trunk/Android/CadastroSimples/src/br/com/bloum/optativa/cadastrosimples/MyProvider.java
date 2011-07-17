package br.com.bloum.optativa.cadastrosimples;

import android.content.ContentProvider;
import android.content.ContentUris;
import android.content.ContentValues;
import android.content.Context;
import android.content.UriMatcher;
import android.database.Cursor;
import android.database.SQLException;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.database.sqlite.SQLiteQueryBuilder;
import android.database.sqlite.SQLiteDatabase.CursorFactory;
import android.net.Uri;
import android.text.TextUtils;
import android.util.Log;

public class MyProvider extends ContentProvider {

	// The underlying database
	private SQLiteDatabase cadastroSimplesDB;

	private static final String TAG = "MyProvider";
	private static final String DATABASE_NAME = "cadatrosimples.db";
	private static final int DATABASE_VERSION = 1;
	private static final String USERS_TABLE = "users";

	// Column Names
	public static final String KEY_ID = "_id";
	public static final String KEY_NAME = "name";
	public static final String KEY_AGE = "age";
	public static final String KEY_EMAIL = "email";

	// Column indexes
	public static final int ID_COLUMN = 0;
	public static final int NAME_COLUMN = 1;
	public static final int AGE_COLUMN = 2;
	public static final int EMAIL_COLUMN = 3;

	private static final String myURI = "content://br.com.bloum.provider.cadastrosimples/users";
	public static final Uri CONTENT_URI = Uri.parse(myURI);

	@Override
	public boolean onCreate() {
		// TODO Auto-generated method stub
		Context context = getContext();

		MyHelper dbHelper = new MyHelper(context, DATABASE_NAME, null,
				DATABASE_VERSION);
		cadastroSimplesDB = dbHelper.getWritableDatabase();
		return (cadastroSimplesDB == null) ? false : true;
	}

	// Create the constants used to differentiate between the different URI
	// requests.
	private static final int ALLROWS = 1;
	private static final int SINGLE_ROW = 2;

	private static final UriMatcher uriMatcher;
	// Populate the UriMatcher object, where a URI ending in ‘items’ will
	// correspond to a request for all items, and ‘items/[rowID]’
	// represents a single row.
	static {
		uriMatcher = new UriMatcher(UriMatcher.NO_MATCH);
		uriMatcher.addURI("br.com.bloum.provider.cadastrosimples", "users",
				ALLROWS);
		uriMatcher.addURI("br.com.bloum.provider.cadastrosimples", "users/#",
				SINGLE_ROW);
	}

	@Override
	public Cursor query(Uri uri, String[] projection, String selection,
			String[] selectionArgs, String sortOrder) {
		// TODO Auto-generated method stub
		SQLiteQueryBuilder qb = new SQLiteQueryBuilder();

		qb.setTables(USERS_TABLE);

		// If this is a row query, limit the result set to the passed in row.
		switch (uriMatcher.match(uri)) {
		case SINGLE_ROW:
			qb.appendWhere(SINGLE_ROW + "=" + uri.getPathSegments().get(1));
			break;
		default:
			break;
		}

		// If no sort order is specified sort by date / time
		String orderBy;
		if (TextUtils.isEmpty(sortOrder)) {
			orderBy = KEY_EMAIL;
		} else {
			orderBy = sortOrder;
		}

		// Apply the query to the underlying database.
		Cursor c = qb.query(cadastroSimplesDB, projection, selection,
				selectionArgs, null, null, orderBy);

		// Register the contexts ContentResolver to be notified if
		// the cursor result set changes.
		c.setNotificationUri(getContext().getContentResolver(), uri);

		// Return a cursor to the query result.
		return c;
	}

	@Override
	public Uri insert(Uri uri, ContentValues values) {
		// TODO Auto-generated method stub
		// Insert the new row, will return the row number if
		// successful.
		long rowID = cadastroSimplesDB.insert(USERS_TABLE, "user", values);

		// Return a URI to the newly inserted row on success.
		if (rowID > 0) {
			Uri _uri = ContentUris.withAppendedId(CONTENT_URI, rowID);
			getContext().getContentResolver().notifyChange(_uri, null);
			return _uri;
		}
		throw new SQLException("Failed to insert row into " + uri);
	}

	@Override
	public int delete(Uri uri, String where, String[] whereArgs) {
		// TODO Auto-generated method stub
		int count;

		switch (uriMatcher.match(uri)) {
		case ALLROWS:
			count = cadastroSimplesDB.delete(USERS_TABLE, where, whereArgs);
			break;
		case SINGLE_ROW:
			String segment = uri.getPathSegments().get(1);
			count = cadastroSimplesDB.delete(USERS_TABLE,
					KEY_ID
							+ "="
							+ segment
							+ (!TextUtils.isEmpty(where) ? " AND (" + where
									+ ')' : ""), whereArgs);
			break;
		default:
			throw new IllegalArgumentException("Unsupported URI: " + uri);
		}

		getContext().getContentResolver().notifyChange(uri, null);
		return count;
	}

	@Override
	public int update(Uri uri, ContentValues values, String selection,
			String[] selectionArgs) {
		// TODO Auto-generated method stub
		int count;
		switch (uriMatcher.match(uri)) {
		case ALLROWS:
			count = cadastroSimplesDB.update(USERS_TABLE, values, selection,
					selectionArgs);
			break;

		case SINGLE_ROW:
			String segment = uri.getPathSegments().get(1);
			count = cadastroSimplesDB.update(USERS_TABLE, values, KEY_ID
					+ "="
					+ segment
					+ (!TextUtils.isEmpty(selection) ? " AND (" + selection
							+ ')' : ""), selectionArgs);
			break;

		default:
			throw new IllegalArgumentException("Unknown URI " + uri);
		}

		getContext().getContentResolver().notifyChange(uri, null);
		return count;
	}

	@Override
	public String getType(Uri uri) {
		// TODO Auto-generated method stub
		switch (uriMatcher.match(uri)) {
		case ALLROWS:
			return "vnd.android.cursor.dir/vnd.bloum.cadastrosimples";
		case SINGLE_ROW:
			return "vnd.android.cursor.item/vnd.bloum.cadastrosimples";
		default:
			throw new IllegalArgumentException("Unsupported URI: " + uri);
		}
	}

	// Helper class for opening, creating, and managing database version control
	private static class MyHelper extends SQLiteOpenHelper {
		private static final String DATABASE_CREATE = "CREATE TABLE ["
				+ USERS_TABLE + " [" + KEY_ID
				+ "] UNSIGNED INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, "
				+ " [" + KEY_AGE + "] INTEGER NOT NULL, " + " [" + KEY_EMAIL
				+ "] VARCHAR(25) NOT NULL);";

		public MyHelper(Context context, String name, CursorFactory factory,
				int version) {
			super(context, name, factory, version);
		}

		@Override
		public void onCreate(SQLiteDatabase db) {
			db.execSQL(DATABASE_CREATE);
		}

		@Override
		public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
			Log.w(TAG, "Upgrading database from version " + oldVersion + " to "
					+ newVersion + ", which will destroy all old data");

			db.execSQL("DROP TABLE IF EXISTS " + USERS_TABLE);
			onCreate(db);
		}
	}
}
