package com.zerokol.remindme.beans;

public class Icon {
	private int id;
	private String uri;
	
	public Icon(){
	}
	
	public Icon(String uri){
		this.uri = uri;
	}
	
	public Icon(int id, String uri){
		this.id = id;
		this.uri = uri;
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getUri() {
		return uri;
	}

	public void setUri(String uri) {
		this.uri = uri;
	}
	
}
