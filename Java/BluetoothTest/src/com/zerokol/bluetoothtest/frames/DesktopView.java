package com.zerokol.bluetoothtest.frames;

import java.awt.BorderLayout;
import javax.swing.JFrame;
import com.zerokol.bluetoothtest.panels.MainPanel;
import com.zerokol.bluetoothtest.utils.Constants;

public class DesktopView extends JFrame{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;

	public static void main(String[] args){
		DesktopView gameFrame = new DesktopView();
		MainPanel mainPanel = new MainPanel(gameFrame, Constants.APP_DIMENSION);
		
		gameFrame.setTitle(Constants.APP_NAME);
		gameFrame.getContentPane().add(mainPanel, BorderLayout.CENTER);
		gameFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		gameFrame.pack();
		gameFrame.setResizable(false);
		gameFrame.setLocationRelativeTo(null);
		gameFrame.setVisible(true);
	}
}
