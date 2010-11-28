--[[
	Exemplo: escultando teclas
fsdfsdfsdfsd
--]]
	function desenha( valor )
	    canvas:attrColor (0,0,0,255);
	    canvas:clear();
	    canvas:attrColor (255,255,255,255);
	    canvas:attrFont ('vera', 20,'bold');
	    canvas:drawText (100, 100, valor);
	    canvas:flush();
	end
	 
	function keyListener(evt)
	    if evt.class == 'key' then
	        if evt.type == 'press' then
            if evt.key == 'CURSOR_UP' or evt.key == 'CURSOR_DOWN'
	                or evt.key == 'CURSOR_LEFT'  or evt.key == 'CURSOR_RIGHT' then
	                desenha('Seta: '..evt.key);
            elseif evt.key == 'RED' or evt.key == 'GREEN' or evt.key == 'YELLOW' or evt.key == 'BLUE' then
	                desenha('Colorido: '..evt.key);
	            elseif evt.key == '0' or evt.key == '1' or evt.key == '2' or evt.key == '3' or evt.key == '4'
	                or evt.key == '5' or evt.key == '6' or evt.key == '7' or evt.key == '8' or evt.key == '9'  then
	                desenha('Numerico: '..evt.key);
	            elseif evt.key == 'ENTER' then
	                desenha('Ok: '..evt.key);
	            end
	        end
    end
end
event.register(keyListener)