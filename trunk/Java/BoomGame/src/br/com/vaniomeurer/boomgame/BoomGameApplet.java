package br.com.vaniomeurer.boomgame;

import java.awt.BorderLayout;

import javax.swing.JApplet;

/**
 * 
 * <strong>Copyright &#169; 2009 Vânio Stang Meurer.</strong></br>
 * <strong>BoomGame</strong></br> </br>
 * 
 * BoomGameApplet </br> Classe que inicia o jogo (WEB)
 * 
 * @author <a href="http://www.vaniomeurer.com.br">Vanio Meurer</a></br>
 */
@SuppressWarnings("serial")
public class BoomGameApplet extends JApplet {

	@Override
	public void init() {

		GamePanel gp = new GamePanel();
		Logica logicas = new Logica(gp);
		new Thread(logicas).start();

		gp.addKeyListener(new TratarTeclas());

		this.add(gp, BorderLayout.CENTER);
		this.setSize(320, 320);

	}

}
