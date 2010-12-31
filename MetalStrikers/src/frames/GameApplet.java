package frames;

import java.awt.Dimension;

import javax.swing.JApplet;
import panels.BattlePanel;

public class GameApplet extends JApplet{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private static final Dimension d = new Dimension(640,480);
	
	public void init(){
		this.resize(640,480);
		BattlePanel bp = new BattlePanel(d);
		this.add(bp);
	}	
}
