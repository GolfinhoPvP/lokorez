package com.zerokol.bluetoothtest.beans;

public class Bluetooth {
	private int deviceMode = -1;
	private String address = null;
	private String friendName = null;
	private int minorClass = -1;
	private int majorClass = -1;

	public Bluetooth() {
	}

	public int getDeviceMode() {
		return deviceMode;
	}

	public String getNamedDeviceMode() {
		switch (this.deviceMode) {
		case 0:
			return "NOT_DISCOVERABLE";
		case 10390272:
			return "LIAC";
		case 10390323:
			return "GIAC";
		}
		return null;
	}

	public void setDeviceMode(int deviceMode) {
		this.deviceMode = deviceMode;
	}

	public String getAddress() {
		return address;
	}

	public void setAddress(String address) {
		this.address = address;
	}

	public String getFriendName() {
		return friendName;
	}

	public void setFriendName(String friendName) {
		this.friendName = friendName;
	}

	public int getMinorClass() {
		return minorClass;
	}
	
	public String getNamedMinorClass() {
		if(this.majorClass == 256 && this.minorClass == 0){
			return "Unassigned, misc.";
		}else if(this.majorClass == 256 && this.minorClass == 4){
			return "Desktop";
		}else if(this.majorClass == 256 && this.minorClass == 8){
			return "Server";
		}else if(this.majorClass == 256 && this.minorClass == 12){
			return "Laptop";
		}else if(this.majorClass == 256 && this.minorClass == 16){
			return "Sub-laptop";
		}else if(this.majorClass == 256 && this.minorClass == 20){
			return "PDA";
		}else if(this.majorClass == 256 && this.minorClass == 24){
			return "Watch size";
		}else if(this.majorClass == 512 && this.minorClass == 0){
			return "Unassigned, misc.";
		}else if(this.majorClass == 512 && this.minorClass == 4){
			return "Cellular";
		}else if(this.majorClass == 512 && this.minorClass == 8){
			return "Household cordless";
		}else if(this.majorClass == 512 && this.minorClass == 12){
			return "Smart Phone";
		}else if(this.majorClass == 512 && this.minorClass == 16){
			return "Phone modem";
		}
		return "Still not mapped!";
	}

	public void setMinorClass(int minorClass) {
		this.minorClass = minorClass;
	}

	public int getMajorClass() {
		return majorClass;
	}
	
	public String getNamedMajorClass() {
		switch (this.majorClass) {
		case 0:
			return "Unassigned, misc.";
		case 256:
			return "Computer";
		case 512:
			return "Phone";
		}
		return "Still not mapped!";
	}

	public void setMajorClass(int majorClass) {
		this.majorClass = majorClass;
	}
}
