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
	private JLabel jlSignUP = new JLabel("If you don't have a account, just ");
	private MediaTracker tracker;
	private ImageIcon background;
    
    public LogInPanel(Dimension d) {
    	this.setPreferredSize(d);
    	this.setFocusable(true);
    	this.requestFocus();
    	
    	try {
			tracker = new MediaTracker(this);
			background = new ImageIcon("bin/imagens/background.gif");
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
		jlUserName.setLocation(200, 250);
		userName.setLocation(300, 250);
		jlUserPassword.setLocation(200, 275);
		userPassword.setLocation(300, 275);
		connect.setLocation(350, 300);
		jlSignUP.setLocation(150, 350);
		signUP.setLocation(350, 350);
	}
    
    public void actionPerformed(ActionEvent event) {
        String s = userName.getText();
        String sUp = s.toUpperCase();
        userName.setText(sUp);
    } 

}
