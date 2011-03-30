/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package DAOs;

import beans.Tipo;
import java.util.List;
import org.hibernate.Session;

/**
 *
 * @author Administrador
 */
public class TipoDAO {
    private Session session;

    TipoDAO(Session session) {
        this.session = session;
    }

    public void adiciona(Tipo q) {
        this.session.save(q);
    }

    public void remove (Tipo q) {
        this.session.delete(q);
    }

    public void atualiza (Tipo q) {
            this.session.merge(q);
    }

    public List<Tipo> listaTudo() {
    return this.session.createCriteria(Tipo.class).list();
    }

    public Tipo procura(Long id) {
        return (Tipo) session.load(Tipo.class, id);
    }
}
