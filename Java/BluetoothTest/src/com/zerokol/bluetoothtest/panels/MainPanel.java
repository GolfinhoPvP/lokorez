package com.zerokol.bluetoothtest.panels;

import java.awt.Container;
import java.awt.Dimension;
import javax.swing.JPanel;

public class MainPanel extends JPanel{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private Container container = null;

	public MainPanel(Container cont, final Dimension d) {
		this.container = cont;
		this.setPreferredSize(d);
		this.setFocusable(true);
		this.requestFocus();
	}
}
