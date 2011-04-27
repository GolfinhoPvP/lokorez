package common;

import java.nio.channels.SocketChannel;

public interface Player {
    public String getPlayerId();
    public void setPlayerId(String id);

    public String getSessionId();
    public void setSessionId(String id);

    public SocketChannel getChannel();
    public void setChannel(SocketChannel channel);

    public boolean loggedIn();
    public void setLoggedIn(boolean in);

    public boolean inGame();
    public void setInGame(boolean in);

    public int getGameId();
    public void setGameId(int gid);
}
