/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package DAOs;

import beans.Quarto;
import java.util.List;
import org.hibernate.Session;

/**
 *
 * @author Administrador
 */
public class QuartoDAO {
    private Session session;

    QuartoDAO(Session session) {
        this.session = session;
    }
    
    public void adiciona(Quarto q) {
        this.session.save(q);
    }

    public void remove (Quarto q) {
        this.session.delete(q);
    }

    public void atualiza (Quarto q) {
            this.session.merge(q);
    }

    public List<Quarto> listaTudo() {
    return this.session.createCriteria(Quarto.class).list();
    }

    public Quarto procura(Long id) {
        return (Quarto) session.load(Quarto.class, id);
    }
}
