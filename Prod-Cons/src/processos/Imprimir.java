/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package processos;

import beans.Item;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JTable;

/**
 *
 * @author zerokol
 */
public class Imprimir extends Thread {

    private Item i = new Item();
    ArrayList<Item> bf = new ArrayList<Item>();
    private boolean pausado;
    JTable tab;

    public Imprimir(String str, ArrayList<Item> arl, JTable tab) {
        //public Imprimir(String str, ArrayList<Item> arl) {
        super(str);
        bf = arl;
        this.tab = tab;
        pausado = true;
    }

    @Override
    public void run() {
        while (true) {
            try {
                /*//dormir();
                System.out.print("\n\n+++++++++++++++++ " + bf.size());
                if (bf.size() > 0) {
                for (int x = 0; x < bf.size(); x++) {
                //for (int x = 0; x < 1; x++) {
                i = bf.get(x);
                System.out.print("Nome: " + i.getNome());
                System.out.print("\nCor: " + i.getCor());
                System.out.print("\nValor: " + i.getValor());
                }
                }*/
                if (bf.size() > 0) {
                    for (int x = 0; x < bf.size(); x++) {
                        i = bf.get(x);
                        tab.setValueAt(i.getNome(), 0, x);
                        tab.setValueAt(i.getCor(), 1, x);
                        tab.setValueAt(i.getValor(), 2, x);
                    }
                }
                sleep(500);
            } catch (InterruptedException ex) {
                Logger.getLogger(Imprimir.class.getName()).log(Level.SEVERE, null, ex);
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
}
