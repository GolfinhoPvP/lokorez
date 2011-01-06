package panels;

import java.awt.Container;
import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.Image;
import java.net.MalformedURLException;
import java.net.URL;

import javax.swing.ImageIcon;
import javax.swing.JPanel;

public class BattlePanel extends JPanel{
	/**
	 * 
	 */
	private static final long serialVersionUID 	= 1L;
	private ImageIcon ii						= new ImageIcon();
	@SuppressWarnings("unused")
	private Container container					= null;
	private String host1						= new String("http://192.168.56.1:8080/MetalStrikersServer/");
	private String host2						= new String("http://localhost:9009/MetalStrikersServer/");
	private Image[] img 						= new Image[2];
	
	public BattlePanel(Container cont, final Dimension d){
		this.container = cont;
		setPreferredSize(d);
		setFocusable(true);
		requestFocus();
		
		img[0] = imageLoader("images/mapOne/model.png");
	}
	
	private Image imageLoader(String s){
		try {
			ii = new ImageIcon(new URL(host2+s));
			if(ii.getImageLoadStatus() != 8){
				ii = new ImageIcon(new URL(host1+s));
			}
			if(ii.getImageLoadStatus() != 8){
				System.out.print("\nThe image "+s+" wasn't load from server!");
			}else{
				System.out.print("\nThe image "+s+" was load from server!");
			}
		} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return ii.getImage();
	}
	
	public void paintComponent(Graphics g) {
		super.paintComponents(g);
		g.drawImage(img[0], 0, 0, null);
	}
}