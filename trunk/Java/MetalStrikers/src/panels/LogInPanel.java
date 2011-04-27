package panels;

import java.awt.Color;
import java.awt.Container;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.Graphics;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.net.URL;
import java.util.ArrayList;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextField;

public class LogInPanel extends JPanel{
	/**
	 * 
	 */
	private static final long serialVersionUID 	= 1L;
	private JTextField jtfUserName 				= new JTextField(15);  
	private JTextField jtfUserPassword 			= new JTextField(15);
	private JButton jbConnect 					= new JButton("Connect");
	private JButton jbSignUP 					= new JButton("Sign up");
	private JLabel jlUserName 					= new JLabel("User name:");
	private JLabel jlUserPassword 				= new JLabel("Password:");
	private JLabel jlSignUP 					= new JLabel("If you don't have an account, just ");
	private ImageIcon upper 					= null;
	private Image background					= null;
	private Image[] logBox						= new Image[5];
	private String imageURIApplet 				= new String("archives/images/");
	private Font font 							= new Font("serif", Font.BOLD, 15);
	private String line1						= new String("0aeeed");
	private String line2						= new String("0fxxxh");
	private String line3						= new String("0fxxxh");
	private String line4						= new String("aixxxh");
	private String line5						= new String("fxxxxh");
	private String line6						= new String("bjxxxh");
	private String line7						= new String("0fxxxh");
	private String line8						= new String("0fxxxh");
	private String line9						= new String("0fxxxh");
	private String line10						= new String("0fxxxh");
	private String line11						= new String("0fxxxh");
	private String line12						= new String("0bgjlc");
	private String line13						= new String("000fh0");
	private String line14						= new String("000bc0");
	private ArrayList<String> logBoxScheme		= new ArrayList<String>();
	private Container container					= null;
    
    public LogInPanel(Container cont, final Dimension d) {
    	this.container = cont;
    	this.setPreferredSize(d);
    	this.setFocusable(true);
    	this.requestFocus();
    	this.logBoxScheme.add(line1);
    	this.logBoxScheme.add(line2);
    	this.logBoxScheme.add(line3);
    	this.logBoxScheme.add(line4);
    	this.logBoxScheme.add(line5);
    	this.logBoxScheme.add(line6);
    	this.logBoxScheme.add(line7);
    	this.logBoxScheme.add(line8);
    	this.logBoxScheme.add(line9);
    	this.logBoxScheme.add(line10);
    	this.logBoxScheme.add(line11);
    	this.logBoxScheme.add(line12);
    	this.logBoxScheme.add(line13);
    	this.logBoxScheme.add(line14);
    	
    	try {			
			background 	= imageLoader("background.gif");
			logBox[0] 	= imageLoader("logBoxCorner1.png");
			logBox[1] 	= imageLoader("logBoxSide.png");
			logBox[2] 	= imageLoader("logBoxSide2.png");
			logBox[3] 	= imageLoader("logBoxCorner2.png");
			logBox[4] 	= imageLoader("logBoxCenter.png");
    	}catch (Exception ex) {
			// TODO Auto-generated catch block
			ex.printStackTrace();
		}
		
        this.add(jtfUserName);
        this.add(jtfUserPassword);
        this.add(jbConnect);
        this.add(jbSignUP);
        this.add(jlUserName);
        this.add(jlUserPassword);
        this.add(jlSignUP);
        jlUserName.setFont(font);
        jlUserName.setForeground(Color.WHITE);
        jlUserPassword.setFont(font);
        jlUserPassword.setForeground(Color.WHITE);
        jlSignUP.setForeground(Color.WHITE);
        
        jbConnect.addActionListener(new ActionListener(){
			 public void actionPerformed(ActionEvent ae){  
			 }
        });  
        jbSignUP.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent ae){
				setVisible(false);
				container.add(new SignUpPanel(container, d));
				container.repaint();
				try {
					this.finalize();
				} catch (Throwable e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
        });
    }
    
    private Image imageLoader(String s){
    	try {
			upper = new ImageIcon(ImageIO.read(getClass().getClassLoader().getResource(imageURIApplet+s)));
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		if(upper.getImageLoadStatus() != 8){
			try{
				URL url = Class.class.getResource("/"+imageURIApplet+s);
				upper = new ImageIcon(url);
			}catch(Exception e){
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
		return upper.getImage();
    }
    
	public void paintComponent(Graphics g) {
		super.paintComponents(g);
		g.drawImage(background, 0, 0, null);
	
		int posX = 8;
		int posY = 250;
		int xLen = logBoxScheme.get(0).toString().length();
		int yTam = logBoxScheme.size();
		for(int x=0; x<yTam; x++){
			for(int y=0; y<xLen; y++){
				switch(logBoxScheme.get(x).toString().charAt(y)){
					case 'a' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[0], 1, posX, posY);
								break;
					case 'b' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[0], 2, posX, posY);
								break;
					case 'c' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[0], 3, posX, posY);
								break;
					case 'd' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[0], 4, posX, posY);
								break;
					case 'e' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[1], 1, posX, posY);
								break;
					case 'f' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[2], 1, posX, posY);
								break;
					case 'g' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[1], 3, posX, posY);
								break;
					case 'h' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[2], 3, posX, posY);
								break;
					case 'i' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[3], 1, posX, posY);
								break;
					case 'j' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[3], 2, posX, posY);
								break;
					case 'l' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[3], 3, posX, posY);
								break;
					case 'm' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[3], 4, posX, posY);
								break;
					case 'x' : 	posX += x*30; posY += y*30;
								especialImageDrawer(g, logBox[4], 1, posX, posY);
								break;
					default : break;
				}
				posX = 8;
				posY = 250;
			}
		}
		
		jlUserName.setLocation(21, 300);
		jtfUserName.setLocation(100, 300);
		jlUserPassword.setLocation(30, 325);
		jtfUserPassword.setLocation(100, 325);
		jbConnect.setLocation(272, 310);
		jlSignUP.setLocation(20, 385);
		jbSignUP.setLocation(210, 380);
	}
	
	public void especialImageDrawer(Graphics g, Image img, int direction, int posX, int posY){
		switch(direction){
		case 1 : 	g.drawImage(img, posX, posY, null);
					break;
		case 2 : 	g.drawImage(img,
				img.getWidth(this)+posX, posY, posX, img.getHeight(this)+posY,
							0, 0, img.getWidth(this), img.getHeight(this), this);
					break;
		case 3 : 	g.drawImage (img, 
				img.getWidth(this)+posX, img.getHeight(this)+posY, posX, posY,
							0, 0, img.getWidth(this), img.getHeight(this), this);
					break;
		case 4 : 	g.drawImage (img, 
				             posX, img.getHeight(this)+posY, img.getWidth(this)+posX, posY,
				             0, 0, img.getWidth(this), img.getHeight(this), this);
					break;
		}
	}
}
