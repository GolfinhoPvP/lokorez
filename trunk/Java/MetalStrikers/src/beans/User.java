package beans;

public class User {
	private String name;
	private String password;
	private String email;
	private int group;
	
	public User(String n, String p){
		this.name = n;
		this.password = p;
	}
	
	public User(String n, String p, String e, int g){
		this.name = n;
		this.password = p;
		this.email = e;
		this.group = g;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public int getGroup() {
		return group;
	}

	public void setGroup(int group) {
		this.group = group;
	}
}
