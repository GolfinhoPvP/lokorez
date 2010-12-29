package applets;

import java.awt.Graphics;
import java.awt.Image;
import java.awt.MediaTracker;
import java.net.MalformedURLException;
import java.net.URL;

import javax.swing.JApplet;

public class GameFrame extends JApplet{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private Image[] img = new Image[2];
	private MediaTracker tracker;
	
	public void init(){
		resize(640,480);
		//img = getImage(getCodeBase(),"images/mapOne/model.png");
		try {
			tracker = new MediaTracker(this);
			img[0] = getImage(new URL("http://www.monky.ro/wp-content/uploads/2007/08/game_girl.jpg"));
			img[1] = getImage(new URL("http://localhost:9009/MetalStrikersServer/images/mapOne/model.png"));
			tracker.addImage(img[0], 1);
			tracker.addImage(img[1], 2);
			tracker.waitForAll();
		} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}
	public void paint(Graphics g){
		g.drawImage(img[0], 0, 0, this);
		g.drawImage(img[1], 0, 0, this);
	}	
}
