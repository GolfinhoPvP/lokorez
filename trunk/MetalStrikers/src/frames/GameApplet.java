package frames;

import javax.swing.JApplet;
import panels.BattlePanel;

public class GameApplet extends JApplet{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	
	public void init(){
		this.resize(640,480);
		BattlePanel bp = new BattlePanel();
		this.add(bp);
	}	
}
