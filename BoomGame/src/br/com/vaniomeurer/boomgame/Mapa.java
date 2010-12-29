package br.com.vaniomeurer.boomgame;

import java.awt.image.BufferedImage;
import java.io.IOException;

import javax.imageio.ImageIO;

/**
 * 
 * <strong>Copyright &#169; 2009 Vânio Stang Meurer.</strong></br>
 * <strong>BoomGame</strong></br> </br>
 * 
 * Mapa </br>
 * 
 * @author <a href="http://www.vaniomeurer.com.br">Vanio Meurer</a></br>
 */
public class Mapa {

	private BufferedImage tileSet;
	public static BufferedImage mapa;

	private final int tamanhoTileX = 16;
	private final int tamanhoTileY = 16;

	static int arena[][] = new int[][] {
			{ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 1, 1, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1 },
			{ 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1 },
			{ 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1 },
			{ 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1 },
			{ 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1 },
			{ 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 1, 1, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 },
			{ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 } };

	public Mapa(String img) {
		try {
			tileSet = ImageIO.read(this.getClass().getClassLoader()
					.getResource("mapa.png"));
		} catch (IOException e) {
			System.out
					.println("Erro ao buscar imagem do mapa.\nEncerrando aplicação");
			System.exit(0);
		}
	}

	public void montarMapa() {

		mapa = new BufferedImage(320, 320, BufferedImage.TYPE_4BYTE_ABGR);

		int posX = 0;
		int posY = 0;
		for (int i = 0; i < 20; i++) {
			for (int j = 0; j < 20; j++) {
				mapa.getGraphics().drawImage(tileSet, posX, posY,
						posX + tamanhoTileX, posY + tamanhoTileY,
						arena[i][j] == 1 ? 0 : 1 << 4, 0, arena[i][j] << 4, 16,
						null);
				posY += 16;
			}
			posX += 16;
			posY = 0;
		}

	}
}
