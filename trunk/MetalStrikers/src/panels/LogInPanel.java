package panels;

import java.awt.Graphics;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JPanel;
import javax.swing.JTextField;

public class LogInPanel extends JPanel implements ActionListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private JTextField userName = new JTextField(15);  
	private JTextField userPassword = new JTextField(15);
    
    public LogInPanel() {
        add(userName);
        userName.addActionListener(this);
        userPassword.addActionListener(this);
        userName.addActionListener(this);

    }
    
	public void paintComponent(Graphics g) {
		super.paintComponents(g);
		userName.setLocation(300, 250);
		userPassword.setLocation(300, 275);
	}
    
    public void actionPerformed(ActionEvent event) {
        String s = userName.getText();
        String sUp = s.toUpperCase();
        userName.setText(sUp);
    } 

}
