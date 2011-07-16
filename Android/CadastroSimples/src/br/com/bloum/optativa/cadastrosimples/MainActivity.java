package br.com.bloum.optativa.cadastrosimples;

import java.util.ArrayList;

import android.app.Activity;
import android.content.Context;
import android.database.Cursor;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.ListView;
import android.widget.TextView;

public class MainActivity extends Activity {

	private ListView listView;

	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.users_list);

		listView = (ListView) findViewById(R.id.user_list_view);
		listView.setAdapter(new EfficientAdapter(this));
	}

	private static class EfficientAdapter extends BaseAdapter {
		private LayoutInflater mInflater;
		private MyProvider myProvider = new MyProvider();
		private String[] columns = {MyProvider.KEY_ID, MyProvider.KEY_NAME, MyProvider.KEY_AGE, MyProvider.KEY_EMAIL};
		private Cursor users = myProvider.query(MyProvider.CONTENT_URI, columns, null, null, null);

		public EfficientAdapter(Context context) {
			mInflater = LayoutInflater.from(context);
		}

		public int getCount() {
			return users.getCount();
		}

		public Object getItem(int position) {
			return position;
		}

		public long getItemId(int position) {
			return position;
		}

		@Override
		public View getView(int position, View convertView, ViewGroup parent) {
			ViewHolder holder;
			if (convertView == null) {
				convertView = mInflater.inflate(R.layout.users_list_row, null);
				holder = new ViewHolder();
				holder.text1 = (TextView) convertView
						.findViewById(R.id.TextView01);
				holder.text2 = (TextView) convertView
						.findViewById(R.id.TextView02);

				convertView.setTag(holder);
			} else {
				holder = (ViewHolder) convertView.getTag();
			}
			place = usersArray.get(position);
			holder.text1.setText("Nome: " + place.getName() + "\n");
			holder.text2.setText("Descrição: " + place.getDescription() + "\n");

			return convertView;
		}

		static class ViewHolder {
			TextView text1;
			TextView text2;
		}
	}
}