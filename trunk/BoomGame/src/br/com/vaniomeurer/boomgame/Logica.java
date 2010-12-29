package br.com.vaniomeurer.boomgame;

import java.awt.event.KeyEvent;
import java.util.ArrayList;
import java.util.List;

/**
 * 
 * <strong>Copyright &#169; 2009 Vânio Stang Meurer.</strong></br>
 * <strong>BoomGame</strong></br> </br>
 * 
 * Logica </br>
 * 
 * @author <a href="http://www.vaniomeurer.com.br">Vanio Meurer</a></br>
 */
public class Logica implements Runnable {

	static long temp = 1;

	private GamePanel gamePanel;

	static List<Personagem> personagens = new ArrayList<Personagem>();

	final static int LARGURA = 320;
	final static int ALTURA = 320;

	// Váriavel para finalizar o jogo.
	private boolean running = true;

	public enum Direcao {
		CIMA, DIREITA, BAIXO, ESQUERDA
	}

	public Logica(GamePanel panel) {
		this.gamePanel = panel;

		// Criando personagens
		Controle controle1 = new Controle(KeyEvent.VK_UP, KeyEvent.VK_RIGHT,
				KeyEvent.VK_DOWN, KeyEvent.VK_LEFT);
		Personagem personagem1 = new Personagem(1, "Chara1.png", 100, 100, 24,
				32, 15);
		personagem1.setControle(controle1);
		personagens.add(personagem1);
		Controle controle2 = new Controle(KeyEvent.VK_W, KeyEvent.VK_D,
				KeyEvent.VK_S, KeyEvent.VK_A);
		Personagem personagem2 = new Personagem(2, "Chara1.png", 150, 150, 24,
				32, 15);
		personagem2.setControle(controle2);
		personagens.add(personagem2);

	}

	@Override
	public void run() {

		long tempAnterior = System.currentTimeMillis();
		Mapa mapa = new Mapa("mapa.png");
		mapa.montarMapa();

		while (running) {
			tratarJogo();
			gamePanel.renderizar();
			gamePanel.repaint();
			try {
				Thread.sleep(50);
			} catch (InterruptedException e) {
			}

			temp = System.currentTimeMillis() - tempAnterior;
			tempAnterior = System.currentTimeMillis();
		}

	}

	private void tratarJogo() {

		moverJogador();
		// Não temos mais montros
		// moverMonstros();
		tirarLife();

	}

	// Antes eu inseria monstros no mapa e eles corriam atras do personagem
	// principal, o código abaixo fazia os monstros se moverem.

	// @SuppressWarnings("unused")
	// private void moverMonstros() {
	// Personagem personagemPrincipal = personagens.get(0);
	//
	// for (int i = 1; i < personagens.size(); i++) {
	// Personagem personagem = personagens.get(i);
	//
	// int posXAnterior = personagem.getPosicaoX();
	// int posYAnterior = personagem.getPosicaoY();
	//
	// int difX = personagemPrincipal.getPosicaoX()
	// - personagem.getPosicaoX();
	// int difY = personagemPrincipal.getPosicaoY()
	// - personagem.getPosicaoY();
	//
	// double ang = Math.atan2(difY, difX);
	// double cosX = Math.cos(ang);
	// double senY = Math.sin(ang);
	//
	// if (cosX > 0) {
	// personagem.andar(Direcao.DIREITA.ordinal());
	// }
	// if (cosX < 0) {
	// personagem.andar(Direcao.ESQUERDA.ordinal());
	// }
	// if (senY > 0) {
	// personagem.andar(Direcao.BAIXO.ordinal());
	// }
	// if (senY < 0) {
	// personagem.andar(Direcao.CIMA.ordinal());
	// }
	// tratarColisao(personagem, posXAnterior, posYAnterior);
	//
	// tratarSairTela(personagem, posXAnterior, posYAnterior);
	//
	// }
	// }

	private void moverJogador() {
		for (Personagem personagemPrincipal : personagens) {
			Controle controle = personagemPrincipal.getControle();
			int posXAnterior = personagemPrincipal.getPosicaoX();
			int posYAnterior = personagemPrincipal.getPosicaoY();

			if (controle.botaoCima) {
				personagemPrincipal.andar(Direcao.CIMA.ordinal());
			}
			if (controle.botaoBaixo) {
				personagemPrincipal.andar(Direcao.BAIXO.ordinal());
			}
			if (controle.botaoDireita) {
				personagemPrincipal.andar(Direcao.DIREITA.ordinal());
			}
			if (controle.botaoEsquerda) {
				personagemPrincipal.andar(Direcao.ESQUERDA.ordinal());
			}

			tratarColisao(personagemPrincipal, posXAnterior, posYAnterior);

			tratarSairTela(personagemPrincipal, posXAnterior, posYAnterior);
		}

	}

	private void tratarSairTela(Personagem personagem, int posX, int posY) {

		if ((personagem.getPosicaoX() < 0)
				|| ((personagem.getPosicaoX() + personagem.tamanhoX) > LARGURA)) {
			personagem.setPosicaoX(posX);
		}
		if ((personagem.getPosicaoY() < 0)
				|| ((personagem.getPosicaoY() + personagem.tamanhoY) > ALTURA)) {
			personagem.setPosicaoY(posY);
		}
	}

	private void tratarColisao(Personagem personagem, int posXAnterior,
			int posYAnterior) {
		for (Personagem personagemTemp : personagens) {
			if (!personagem.equals(personagemTemp)) {

				int[] areaColisao = personagem.areaColisaoPe();
				int[] areaColisaoTemp = personagemTemp.areaColisaoPe();

				if ((areaColisaoTemp[0] < areaColisao[2])
						&& (areaColisaoTemp[2] > areaColisao[0])
						&& (areaColisaoTemp[1] < areaColisao[3])
						&& (areaColisaoTemp[3] > areaColisao[1])) {
					personagem.setPosicaoX(posXAnterior);
					personagem.setPosicaoY(posYAnterior);
				}

			}
		}
	}

	private void tirarLife() {
		for (Personagem personagem : personagens) {
			int[] areaColisao = personagem.areaColisaoPe();
			if (Mapa.arena[areaColisao[0] >> 4][areaColisao[1] >> 4] == 1
					|| Mapa.arena[areaColisao[2] >> 4][areaColisao[3] >> 4] == 1) {
				personagem.setLife(personagem.getLife() - 5);

			}
		}

	}

}
