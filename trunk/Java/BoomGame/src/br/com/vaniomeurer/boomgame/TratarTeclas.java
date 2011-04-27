package br.com.vaniomeurer.boomgame;

import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

/**
 * 
 * <strong>Copyright &#169; 2009 Vânio Stang Meurer.</strong></br>
 * <strong>BoomGame</strong></br> </br>
 * 
 * TratarTeclas </br>
 * 
 * @author <a href="http://www.vaniomeurer.com.br">Vanio Meurer</a></br>
 */
public class TratarTeclas implements KeyListener {

	@Override
	public void keyPressed(KeyEvent e) {
		int keyCode = e.getKeyCode();

		for (Personagem personagem : Logica.personagens) {
			Controle controle = personagem.getControle();
			if (keyCode == controle.getEsquerda()) {
				controle.botaoEsquerda = true;
			}
			if (keyCode == controle.getDireita()) {
				controle.botaoDireita = true;
			}
			if (keyCode == controle.getCima()) {
				controle.botaoCima = true;
			}
			if (keyCode == controle.getBaixo()) {
				controle.botaoBaixo = true;
			}
		}
	}

	@Override
	public void keyReleased(KeyEvent e) {
		int keyCode = e.getKeyCode();
		for (Personagem personagem : Logica.personagens) {
			Controle controle = personagem.getControle();
			if (keyCode == controle.getEsquerda()) {
				controle.botaoEsquerda = false;
			}
			if (keyCode == controle.getDireita()) {
				controle.botaoDireita = false;
			}
			if (keyCode == controle.getCima()) {
				controle.botaoCima = false;
			}
			if (keyCode == controle.getBaixo()) {
				controle.botaoBaixo = false;
			}
		}

	}

	@Override
	public void keyTyped(KeyEvent e) {
	}

}
