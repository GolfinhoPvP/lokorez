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
		BattlePanel bp = new BattlePanel();
		GameFrame gf = new GameFrame();
		gf.setName("Metal Strikers 1.0 - @Zerokol Games");
		gf.getContentPane().add(bp, BorderLayout.CENTER);
		gf.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		gf.pack();
		gf.setResizable(false);
		gf.setLocationRelativeTo(null);
		gf.setVisible(true);
	}
}
