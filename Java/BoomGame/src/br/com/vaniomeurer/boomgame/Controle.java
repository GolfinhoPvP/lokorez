package br.com.vaniomeurer.boomgame;

/**
 * 
 * <strong>Copyright &#169; 2009 Vânio Stang Meurer.</strong></br>
 * <strong>BoomGame</strong></br> </br>
 * 
 * Controle </br>
 * 
 * @author <a href="http://www.vaniomeurer.com.br">Vanio Meurer</a></br>
 */
public class Controle {

	private final int cima;
	private final int direita;
	private final int baixo;
	private final int esquerda;

	boolean botaoCima = false;
	boolean botaoDireita = false;
	boolean botaoBaixo = false;
	boolean botaoEsquerda = false;

	public Controle(int cima, int direita, int baixo, int esquerda) {
		this.cima = cima;
		this.direita = direita;
		this.baixo = baixo;
		this.esquerda = esquerda;
	}

	public int getDireita() {
		return direita;
	}

	public int getCima() {
		return cima;
	}

	public int getBaixo() {
		return baixo;
	}

	public int getEsquerda() {
		return esquerda;
	}

}
