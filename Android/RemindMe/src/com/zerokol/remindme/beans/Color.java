package com.zerokol.remindme.beans;

public class Color {
	private int id;
	private long value;
	private String name;
	
	public Color(){
	}
	
	public Color(long value, String name){
		this.value = value;
		this.name = name;
	}
	
	public Color(int id, long value, String name){
		this.id = id;
		this.value = value;
		this.name = name;
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public long getValue() {
		return value;
	}

	public void setValue(long value) {
		this.value = value;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}
}
