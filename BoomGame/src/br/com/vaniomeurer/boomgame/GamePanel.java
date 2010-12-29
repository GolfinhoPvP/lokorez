package br.com.vaniomeurer.boomgame;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.image.BufferedImage;

import javax.swing.JPanel;

/**
 * 
 * <strong>Copyright &#169; 2009 Vânio Stang Meurer.</strong></br>
 * <strong>BoomGame</strong></br> </br>
 * 
 * GamePanel </br>
 * 
 * @author <a href="http://www.vaniomeurer.com.br">Vanio Meurer</a></br>
 */
public class GamePanel extends JPanel {

	private static final long serialVersionUID = 1L;

	private BufferedImage tela = new BufferedImage(Logica.LARGURA,
			Logica.ALTURA, BufferedImage.TYPE_4BYTE_ABGR);

	public GamePanel() {
		setPreferredSize(new Dimension(Logica.LARGURA, Logica.ALTURA));

		setFocusable(true);
		requestFocus();
	}

	public void renderizar() {

		Graphics2D dbg = (Graphics2D) tela.getGraphics();

		dbg.drawImage(Mapa.mapa, 0, 0, null);

		for (Personagem personagem : Logica.personagens) {

			dbg.setColor(Color.RED);
			dbg.fillRect(personagem.getPosicaoX() + 2,
					personagem.getPosicaoY() - 3, personagem.getLife() >> 3, 3);

			dbg.drawImage(personagem.getImagem(), personagem.getPosicaoX(),
					personagem.getPosicaoY() - 5, personagem.getPosicaoX()
							+ personagem.tamanhoX, personagem.getPosicaoY()
							+ personagem.tamanhoY, (int) (personagem.anim % 3)
							* personagem.tamanhoX, personagem.getDirecao()
							* personagem.tamanhoY,
					(int) (personagem.anim % 3 * personagem.tamanhoX)
							+ personagem.tamanhoX,
					(personagem.getDirecao() * personagem.tamanhoY)
							+ personagem.tamanhoY, null);

		}

	}

	public void paintComponent(Graphics g) {
		super.paintComponents(g);
		g.drawImage(tela, 0, 0, null);
	}

}
