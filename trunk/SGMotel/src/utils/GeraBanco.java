/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package utils;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.cfg.AnnotationConfiguration;
import org.hibernate.cfg.Configuration;
import org.hibernate.tool.hbm2ddl.SchemaExport;

/**
 *
 * @author zerokol
 */
public class GeraBanco {
    public static void main(String[] args) {
        Configuration conf = new AnnotationConfiguration();
        conf.configure();
        SchemaExport se = new SchemaExport(conf);
        se.create(true, true);
        SessionFactory factory = conf.buildSessionFactory();
        Session session = factory.openSession();
    }
}
