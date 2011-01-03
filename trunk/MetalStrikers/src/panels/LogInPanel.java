package panels;

import java.awt.Dimension;
import java.awt.Graphics;
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
	private static final long serialVersionUID = 1L;
	private JTextField userName = new JTextField(15);  
	private JTextField userPassword = new JTextField(15);
	private JButton connect = new JButton("Connect");
	private JButton signUP = new JButton("Sign up");
	private JLabel jlUserName = new JLabel("User name:");
	private JLabel jlUserPassword = new JLabel("Password:");
	private JLabel jlSignUP = new JLabel("If you don't have an account, just ");
	private MediaTracker tracker;
	private ImageIcon background;
	private String imageURIFrame = new String("bin/archives/images/");
	private String imageURIApplet = new String("archives/images/");
    
    public LogInPanel(Dimension d) {
    	this.setPreferredSize(d);
    	this.setFocusable(true);
    	this.requestFocus();
    	
    	try {
			tracker = new MediaTracker(this);
			background = new ImageIcon(imageURIFrame+"background.gif");
			if(background.getImageLoadStatus() != 8){
				background = new ImageIcon(imageURIApplet+"background.gif");
			}
			tracker.addImage(background.getImage(), 1);
			tracker.waitForAll();
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
        this.add(userName);
        this.add(userPassword);
        this.add(connect);
        this.add(signUP);
        this.add(jlUserName);
        this.add(jlUserPassword);
        this.add(jlSignUP);
        jlUserName.setFont(getFont());
        jlUserPassword.setSize(500, 700);
        jlSignUP.setFont(getFont());
        userName.addActionListener(this);
        userPassword.addActionListener(this);

    }
    
	public void paintComponent(Graphics g) {
		super.paintComponents(g);
		g.drawImage(background.getImage(), 0, 0, null);
		jlUserName.setLocation(30, 300);
		userName.setLocation(100, 300);
		jlUserPassword.setLocation(30, 325);
		userPassword.setLocation(100, 325);
		connect.setLocation(280, 310);
		jlSignUP.setLocation(20, 385);
		signUP.setLocation(200, 380);
	}
    
    public void actionPerformed(ActionEvent event) {
        String s = userName.getText();
        String sUp = s.toUpperCase();
        userName.setText(sUp);
    } 

}
