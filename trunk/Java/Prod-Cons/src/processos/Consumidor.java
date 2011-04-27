/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package processos;

import beans.Item;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author zerokol
 */
public class Consumidor extends Thread {

    private long tempo;
    ArrayList<Item> bf = new ArrayList<Item>();
    private boolean pausado;
    private double variacao;

    public Consumidor(String str, ArrayList<Item> arl) {
        super(str);
        bf = arl;
        pausado = false;
        variacao = 2.5;
    }

    @Override
    @SuppressWarnings("static-access")
    public void run() {
        while (1 == 1) {
            try {
                dormir();
                if (bf.size() >= 1) {
                    bf.get(0);
                    //tempo = (long) (bf.get(0).getTempo() * (Math.random() + 2));
                    //tempo = (long) bf.get(0).getTempo();
                    //tempo = (long) (bf.get(0).getTempo() / 2);
                    tempo = (long) (bf.get(0).getTempo() + 1000 * variacao);
                    
                    bf.remove(0);
                } else {
                    tempo = (long) (500 * (Math.random() + 1));
                }
                //System.out.print("\nCons: " + tempo + "bf: " + bf.size());
                sleep(tempo + 500);
            } catch (InterruptedException ex) {
                Logger.getLogger(Consumidor.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
    }

    public void setestado(boolean estd) throws InterruptedException {
        pausado = estd;
        if (!pausado) {
            acordar();
        }
    }

    public synchronized void dormir() throws InterruptedException {
        while (pausado) {
            wait();
        }
    }

    public synchronized void acordar() throws InterruptedException {
        notify();
    }

    public void setVariacao(double variacao) {
        this.variacao = variacao;
    }
}
