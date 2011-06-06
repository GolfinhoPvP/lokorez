var http = require('http');

var server = http.createServer(
	function(req, res){
		res.writeHead(200, {'content-type' : 'text-plain'});
		console.log(req);
		console.warn("isso foi um aviso");
		console.error("isso foi um erro");
		res.end('hello world!\n	');	
	}
);

server.listen(8000);
