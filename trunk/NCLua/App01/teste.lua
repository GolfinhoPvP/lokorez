function writeCaracter(crt,px,py,tx,ty,color)
	
	--px - Posi��o X
	--py - Posi��o Y
	--tx - Tamanho X
	--ty - Tamanho Y
	
	canvas:attrColor(color)
	canvas:drawRect('fill', px, py, tx, ty)
	
	canvas:attrColor(255 , 255 , 255 , 255)
	canvas:drawText(px , py, crt)
	
	canvas:flush()
	
end

function waitFor( t )
	t = t + event.uptime()
	while event.uptime()<t do end
end

function printImg()
	contador = 0
	x, y = 0, 0
	
	imagem = canvas:new("media/images/chemical.png")
	canvas:attrColor(0,0,0,255)
	
	while contador < 10 do
		imagem:clear(x, y, x+200, y+195)
		contador = contador + 1
		canvas:compose(x, y, imagem)
		canvas:flush()
		x = x + 10
		y = y + 10
		waitFor(100)
	end
end

writeCaracter("Cinemas Teresina",05,30,240,35,"red");
printImg();