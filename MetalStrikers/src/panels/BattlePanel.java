package panels;

import java.awt.Container;
import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.MediaTracker;
import java.net.MalformedURLException;
import java.net.URL;
import javax.swing.ImageIcon;
import javax.swing.JPanel;

public class BattlePanel extends JPanel{
	/**
	 * 
	 */
	private static final long serialVersionUID 	= 1L;
	private ImageIcon[] img 					= new ImageIcon[2];
	private MediaTracker tracker;
	@SuppressWarnings("unused")
	private Container container					= null;
	private String host							= new String("http://localhost:9009/MetalStrikersServer/");
	
	public BattlePanel(Container cont, final Dimension d){
		this.container = cont;
		setPreferredSize(d);
		setFocusable(true);
		requestFocus();
		
		try {
			tracker = new MediaTracker(this);
			img[0] = new ImageIcon(new URL(host+"images/mapOne/model.png"));
			tracker.addImage(img[0].getImage(), 1);
			tracker.waitForAll();
		} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	
	public void paintComponent(Graphics g) {
		super.paintComponents(g);
		g.drawImage(img[0].getImage(), 0, 0, null);
	}
}