package com.zerokol.bluetoothtest.panels;

import java.awt.Container;
import java.awt.Dimension;
import java.awt.Graphics;
import java.io.IOException;
import java.util.Vector;

import javax.bluetooth.BluetoothStateException;
import javax.bluetooth.DeviceClass;
import javax.bluetooth.DiscoveryAgent;
import javax.bluetooth.DiscoveryListener;
import javax.bluetooth.LocalDevice;
import javax.bluetooth.RemoteDevice;
import javax.bluetooth.ServiceRecord;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.zerokol.bluetoothtest.beans.Bluetooth;

public class MainPanel extends JPanel {
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private Container container = null;

	private JLabel bluetoothDeviceMode = new JLabel("The Bluetooth mode is: ");
	private JLabel bluetoothAddress = new JLabel("Address: ");
	private JLabel bluetoothFriendlyName = new JLabel("Friendly Name: ");
	private JLabel bluetoothMinorClass = new JLabel("Minor class value: ");
	private JLabel bluetoothMajorClass = new JLabel("Major class value: ");

	private String[][] values = null;
	private String[] columns = new String[] { "Number", "Remote Address",
			"Remote Friend Name" };
	private DefaultTableModel tableModel = new DefaultTableModel(values,
			columns);
	private JTable remoteDeviceTable = new JTable(tableModel);

	private LocalDevice localDevice = null;
	private DiscoveryAgent discoveryAgent = null;

	private Bluetooth myBluetooth = null;

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

		myBluetooth = new Bluetooth(localDevice);

		bluetoothDeviceMode.setText(bluetoothDeviceMode.getText()
				+ myBluetooth.getNamedDeviceMode());
		this.add(bluetoothDeviceMode);

		bluetoothAddress.setText(bluetoothAddress.getText()
				+ myBluetooth.getAddress());
		this.add(bluetoothAddress);

		bluetoothFriendlyName.setText(bluetoothFriendlyName.getText()
				+ myBluetooth.getFriendName());
		this.add(bluetoothFriendlyName);

		bluetoothMinorClass.setText(bluetoothMinorClass.getText()
				+ myBluetooth.getNamedMinorClass());
		this.add(bluetoothMinorClass);

		bluetoothMajorClass.setText(bluetoothMajorClass.getText()
				+ myBluetooth.getNamedMajorClass());
		this.add(bluetoothMajorClass);

		remoteDeviceTable.setPreferredSize(new Dimension(400, 300));
		this.add(remoteDeviceTable);

		discoveryAgent = localDevice.getDiscoveryAgent();

		try {
			discoveryAgent.startInquiry(DiscoveryAgent.GIAC,
					new DiscoveryListener() {
						@Override
						public void deviceDiscovered(RemoteDevice remoteDevice,
								DeviceClass remoteDeviceClass) {
							Vector<String> vector = new Vector<String>();
							vector.add(String.valueOf(remoteDeviceTable
									.getRowCount() + 1));
							vector.add(remoteDevice.getBluetoothAddress());
							try {
								vector.add(remoteDevice.getFriendlyName(true));
							} catch (IOException e) {
								// TODO Auto-generated catch block
								e.printStackTrace();
							}
							tableModel.addRow(vector);
						}

						@Override
						public void inquiryCompleted(int arg0) {
							// TODO Auto-generated method stub
						}

						@Override
						public void serviceSearchCompleted(int arg0, int arg1) {
							// TODO Auto-generated method stub
						}

						@Override
						public void servicesDiscovered(int arg0,
								ServiceRecord[] arg1) {
							// TODO Auto-generated method stub
						}
					});
		} catch (BluetoothStateException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

	public void paintComponent(Graphics g) {
		super.paintComponents(g);

		bluetoothDeviceMode.setLocation(10, 10);
		bluetoothAddress.setLocation(10, 100);
		bluetoothFriendlyName.setLocation(10, 125);
		bluetoothMinorClass.setLocation(10, 200);
		bluetoothMajorClass.setLocation(10, 225);

		remoteDeviceTable.setLocation(300, 100);

		container.repaint();
	}
}
