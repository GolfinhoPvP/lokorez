package br.com.vaniomeurer.boomgame;

import java.awt.image.BufferedImage;
import java.io.IOException;

import javax.imageio.ImageIO;

/**
 * 
 * <strong>Copyright &#169; 2009 Vânio Stang Meurer.</strong></br>
 * <strong>BoomGame</strong></br> </br>
 * 
 * Personagem </br>
 * 
 * @author <a href="http://www.vaniomeurer.com.br">Vanio Meurer</a></br>
 */
public class Personagem implements Comparable<Personagem> {

	private int id;
	private int posicaoX, posicaoY;
	private BufferedImage imagem;
	private int direcao = 2;
	private int velocidade;

	private Controle controle;

	private int life = 160;

	public final int tamanhoX, tamanhoY;
	public long anim = 1;

	public Personagem(int id, String img, int posicaoX, int posicaoY,
			int tamanhoX, int tamanhoY, int velocidade) {
		this.id = id;
		this.posicaoX = posicaoX;
		this.posicaoY = posicaoY;
		this.tamanhoX = tamanhoX;
		this.tamanhoY = tamanhoY;
		this.velocidade = velocidade;
		try {
			imagem = ImageIO.read(getClass().getClassLoader().getResource(img));
		} catch (IOException e) {
			System.out
					.println("Erro ao buscar imagem do personagem.\nEncerrando aplicação");
			System.exit(0);
		}
	}

	public void andar(int novaDirecao) {
		direcao = novaDirecao;
		anim++;
		switch (novaDirecao) {
		case 0:
			posicaoY -= (velocidade * Logica.temp) / 100;
			break;
		case 1:
			posicaoX += (velocidade * Logica.temp) / 100;
			break;
		case 2:
			posicaoY += (velocidade * Logica.temp) / 100;
			break;
		case 3:
			posicaoX -= (velocidade * Logica.temp) / 100;
			break;
		}
	}

	public int[] areaColisaoPe() {
		int[] posicoes = new int[4];
		posicoes[0] = posicaoX + 7;
		posicoes[1] = posicaoY + 23;
		posicoes[2] = posicaoX + tamanhoX - 7;
		posicoes[3] = posicaoY + tamanhoY;
		return posicoes;
	}

	public int getPosicaoX() {
		return posicaoX;
	}

	public void setPosicaoX(int posicaoX) {
		this.posicaoX = posicaoX;
	}

	public int getPosicaoY() {
		return posicaoY;
	}

	public void setPosicaoY(int posicaoY) {
		this.posicaoY = posicaoY;
	}

	public BufferedImage getImagem() {
		return imagem;
	}

	public int getDirecao() {
		return direcao;
	}

	public void setDirecao(int direcao) {
		this.direcao = direcao;
	}

	public int getId() {
		return id;
	}

	public int getLife() {
		return life;
	}

	public void setLife(int life) {
		this.life = life;
	}

	public Controle getControle() {
		return controle;
	}

	public void setControle(Controle controle) {
		this.controle = controle;
	}

	@Override
	public int hashCode() {
		final int prime = 31;
		int result = 1;
		result = prime * result + id;
		return result;
	}

	@Override
	public boolean equals(Object obj) {
		if (this == obj)
			return true;
		if (obj == null)
			return false;
		if (getClass() != obj.getClass())
			return false;
		Personagem other = (Personagem) obj;
		if (id != other.id)
			return false;
		return true;
	}

	@Override
	public int compareTo(Personagem o) {
		if (this.posicaoY > o.posicaoY) {
			return 1;
		}
		return -1;
	}

}
