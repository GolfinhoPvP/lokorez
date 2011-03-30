/*
 * SGMotelView.java
 */

package sgmotel;

import java.awt.BorderLayout;
import org.jdesktop.application.Action;
import org.jdesktop.application.ResourceMap;
import org.jdesktop.application.SingleFrameApplication;
import org.jdesktop.application.FrameView;
import org.jdesktop.application.TaskMonitor;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.Timer;
import javax.swing.Icon;
import javax.swing.JDialog;
import javax.swing.JFrame;
import telas.CadastrarQuarto;

/**
 * The application's main frame.
 */
public class SGMotelView extends FrameView {

    public SGMotelView(SingleFrameApplication app) {
        super(app);

        initComponents();

        // status bar initialization - message timeout, idle icon and busy animation, etc
        ResourceMap resourceMap = getResourceMap();
        int messageTimeout = resourceMap.getInteger("StatusBar.messageTimeout");
        messageTimer = new Timer(messageTimeout, new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                statusMessageLabel.setText("");
            }
        });
        messageTimer.setRepeats(false);
        int busyAnimationRate = resourceMap.getInteger("StatusBar.busyAnimationRate");
        for (int i = 0; i < busyIcons.length; i++) {
            busyIcons[i] = resourceMap.getIcon("StatusBar.busyIcons[" + i + "]");
        }
        busyIconTimer = new Timer(busyAnimationRate, new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                busyIconIndex = (busyIconIndex + 1) % busyIcons.length;
                statusAnimationLabel.setIcon(busyIcons[busyIconIndex]);
            }
        });
        idleIcon = resourceMap.getIcon("StatusBar.idleIcon");
        statusAnimationLabel.setIcon(idleIcon);
        progressBar.setVisible(false);

        // connecting action tasks to status bar via TaskMonitor
        TaskMonitor taskMonitor = new TaskMonitor(getApplication().getContext());
        taskMonitor.addPropertyChangeListener(new java.beans.PropertyChangeListener() {
            public void propertyChange(java.beans.PropertyChangeEvent evt) {
                String propertyName = evt.getPropertyName();
                if ("started".equals(propertyName)) {
                    if (!busyIconTimer.isRunning()) {
                        statusAnimationLabel.setIcon(busyIcons[0]);
                        busyIconIndex = 0;
                        busyIconTimer.start();
                    }
                    progressBar.setVisible(true);
                    progressBar.setIndeterminate(true);
                } else if ("done".equals(propertyName)) {
                    busyIconTimer.stop();
                    statusAnimationLabel.setIcon(idleIcon);
                    progressBar.setVisible(false);
                    progressBar.setValue(0);
                } else if ("message".equals(propertyName)) {
                    String text = (String)(evt.getNewValue());
                    statusMessageLabel.setText((text == null) ? "" : text);
                    messageTimer.restart();
                } else if ("progress".equals(propertyName)) {
                    int value = (Integer)(evt.getNewValue());
                    progressBar.setVisible(true);
                    progressBar.setIndeterminate(false);
                    progressBar.setValue(value);
                }
            }
        });
    }

    @Action
    public void showAboutBox() {
        if (aboutBox == null) {
            JFrame mainFrame = SGMotelApp.getApplication().getMainFrame();
            aboutBox = new SGMotelAboutBox(mainFrame);
            aboutBox.setLocationRelativeTo(mainFrame);
        }
        SGMotelApp.getApplication().show(aboutBox);
    }

    /** This method is called from within the constructor to
     * initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is
     * always regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        telaPrincipal = new javax.swing.JPanel();
        jLabel1 = new javax.swing.JLabel();
        BarraMenu = new javax.swing.JMenuBar();
        javax.swing.JMenu Arquivo = new javax.swing.JMenu();
        javax.swing.JMenuItem Sair = new javax.swing.JMenuItem();
        Cadastro = new javax.swing.JMenu();
        cadastrar = new javax.swing.JMenu();
        cadTipQaurto = new javax.swing.JMenuItem();
        cadQuarto = new javax.swing.JMenuItem();
        javax.swing.JMenu Ajuda = new javax.swing.JMenu();
        javax.swing.JMenuItem Sobre = new javax.swing.JMenuItem();
        barraStatus = new javax.swing.JPanel();
        javax.swing.JSeparator statusPanelSeparator = new javax.swing.JSeparator();
        statusMessageLabel = new javax.swing.JLabel();
        statusAnimationLabel = new javax.swing.JLabel();
        progressBar = new javax.swing.JProgressBar();

        telaPrincipal.setName("telaPrincipal"); // NOI18N

        org.jdesktop.application.ResourceMap resourceMap = org.jdesktop.application.Application.getInstance(sgmotel.SGMotelApp.class).getContext().getResourceMap(SGMotelView.class);
        jLabel1.setText(resourceMap.getString("jLabel1.text")); // NOI18N
        jLabel1.setName("jLabel1"); // NOI18N

        javax.swing.GroupLayout telaPrincipalLayout = new javax.swing.GroupLayout(telaPrincipal);
        telaPrincipal.setLayout(telaPrincipalLayout);
        telaPrincipalLayout.setHorizontalGroup(
            telaPrincipalLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(telaPrincipalLayout.createSequentialGroup()
                .addGap(164, 164, 164)
                .addComponent(jLabel1)
                .addContainerGap(442, Short.MAX_VALUE))
        );
        telaPrincipalLayout.setVerticalGroup(
            telaPrincipalLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(telaPrincipalLayout.createSequentialGroup()
                .addGap(133, 133, 133)
                .addComponent(jLabel1)
                .addContainerGap(285, Short.MAX_VALUE))
        );

        BarraMenu.setName("BarraMenu"); // NOI18N

        Arquivo.setText(resourceMap.getString("Arquivo.text")); // NOI18N
        Arquivo.setName("Arquivo"); // NOI18N

        javax.swing.ActionMap actionMap = org.jdesktop.application.Application.getInstance(sgmotel.SGMotelApp.class).getContext().getActionMap(SGMotelView.class, this);
        Sair.setAction(actionMap.get("quit")); // NOI18N
        Sair.setText(resourceMap.getString("Sair.text")); // NOI18N
        Sair.setName("Sair"); // NOI18N
        Arquivo.add(Sair);

        BarraMenu.add(Arquivo);

        Cadastro.setText(resourceMap.getString("Cadastro.text")); // NOI18N
        Cadastro.setName("Cadastro"); // NOI18N

        cadastrar.setText(resourceMap.getString("cadastrar.text")); // NOI18N
        cadastrar.setName("cadastrar"); // NOI18N

        cadTipQaurto.setAccelerator(javax.swing.KeyStroke.getKeyStroke(java.awt.event.KeyEvent.VK_T, java.awt.event.InputEvent.CTRL_MASK));
        cadTipQaurto.setText(resourceMap.getString("cadTipQaurto.text")); // NOI18N
        cadTipQaurto.setName("cadTipQaurto"); // NOI18N
        cadastrar.add(cadTipQaurto);

        cadQuarto.setAccelerator(javax.swing.KeyStroke.getKeyStroke(java.awt.event.KeyEvent.VK_N, java.awt.event.InputEvent.CTRL_MASK));
        cadQuarto.setText(resourceMap.getString("cadQuarto.text")); // NOI18N
        cadQuarto.setName("cadQuarto"); // NOI18N
        cadQuarto.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                cadQuartoActionPerformed(evt);
            }
        });
        cadastrar.add(cadQuarto);

        Cadastro.add(cadastrar);

        BarraMenu.add(Cadastro);

        Ajuda.setText(resourceMap.getString("Ajuda.text")); // NOI18N
        Ajuda.setName("Ajuda"); // NOI18N

        Sobre.setAction(actionMap.get("showAboutBox")); // NOI18N
        Sobre.setText(resourceMap.getString("Sobre.text")); // NOI18N
        Sobre.setName("Sobre"); // NOI18N
        Ajuda.add(Sobre);

        BarraMenu.add(Ajuda);

        barraStatus.setName("barraStatus"); // NOI18N

        statusPanelSeparator.setName("statusPanelSeparator"); // NOI18N

        statusMessageLabel.setName("statusMessageLabel"); // NOI18N

        statusAnimationLabel.setHorizontalAlignment(javax.swing.SwingConstants.LEFT);
        statusAnimationLabel.setName("statusAnimationLabel"); // NOI18N

        progressBar.setName("progressBar"); // NOI18N

        javax.swing.GroupLayout barraStatusLayout = new javax.swing.GroupLayout(barraStatus);
        barraStatus.setLayout(barraStatusLayout);
        barraStatusLayout.setHorizontalGroup(
            barraStatusLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(statusPanelSeparator, javax.swing.GroupLayout.DEFAULT_SIZE, 640, Short.MAX_VALUE)
            .addGroup(barraStatusLayout.createSequentialGroup()
                .addContainerGap()
                .addComponent(statusMessageLabel)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, 466, Short.MAX_VALUE)
                .addComponent(progressBar, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(statusAnimationLabel)
                .addContainerGap())
        );
        barraStatusLayout.setVerticalGroup(
            barraStatusLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(barraStatusLayout.createSequentialGroup()
                .addComponent(statusPanelSeparator, javax.swing.GroupLayout.PREFERRED_SIZE, 2, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addGroup(barraStatusLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(statusMessageLabel)
                    .addComponent(statusAnimationLabel)
                    .addComponent(progressBar, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(3, 3, 3))
        );

        setComponent(telaPrincipal);
        setMenuBar(BarraMenu);
        setStatusBar(barraStatus);
    }// </editor-fold>//GEN-END:initComponents

    private void cadQuartoActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_cadQuartoActionPerformed
        CadastrarQuarto qc = new CadastrarQuarto();
        telaPrincipal.add(qc);
        telaPrincipal.repaint();
        telaPrincipal.setVisible(false);
    }//GEN-LAST:event_cadQuartoActionPerformed

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JMenuBar BarraMenu;
    private javax.swing.JMenu Cadastro;
    private javax.swing.JPanel barraStatus;
    private javax.swing.JMenuItem cadQuarto;
    private javax.swing.JMenuItem cadTipQaurto;
    private javax.swing.JMenu cadastrar;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JProgressBar progressBar;
    private javax.swing.JLabel statusAnimationLabel;
    private javax.swing.JLabel statusMessageLabel;
    private javax.swing.JPanel telaPrincipal;
    // End of variables declaration//GEN-END:variables

    private final Timer messageTimer;
    private final Timer busyIconTimer;
    private final Icon idleIcon;
    private final Icon[] busyIcons = new Icon[15];
    private int busyIconIndex = 0;

    private JDialog aboutBox;
}