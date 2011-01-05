package panels;

import java.awt.Color;
import java.awt.Container;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.Graphics;
import java.awt.Image;
import java.awt.MediaTracker;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.net.URL;
import java.util.ArrayList;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;

import beans.User;

public class SignUpPanel extends JPanel{
	/**
	 * 
	 */
	private static final long serialVersionUID 	= 1L;
	private JTextField jtfUserName 				= new JTextField(15);  
	private JPasswordField jtfUserPassword1 	= new JPasswordField(15);
	private JPasswordField jtfUserPassword2 	= new JPasswordField(15);
	private JTextField jtfEmail					= new JTextField(15);
	private JButton jbSignUP 					= new JButton("Save!");
	private JLabel jlUserName 					= new JLabel("User name:");
	private JLabel jlUserPassword1 				= new JLabel("Password:");
	private JLabel jlUserPassword2 				= new JLabel("Confirm password:");
	private JLabel jlEmail 						= new JLabel("Email:");
	private MediaTracker tracker 				= null;
	private ImageIcon upper 					= null;
	private Image background					= null;
	private Image[] logBox						= new Image[5];
	private String imageURIFrame 				= new String("bin/archives/images/");
	private String imageURIApplet 				= new String("archives/images/");
	private Font font 							= new Font("serif", Font.BOLD, 15);
	private String line1						= new String("aeeed");
	private String line2						= new String("fxxxh");
	private String line3						= new String("fxxxh");
	private String line4						= new String("fxxxh");
	private String line5						= new String("fxxxh");
	private String line6						= new String("fxxxh");
	private String line7						= new String("fxxxh");
	private String line8						= new String("fxxxh");
	private String line9						= new String("fxxxh");
	private String line10						= new String("fxxxh");
	private String line11						= new String("fxxxh");
	private String line12						= new String("fxxxh");
	private String line13						= new String("fxxxh");
	private String line14						= new String("bgggc");
	private ArrayList<String> logBoxScheme		= new ArrayList<String>();
	@SuppressWarnings("unused")
	private Container container					= null;
	@SuppressWarnings("unused")
	private boolean allow						= false;
	private Pattern pUserName 					= Pattern.compile("^([a-z]|[0-9]|[A-Z]|-|_|\\.){4,15}$");
	private Pattern pUserEmail 					= Pattern.compile("^([a-z]|[0-9]|_|-|\\.){3,}@([a-z]|[0-9]){2,}\\.([a-z]|[0-9]){2,}$");
	private Pattern pPassword					= Pattern.compile("^([a-z]|[A-Z]|[0-9]){4,15}$");
	
    public SignUpPanel(Container cont, final Dimension d) {
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
			tracker = new MediaTracker(this);
			
			background 	= imageLoader("background.gif");
			logBox[0] 	= imageLoader("logBoxCorner1.png");
			logBox[1] 	= imageLoader("logBoxSide.png");
			logBox[2] 	= imageLoader("logBoxSide2.png");
			logBox[3] 	= imageLoader("logBoxCorner2.png");
			logBox[4] 	= imageLoader("logBoxCenter.png");
			//http://www.javaworld.com/javatips/jw-javatip32.html

			tracker.addImage(background, 0);
			tracker.addImage(logBox[0], 1);
			tracker.addImage(logBox[1], 2);
			tracker.addImage(logBox[2], 3);
			tracker.addImage(logBox[3], 4);
			tracker.addImage(logBox[4], 5);
			tracker.waitForAll();
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (Exception ex) {
			// TODO Auto-generated catch block
			ex.printStackTrace();
		}
		
        this.add(jtfUserName);
        this.add(jtfUserPassword1);
        this.add(jtfUserPassword2);
        this.add(jtfEmail);
        this.add(jlUserName);
        this.add(jlUserPassword1);
        this.add(jlUserPassword2);
        this.add(jlEmail);
        this.add(jbSignUP);
        jlUserName.setFont(font);
        jlUserName.setForeground(Color.WHITE);
        jlUserPassword1.setFont(font);
        jlUserPassword1.setForeground(Color.WHITE);
        jlUserPassword2.setFont(font);
        jlUserPassword2.setForeground(Color.WHITE);
        jlEmail.setFont(font);
        jlEmail.setForeground(Color.WHITE);
         
        jbSignUP.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent ae){
				if(allow == true){
					@SuppressWarnings("deprecation")
					User u = new User(jtfUserName.getText(), jtfUserPassword1.getText(), jtfEmail.getText(), 0);
				}
			}
        });
        jtfUserName.addKeyListener(new tfValider());
        jtfEmail.addKeyListener(new tfValider());
        jtfUserPassword1.addKeyListener(new tfValider());
        jtfUserPassword2.addKeyListener(new tfValider());
    }
    
    private Image imageLoader(String s){
    	upper = new ImageIcon(imageURIFrame+s);
		if(upper.getImageLoadStatus() != 8){
			upper = new ImageIcon(imageURIApplet+s);
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
		if(upper.getImageLoadStatus() != 8){
			System.out.print("\nImage: "+s+" wasn't load!\n");
		}
		return upper.getImage();
    }
    
	public void paintComponent(Graphics g) {
		super.paintComponents(g);
		g.drawImage(background, 0, 0, null);
	
		int posX = 8;
		int posY = 270;
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
				posY = 270;
			}
		}
		
		jlUserName.setLocation(72, 290);
		jtfUserName.setLocation(150, 290);
		jlEmail.setLocation(106, 320);
		jtfEmail.setLocation(150, 320);
		jlUserPassword1.setLocation(81, 350);
		jtfUserPassword1.setLocation(150, 350);
		jlUserPassword2.setLocation(24, 380);
		jtfUserPassword2.setLocation(150, 380);
		jbSignUP.setLocation(330, 381);
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
	
	class tfValider implements KeyListener{
		private JTextField jtf = null;
		private Matcher m = null;
		@Override
		public void keyPressed(KeyEvent arg0) {
			// TODO Auto-generated method stub
		}
		@SuppressWarnings("deprecation")
		@Override
		public void keyReleased(KeyEvent arg0) {
			// TODO Auto-generated method stub
			jtf = (JTextField) arg0.getSource();
			if(jtf == jtfUserName){
				m = pUserName.matcher(jtf.getText());
			}else if(jtf == jtfEmail){
				m = pUserEmail.matcher(jtf.getText());
			}else if(jtf == jtfUserPassword1 || jtf == jtfUserPassword2){
				m = pPassword.matcher(jtf.getText());
			}else{
				System.out.print("ERRO!");
			}
			
			if(!m.find()){ 
				jtf.setBackground(Color.RED);
				allow = false;
			}else{
				jtf.setBackground(Color.WHITE);
				allow = true;
			}
			if(jtf == jtfUserPassword2){
				if(0 != jtfUserPassword1.getText().compareTo(jtfUserPassword2.getText())){
					jtfUserPassword1.setBackground(Color.RED);
					jtfUserPassword2.setBackground(Color.RED);
					allow = false;
				}else{
					jtfUserPassword1.setBackground(Color.WHITE);
					jtfUserPassword2.setBackground(Color.WHITE);
					allow = true;
				}
			}
		}
		@Override
		public void keyTyped(KeyEvent arg0) {
			// TODO Auto-generated method stub
			
		}
	}
}