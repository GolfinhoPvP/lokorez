package frames;

import java.awt.BorderLayout;

import javax.swing.ImageIcon;
import javax.swing.JFrame;

import panels.BattlePanel;

public class GameFrame extends JFrame{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;

	public static void main(String[] args){
		GameFrame gameFrame = new GameFrame();
		BattlePanel battlePanel = new BattlePanel();
		
		gameFrame.setTitle("Metal Strikers 1.0 - ZerokolGames");
		gameFrame.setIconImage(new ImageIcon("../images/icone.gif").getImage());
		gameFrame.getContentPane().add(battlePanel, BorderLayout.CENTER);
		gameFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		gameFrame.pack();
		gameFrame.setResizable(false);
		gameFrame.setLocationRelativeTo(null);
		gameFrame.setVisible(true);
	}
}
