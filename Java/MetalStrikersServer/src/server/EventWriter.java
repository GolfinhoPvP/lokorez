package server;

import java.nio.ByteBuffer;
import java.nio.channels.SocketChannel;
import common.GameEvent;
import common.Globals;
import common.NIOUtils;
import common.Player;
import common.Wrap;

public class EventWriter extends Wrap {
    /** reference to the GameServer */
    private static GameServer gameServer;
    
    /** 
     * contructor.
     */
    public EventWriter(GameServer gameServer, int numWorkers) {
		this.gameServer = gameServer;
		initWrap(numWorkers);
    }

    /** 
     * note we override the Wrap's run method here
     * doing essentially the same thing, but 
     * first we allocate a ByteBuffer for this
     * thread to use
     */
    public void run() {
	 	ByteBuffer writeBuffer = ByteBuffer.allocateDirect(Globals.MAX_EVENT_SIZE);
	
		GameEvent event;
		running = true;
		while (running) {
		    try {
			if ((event = eventQueue.deQueue()) != null) {
			    processEvent(event, writeBuffer);
			}
		    }
		    catch(InterruptedException e) {
		    }
		}
    }

    /** 
     * our own version of processEvent that takes 
     * the additional parameter of the writeBuffer 
     */
    protected void processEvent(GameEvent event, ByteBuffer writeBuffer) {
		NIOUtils.prepBuffer(event, writeBuffer);
		
		String[] recipients = event.getRecipients();
		if (recipients == null) {
		    log.info("writeEvent: type=" + event.getType() + ", id=" + 
			     event.getPlayerId() + ", msg=" + event.getMessage());
		    String playerId = event.getPlayerId();
		    write(playerId, writeBuffer);
		}else {
		    for (int i = 0; i < recipients.length; i++) {
			if (recipients[i] != null) {
			    log.info("writeEvent(B): type=" + event.getType() + ", id=" + 
				     recipients[i] + ", msg=" + event.getMessage());
			    write(recipients[i], writeBuffer);
			}
		    }
		}
    }
    
    /**
     * write the event to the given playerId's channel
     */
    private void write( String playerId, ByteBuffer writeBuffer) {	
		Player player = gameServer.getPlayerById(playerId);
		SocketChannel channel = player.getChannel();
		
		if (channel == null || !channel.isConnected()) {
		    log.error("writeEvent: client channel null or not connected");
		    return;
		}
		
		NIOUtils.channelWrite(channel, writeBuffer);
    }

	@Override
	protected void processEvent(GameEvent event) {
		// TODO Auto-generated method stub
	} 
}// EventWriter



