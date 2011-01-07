package server;

import java.nio.*;
import java.nio.channels.*;
import java.util.*;
import java.net.*;
import java.io.*;
import org.apache.log4j.*;

import common.Globals;

public class MetalStrikersGameServer extends Thread {
	/**
	 * 
	 */
    private Logger log = Logger.getLogger("GameServer");

    /** ServerSocketChannel for accepting client connections */ 
    private ServerSocketChannel serverSocketChannel;
    /** selector for multiplexing ServerSocketChannels */
    private Selector selector;
    /** players keyed by playerId */
    @SuppressWarnings("rawtypes")
	private static Hashtable playersByPlayerId;
    /** players keyed by sessionId */
    @SuppressWarnings("rawtypes")
	private static Hashtable playersBySessionId;
    private boolean running;
    private SelectAndRead selectAndRead;
    private EventWriter eventWriter;

    private static long nextSessionId = 0;

    public static void main(String args[]) {
		BasicConfigurator.configure();
		MetalStrikersGameServer msgs = new MetalStrikersGameServer();
		msgs.start();
    }

    @SuppressWarnings("rawtypes")
	public MetalStrikersGameServer() {
		playersByPlayerId = new Hashtable();
	  	playersBySessionId = new Hashtable();
    }

    public void init() {
		log.info("GameServer initializing");
	
		loadGameControllers();
		initServerSocket();
	
		selectAndRead = new SelectAndRead(this);
		selectAndRead.start();
	
		eventWriter = new EventWriter(this, Globals.EVENT_WRITER_WORKERS); 
    }

    private void initServerSocket() {
		try {
		    // open a non-blocking server socket channel
		    serverSocketChannel = ServerSocketChannel.open();
		    serverSocketChannel.configureBlocking(false);
	
		    // bind to localhost on designated port
		    InetAddress addr = InetAddress.getLocalHost();
		    log.info("binding to address: " + addr.getHostAddress());
		    serverSocketChannel.socket().bind(new InetSocketAddress(addr, Globals.PORT));
		    
		    // get a selector
		    selector = Selector.open();
	
		    // register the channel with the selector to handle accepts
		    SelectionKey acceptKey = serverSocketChannel.register(selector, SelectionKey.OP_ACCEPT);
		}
		catch (Exception e) {
		    log.error("error initializing ServerSocket", e);
		    System.exit(1);
		}
    }

    public void run() {
		init();
		log.info("******** GameServer running ********");
		running = true;
		int numReady = 0;
	
		while (running) {
		    // note, since we only have one ServerSocket to listen to,
		    // we don't need a Selector here, but we set it up for 
		    // later additions such as listening on another port 
		    // for administrative uses.
		    try {
				// blocking select, will return when we get a new connection
				selector.select();
				
				// fetch the keys
				@SuppressWarnings("rawtypes")
				Set readyKeys = selector.selectedKeys();
				
				// run through the keys and process
				@SuppressWarnings("rawtypes")
				Iterator i = readyKeys.iterator();
				while (i.hasNext()) {
				    SelectionKey key = (SelectionKey) i.next();
				    i.remove();
				    
				    ServerSocketChannel ssChannel = (ServerSocketChannel) key.channel();
				    SocketChannel clientChannel = ssChannel.accept();
				    
				    // add to the list in SelectAndRead for processing
				    selectAndRead.addNewClient(clientChannel);
				    log.info("got connection from: " + clientChannel.socket().getInetAddress());
				}		
		    }catch (IOException ioe) {
		    	log.warn("error during serverSocket select(): " + ioe.getMessage());
		    }catch (Exception e) {
		    	log.error("exception in run()", e);
		    }
		}
    }

    public void shutdown() {
    	selector.wakeup();
    }

    public synchronized String nextSessionId() {
    	return "" + nextSessionId++;
    }
    
    public void writeEvent(GameEvent e) {
    	eventWriter.handleEvent(e);
    }

    public GameConfig getGameConfig(String gameName) {
    	// todo: implement getGameConfig()
    	return null;
    }
   
    public static Player getPlayerById( String id) {
    	return (Player) playersByPlayerId.get(id);
    }

    public static Player getPlayerBySessionId(String id) {
    	return (Player) playersBySessionId.get(id);
    }

    public static void addPlayer(Player p) {
		playersByPlayerId.put(p.getPlayerId(), p);
		playersBySessionId.put(p.getSessionId(), p);
    }
    
    public static void removePlayer(Player p) {
		playersByPlayerId.remove(p.getPlayerId());
		playersBySessionId.remove(p.getPlayerId());
    }
}