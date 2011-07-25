package com.zerokol.bluetoothtest.panels;

import java.awt.Container;
import java.awt.Dimension;
import java.awt.Graphics;
import java.util.ArrayList;
import java.util.Vector;

import javax.bluetooth.BluetoothStateException;
import javax.bluetooth.DataElement;
import javax.bluetooth.DeviceClass;
import javax.bluetooth.DiscoveryAgent;
import javax.bluetooth.DiscoveryListener;
import javax.bluetooth.LocalDevice;
import javax.bluetooth.RemoteDevice;
import javax.bluetooth.ServiceRecord;
import javax.bluetooth.UUID;
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
	private ArrayList<Bluetooth> bluetoothRemoteDevices = new ArrayList<Bluetooth>();
	private ArrayList<RemoteDevice> remoteDevices = new ArrayList<RemoteDevice>();

	private Vector<String> serviceFound = new Vector<String>();
	private UUID OBEX_FILE_TRANSFER = new UUID(0x1106);
	private UUID SERIAL_PORT = new UUID(0x1101);

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
				+ myBluetooth.getFriendlyName());
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
							Bluetooth b = new Bluetooth(remoteDevice);
							bluetoothRemoteDevices.add(b);
							remoteDevices.add(remoteDevice);
							Vector<String> vector = new Vector<String>();
							vector.add(String.valueOf(remoteDeviceTable
									.getRowCount() + 1));
							vector.add(remoteDevice.getBluetoothAddress());
							vector.add(b.getFriendlyName());
							tableModel.addRow(vector);
						}

						@Override
						public void inquiryCompleted(int arg0) {
							Vector<String> vector = new Vector<String>();
							vector.add("END");
							vector.add("OF");
							vector.add("SEARCH");
							tableModel.addRow(vector);
							for(int x = 0; x < bluetoothRemoteDevices.size(); x++){
								getService(x);
							}
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

	public void getService(int index) {
		int[] attrIDs = new int[] { 0x0100 }; // Service name
		UUID[] searchUuidSet = new UUID[] { OBEX_FILE_TRANSFER, SERIAL_PORT };

		try {
			discoveryAgent.searchServices(attrIDs, searchUuidSet, remoteDevices
					.get(index), new DiscoveryListener() {
				@Override
				public void servicesDiscovered(int transID,
						ServiceRecord[] servRecord) {
					for (int i = 0; i < servRecord.length; i++) {
						String url = servRecord[i].getConnectionURL(
								ServiceRecord.NOAUTHENTICATE_NOENCRYPT, false);
						if (url == null) {
							continue;
						}
						serviceFound.add(url);
						DataElement serviceName = servRecord[i]
								.getAttributeValue(0x0100);
						if (serviceName != null) {
							System.out.println("service "
									+ serviceName.getValue() + " found " + url);
						} else {
							System.out.println("service found " + url);
						}
					}
				}

				@Override
				public void serviceSearchCompleted(int arg0, int arg1) {
					System.out.println("End of service search");
				}

				@Override
				public void deviceDiscovered(RemoteDevice arg0, DeviceClass arg1) {
					// TODO Auto-generated method stub
				}

				@Override
				public void inquiryCompleted(int arg0) {
					// TODO Auto-generated method stub

				}
			});
		} catch (BluetoothStateException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}
