package com.zerokol.bluetoothtest.panels;

import java.awt.Container;
import java.awt.Dimension;
import java.awt.Graphics;

import javax.bluetooth.BluetoothStateException;
import javax.bluetooth.DiscoveryAgent;
import javax.bluetooth.LocalDevice;
import javax.swing.JLabel;
import javax.swing.JPanel;

public class MainPanel extends JPanel {
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	@SuppressWarnings("unused")
	private Container container = null;
	
	private JLabel bluetoothAddressLabel = new JLabel("Bluetooth Address:");
	private JLabel bluetoothAddressValue = null;
	private JLabel bluetoothFriendlyNameLabel = new JLabel("Bluetooth Friendly Name:");
	private JLabel bluetoothFriendlyNameValue = null;
	
	private LocalDevice localdevice = null;

	public MainPanel(Container cont, final Dimension d) {
		this.container = cont;
		this.setPreferredSize(d);
		this.setFocusable(true);
		this.requestFocus();
		
		//Getting the local devise
		try {
			localdevice = LocalDevice.getLocalDevice();
		} catch (BluetoothStateException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		/*//Setting the devise discoverable
		try {
			localdevice.setDiscoverable(DiscoveryAgent.LIAC);
		} catch (BluetoothStateException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}*/
		
		bluetoothAddressValue = new JLabel(localdevice.getBluetoothAddress());
		bluetoothFriendlyNameValue = new JLabel(localdevice.getFriendlyName());
	}
	
	public void paintComponent(Graphics g) {
		super.paintComponents(g);
		
		bluetoothAddressLabel.setLocation(20, 300);
		bluetoothAddressValue.setLocation(100, 300);
		bluetoothFriendlyNameLabel.setLocation(20, 325);
		bluetoothFriendlyNameValue.setLocation(100, 325);
	}
}
