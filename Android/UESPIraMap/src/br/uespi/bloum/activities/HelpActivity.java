package br.uespi.bloum.activities;

import br.uespi.bloum.R;
import android.app.Activity;
import android.os.Bundle;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;

public class HelpActivity  extends Activity{
	
	//Criando um objeto WebView para carregar as páginas .html e materiais
	private WebView mWebView;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.help);
		
		//relacionando o objeto WebView com a TAG WebView no layout help.xml
		mWebView = (WebView) findViewById(R.id.help_webview);
		
		//configurando algumas configurações básicas para melhor navegação nas páginas que serão carregadas
		WebSettings webSettings = mWebView.getSettings();
        webSettings.setSupportZoom(true);
        webSettings.setBuiltInZoomControls(true);
        
        //criando um objeto cliente web que recebera e enviara requisições e respostas
        WebChromeClient client = new WebChromeClient();
        //setando oobjeto web no objeto WebView
        mWebView.setWebChromeClient(client);
        
        //carregando a página inicial
		mWebView.loadUrl("file:///android_asset/help/index.html");
	}
}
