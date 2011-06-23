package br.uespi.bloum.activities;

import br.uespi.bloum.R;
import android.app.Activity;
import android.os.Bundle;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;

public class HelpActivity  extends Activity{
	
	private WebView mWebView;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.help);
		
		mWebView = (WebView) findViewById(R.id.help_webview);
		
		WebSettings webSettings = mWebView.getSettings();
        webSettings.setSupportZoom(true);
        webSettings.setBuiltInZoomControls(true);
        
        WebChromeClient client = new WebChromeClient();
        mWebView.setWebChromeClient(client);
                
		mWebView.loadUrl("file:///android_asset/help/index.html");
	}
}
