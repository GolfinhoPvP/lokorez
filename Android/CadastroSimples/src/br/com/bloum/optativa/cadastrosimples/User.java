package br.com.bloum.optativa.cadastrosimples;

public class User {
	private long id;
	private String name;
	private int age;
	private String email;
	
	public User(){
	}
	
	public User(String n, int a, String e){
		this.name = n;
		this.age = a;
		this.email = e;
	}
	
	public User(long i, String n, int a, String e){
		this.id = i;
		this.name = n;
		this.age = a;
		this.email = e;
	}

	public long getId() {
		return id;
	}

	public void setId(long id) {
		this.id = id;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public int getAge() {
		return age;
	}

	public void setAge(int age) {
		this.age = age;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}
}
