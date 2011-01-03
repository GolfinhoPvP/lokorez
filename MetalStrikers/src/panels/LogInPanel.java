package panels;

import java.awt.Dimension;
import java.awt.Font;
import java.awt.Graphics;
import java.awt.Image;
import java.awt.MediaTracker;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextField;

public class LogInPanel extends JPanel implements ActionListener{
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
	private MediaTracker tracker 				= null;
	private ImageIcon upper 					= null;
	private Image background, logInBox 			= null;
	private String imageURIFrame 				= new String("bin/archives/images/");
	private String imageURIApplet 				= new String("archives/images/");
	private Font font 							= new Font("serif", Font.BOLD, 15);
    
    public LogInPanel(Dimension d) {
    	this.setPreferredSize(d);
    	this.setFocusable(true);
    	this.requestFocus();
    	
    	try {
			tracker = new MediaTracker(this);
			
			background 	= imageLoader("background.gif");
			logInBox 	= imageLoader("logBoxHor2.png");
			//http://www.javaworld.com/javatips/jw-javatip32.html

			tracker.addImage(background, 1);
			tracker.addImage(logInBox, 1);
			tracker.waitForAll();
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (Exception ex) {
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
        jlUserPassword.setFont(font);
        jtfUserName.addActionListener(this);
        jtfUserPassword.addActionListener(this);

    }
    
    private Image imageLoader(String s){
    	upper = new ImageIcon(imageURIFrame+s);
		if(upper.getImageLoadStatus() != 8){
			upper = new ImageIcon(imageURIApplet+s);
		}
		if(upper.getImageLoadStatus() != 8){
			System.out.print("\nImage: "+s+" wasn't load!\n");
		}
		return upper.getImage();
    }
    
	public void paintComponent(Graphics g) {
		super.paintComponents(g);
		g.drawImage(background, 0, 0, null);
		g.drawImage(logInBox, 10, 250, null);
		jlUserName.setLocation(21, 300);
		jtfUserName.setLocation(100, 300);
		jlUserPassword.setLocation(30, 325);
		jtfUserPassword.setLocation(100, 325);
		jbConnect.setLocation(280, 310);
		jlSignUP.setLocation(20, 385);
		jbSignUP.setLocation(210, 380);
	}
    
    public void actionPerformed(ActionEvent event) {
        String s = jtfUserName.getText();
        String sUp = s.toUpperCase();
        jtfUserName.setText(sUp);
    } 

}
