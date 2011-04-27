/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package beans;

import java.io.Serializable;
import javax.persistence.*;

/**
 *
 * @author Administrador
 */
@Entity
@Table(name = "tipo")
public class Tipo implements Serializable {
    @Id
    @GeneratedValue
    @Column(name = "tip_codigo", nullable = false)
    private int codigo;
    @Column(name = "tip_descricao", nullable = false, length=50)
    private String descricao;
    @Column(name = "tip_hora1")
    private double hora1;
    @Column(name = "tip_hora2")
    private double hora2;
    @Column(name = "tip_hora3")
    private double hora3;
    @Column(name = "tip_hora4")
    private double hora4;
    @Column(name = "tip_hora5")
    private double hora5;
    @Column(name = "tip_hora6")
    private double hora6;
    @Column(name = "tip_hora7")
    private double hora7;
    @Column(name = "tip_hora8")
    private double hora8;
    @Column(name = "tip_hora9")
    private double hora9;
    @Column(name = "tip_hora10")
    private double hora10;
    @Column(name = "tip_hora11")
    private double hora11;
    @Column(name = "tip_hora12")
    private double hora12;
    @Column(name = "tip_hora13")
    private double hora13;
    @Column(name = "tip_hora14")
    private double hora14;
    @Column(name = "tip_hora15")
    private double hora15;
    @Column(name = "tip_hora16")
    private double hora16;
    @Column(name = "tip_hora17")
    private double hora17;
    @Column(name = "tip_hora18")
    private double hora18;
    @Column(name = "tip_hora19")
    private double hora19;
    @Column(name = "tip_hora20")
    private double hora20;
    @Column(name = "tip_hora21")
    private double hora21;
    @Column(name = "tip_hora22")
    private double hora22;
    @Column(name = "tip_hora23")
    private double hora23;
    @Column(name = "tip_hora24")
    private double hora24;

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public double getHora1() {
        return hora1;
    }

    public void setHora1(double hora1) {
        this.hora1 = hora1;
    }

    public double getHora10() {
        return hora10;
    }

    public void setHora10(double hora10) {
        this.hora10 = hora10;
    }

    public double getHora11() {
        return hora11;
    }

    public void setHora11(double hora11) {
        this.hora11 = hora11;
    }

    public double getHora12() {
        return hora12;
    }

    public void setHora12(double hora12) {
        this.hora12 = hora12;
    }

    public double getHora13() {
        return hora13;
    }

    public void setHora13(double hora13) {
        this.hora13 = hora13;
    }

    public double getHora14() {
        return hora14;
    }

    public void setHora14(double hora14) {
        this.hora14 = hora14;
    }

    public double getHora15() {
        return hora15;
    }

    public void setHora15(double hora15) {
        this.hora15 = hora15;
    }

    public double getHora16() {
        return hora16;
    }

    public void setHora16(double hora16) {
        this.hora16 = hora16;
    }

    public double getHora17() {
        return hora17;
    }

    public void setHora17(double hora17) {
        this.hora17 = hora17;
    }

    public double getHora18() {
        return hora18;
    }

    public void setHora18(double hora18) {
        this.hora18 = hora18;
    }

    public double getHora19() {
        return hora19;
    }

    public void setHora19(double hora19) {
        this.hora19 = hora19;
    }

    public double getHora2() {
        return hora2;
    }

    public void setHora2(double hora2) {
        this.hora2 = hora2;
    }

    public double getHora20() {
        return hora20;
    }

    public void setHora20(double hora20) {
        this.hora20 = hora20;
    }

    public double getHora21() {
        return hora21;
    }

    public void setHora21(double hora21) {
        this.hora21 = hora21;
    }

    public double getHora22() {
        return hora22;
    }

    public void setHora22(double hora22) {
        this.hora22 = hora22;
    }

    public double getHora23() {
        return hora23;
    }

    public void setHora23(double hora23) {
        this.hora23 = hora23;
    }

    public double getHora24() {
        return hora24;
    }

    public void setHora24(double hora24) {
        this.hora24 = hora24;
    }

    public double getHora3() {
        return hora3;
    }

    public void setHora3(double hora3) {
        this.hora3 = hora3;
    }

    public double getHora4() {
        return hora4;
    }

    public void setHora4(double hora4) {
        this.hora4 = hora4;
    }

    public double getHora5() {
        return hora5;
    }

    public void setHora5(double hora5) {
        this.hora5 = hora5;
    }

    public double getHora6() {
        return hora6;
    }

    public void setHora6(double hora6) {
        this.hora6 = hora6;
    }

    public double getHora7() {
        return hora7;
    }

    public void setHora7(double hora7) {
        this.hora7 = hora7;
    }

    public double getHora8() {
        return hora8;
    }

    public void setHora8(double hora8) {
        this.hora8 = hora8;
    }

    public double getHora9() {
        return hora9;
    }

    public void setHora9(double hora9) {
        this.hora9 = hora9;
    }
}
