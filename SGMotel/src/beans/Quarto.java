/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package beans;

import java.io.Serializable;
import javax.persistence.*;

/**
 *
 * @author zerokol
 */
@Entity
@Table(name = "quarto")
public class Quarto implements Serializable{
    @Id
    @GeneratedValue
    @Column(name = "qua_codigo", nullable = false)
    private int codigo;
    @Column(name = "tip_codigo", nullable = false)
    private int tipCodigo;
    @Column(name = "qua_nome", nullable = false, length=50)
    private String nome;

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public int getTipCodigo() {
        return tipCodigo;
    }

    public void setTipCodigo(int tipCodigo) {
        this.tipCodigo = tipCodigo;
    }
}
