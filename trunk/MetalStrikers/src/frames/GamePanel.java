package frames;

import java.awt.Graphics;
import java.awt.Image;
import javax.swing.JApplet;

public class GamePanel extends JApplet{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	Image img;
	public void init(){
		resize(640,480);
		img = getImage(getCodeBase(),"images/mapOne/model.png");		
	}
	public void paint(Graphics g){
		g.drawImage(img, 0, 0, this);
	}	
}