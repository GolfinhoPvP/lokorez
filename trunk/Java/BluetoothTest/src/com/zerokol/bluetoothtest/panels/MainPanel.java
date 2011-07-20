package com.zerokol.bluetoothtest.panels;

import java.awt.Container;
import java.awt.Dimension;
import java.awt.Graphics;

import javax.bluetooth.BluetoothStateException;
import javax.bluetooth.DeviceClass;
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

	private JLabel bluetoothDeviceMode = new JLabel("The Bluetooth mode is: ");
	private JLabel bluetoothAddress = new JLabel("Address: ");
	private JLabel bluetoothFriendlyName = new JLabel("Friendly Name: ");
	private JLabel bluetoothMinorClass = new JLabel("Minor class value: ");
	private JLabel bluetoothMajorClass = new JLabel("Major class value: ");

	private LocalDevice localDevice = null;
	private DeviceClass localDeviceClass = null;

	public MainPanel(Container cont, final Dimension d) {
		this.container = cont;
		this.setPreferredSize(d);
		this.setFocusable(true);
		this.requestFocus();

		// Getting the local devise
		try {
			localDevice = LocalDevice.getLocalDevice();
		} catch (BluetoothStateException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		// Setting the devise discoverable
		try {
			localDevice.setDiscoverable(DiscoveryAgent.LIAC);
		} catch (BluetoothStateException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		switch (localDevice.getDiscoverable()) {
		case 0:
			bluetoothDeviceMode.setText(bluetoothDeviceMode.getText()
					+ "NOT_DISCOVERABLE");
			break;
		case 10390272:
			bluetoothDeviceMode.setText(bluetoothDeviceMode.getText() + "LIAC");
			break;
		case 10390323:
			bluetoothDeviceMode.setText(bluetoothDeviceMode.getText() + "GIAC");
			break;
		}
		this.add(bluetoothDeviceMode);

		bluetoothAddress.setText(bluetoothAddress.getText()
				+ localDevice.getBluetoothAddress());
		this.add(bluetoothAddress);
		
		bluetoothFriendlyName.setText(bluetoothFriendlyName.getText()
				+ localDevice.getFriendlyName());
		this.add(bluetoothFriendlyName);
		
		localDeviceClass = localDevice.getDeviceClass();
		
		bluetoothMinorClass.setText(bluetoothMinorClass.getText()
				+ localDeviceClass.getMinorDeviceClass());
		this.add(bluetoothMinorClass);
		
		bluetoothMajorClass.setText(bluetoothMajorClass.getText()
				+ localDeviceClass.getMajorDeviceClass());
		this.add(bluetoothMajorClass);
	}

	public void paintComponent(Graphics g) {
		super.paintComponents(g);

		bluetoothDeviceMode.setLocation(10, 10);
		bluetoothAddress.setLocation(10, 100);
		bluetoothFriendlyName.setLocation(10, 125);
		bluetoothMinorClass.setLocation(10, 200);
		bluetoothMajorClass.setLocation(10, 225);
	}
}
