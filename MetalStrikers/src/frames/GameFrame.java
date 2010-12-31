package frames;

import java.awt.BorderLayout;
import java.awt.Dimension;
import javax.swing.JFrame;
import panels.*;

public class GameFrame extends JFrame{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private static final Dimension d = new Dimension(800,450);

	public static void main(String[] args){
		GameFrame gameFrame = new GameFrame();
		LogInPanel logInPanel = new LogInPanel(d);
		
		gameFrame.setTitle("Metal Strikers 1.0 - @Zerokol Games");
		gameFrame.getContentPane().add(logInPanel, BorderLayout.CENTER);
		gameFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		gameFrame.pack();
		gameFrame.setResizable(false);
		gameFrame.setLocationRelativeTo(null);
		gameFrame.setVisible(true);
	}
}
