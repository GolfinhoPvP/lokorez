package com.zerokol.bluetoothtest.frames;

import java.awt.Dimension;
import javax.swing.JApplet;
import com.zerokol.bluetoothtest.panels.MainPanel;
import com.zerokol.bluetoothtest.utils.Constants;

public class WebView extends JApplet{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private static final Dimension d = Constants.APP_DIMENSION;
	
	public void init(){
		this.resize(d.width, d.height);
		MainPanel mainPanel = new MainPanel(this, d);
		this.add(mainPanel);
	}	
}
