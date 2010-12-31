package frames;

import java.awt.BorderLayout;

import javax.swing.JFrame;

import panels.BattlePanel;

public class GameFrame extends JFrame{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;

	public static void main(String[] args){
		GameFrame gameFrame = new GameFrame();
		BattlePanel bp = new BattlePanel();
		
		gameFrame.setName("Metal Strikers 1.0 - @Zerokol Games");
		gameFrame.getContentPane().add(bp, BorderLayout.CENTER);
		gameFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		gameFrame.pack();
		gameFrame.setResizable(false);
		gameFrame.setLocationRelativeTo(null);
		gameFrame.setVisible(true);
	}
}
