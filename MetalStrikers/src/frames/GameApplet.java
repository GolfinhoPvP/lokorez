package frames;

import javax.swing.JApplet;
import panels.BattlePanel;

public class GameApplet extends JApplet{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private final int HEIGHT = 640, WIDTH = 480;
	
	public void init(){
		this.resize(HEIGHT,WIDTH);
		BattlePanel bp = new BattlePanel();
		this.add(bp);
	}	
}
