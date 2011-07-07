package com.zerokol.remindme.beans;

import java.sql.Date;

public class Note {
	//Constants to define the case for each entry
	private final int NOCASE = 0;
	public static final int COLDCASE = 1;
	public static final int HOTCASE = 2;
	
	private int id;
	private int typeId;
	private int frequencyId;
	private String note;
	private Date startAt;
	private Date finishAt;
	private Date alertAt;
	private int flag = NOCASE;
	
	
	public Note(){
	}
	
	public Note(int typeId, int frequencyId, String note, Date startAt, Date finishAt, Date alertAt){
		this.typeId = typeId;
		this.frequencyId = frequencyId;
		this.note = note;
		this.startAt = startAt;
		this.finishAt = finishAt;
		this.alertAt = alertAt;
	}
	
	public Note(int id, int typeId, int frequencyId, String note, Date startAt, Date finishAt, Date alertAt){
		this.id = id;
		this.typeId = typeId;
		this.frequencyId = frequencyId;
		this.note = note;
		this.startAt = startAt;
		this.finishAt = finishAt;
		this.alertAt = alertAt;
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getTypeId() {
		return typeId;
	}

	public void setTypeId(int typeId) {
		this.typeId = typeId;
	}

	public int getFrequencyId() {
		return frequencyId;
	}

	public void setFrequencyId(int frequencyId) {
		this.frequencyId = frequencyId;
	}

	public String getNote() {
		return note;
	}

	public void setNote(String note) {
		this.note = note;
	}

	public Date getStartAt() {
		return startAt;
	}

	public void setStartAt(Date startAt) {
		this.startAt = startAt;
	}

	public Date getFinishAt() {
		return finishAt;
	}

	public void setFinishAt(Date finishAt) {
		this.finishAt = finishAt;
	}

	public Date getAlertAt() {
		return alertAt;
	}

	public void setAlertAt(Date alertAt) {
		this.alertAt = alertAt;
	}

	public int getFlag() {
		return flag;
	}

	public void setFlag(int flag) {
		this.flag = flag;
	}
}
