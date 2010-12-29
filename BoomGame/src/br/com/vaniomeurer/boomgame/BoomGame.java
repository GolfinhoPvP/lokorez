package br.com.vaniomeurer.boomgame;

import java.awt.BorderLayout;

import javax.swing.JFrame;

/**
 * 
 * <strong>Copyright &#169; 2009 Vânio Stang Meurer.</strong></br>
 * <strong>BoomGame</strong></br> </br>
 * 
 * BoomGame </br> Classe que inicia o jogo (DESKTOP)
 * 
 * @author <a href="http://www.vaniomeurer.com.br">Vanio Meurer</a></br>
 */
public class BoomGame {

	public static void main(String[] args) {
		GamePanel gp = new GamePanel();
		Logica logicas = new Logica(gp);
		new Thread(logicas).start();

		gp.addKeyListener(new TratarTeclas());

		JFrame frame = new JFrame("BoomGame - O jogo que é um estouro!");
		frame.getContentPane().add(gp, BorderLayout.CENTER);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.pack();
		frame.setResizable(false);
		frame.setLocationRelativeTo(null);
		frame.setVisible(true);
	}

}
