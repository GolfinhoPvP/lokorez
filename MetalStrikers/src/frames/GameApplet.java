package frames;

import java.awt.Dimension;
import javax.swing.JApplet;
import panels.*;

public class GameApplet extends JApplet{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private static final Dimension d = new Dimension(800,450);
	
	public void init(){
		this.resize(d.width, d.height);
		LogInPanel logInPanel = new LogInPanel(this, d);
		this.add(logInPanel);
	}	
}
