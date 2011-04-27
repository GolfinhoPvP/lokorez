package common;

import java.nio.ByteBuffer;

public interface GameEvent {
    public int getType();
    public void setType(int type);
    
    public String getGameName();
    public void setGameName(String gameName);
	
    public String getMessage();
    public void setMessage(String message);
    
    public String getPlayerId();
    public void setPlayerId(String id);
    
    public String getSessionId();
    public void setSessionId(String id);

    public String[] getRecipients();
    public void setRecipients(String[] recipients);

    public void read(ByteBuffer buff);
    public int write(ByteBuffer buff);
}

