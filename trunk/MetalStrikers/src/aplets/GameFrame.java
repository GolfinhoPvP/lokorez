package aplets;

import java.awt.Graphics;
import java.awt.Image;
import java.net.MalformedURLException;
import java.net.URL;

import javax.swing.JApplet;

public class GameFrame extends JApplet{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	Image img;
	public void init(){
		resize(640,480);
		//img = getImage(getCodeBase(),"images/mapOne/model.png");
		try {
			//img = getImage(new URL("http://www.monky.ro/wp-content/uploads/2007/08/game_girl.jpg"));
			img = getImage(new URL("http://localhost:8080/MetalStrikersServer/images/mapOne/model.png"));
		} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}
	public void paint(Graphics g){
		g.drawImage(img, 0, 0, this);
	}	
}
