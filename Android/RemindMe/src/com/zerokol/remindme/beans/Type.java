package com.zerokol.remindme.beans;

public class Type {
	private int id;
	private int iconId;
	private int colorId;
	private String name;
	
	public Type(){
	}
	
	public Type(int iconId, int colorId, String name){
		this.iconId = iconId;
		this.colorId = colorId;
		this.name = name;
	}
	
	public Type(int id, int iconId, int colorId, String name){
		this.id = id;
		this.iconId = iconId;
		this.colorId = colorId;
		this.name = name;
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getIconId() {
		return iconId;
	}

	public void setIconId(int iconId) {
		this.iconId = iconId;
	}

	public int getColorId() {
		return colorId;
	}

	public void setColorId(int colorId) {
		this.colorId = colorId;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}
}
