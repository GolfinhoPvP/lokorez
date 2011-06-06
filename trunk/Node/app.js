require.paths.unshift("/usr/lib/node");
var express = require("express");
//var jade = require("jade");

var app = express.createServer();

//NODE_ENV=development
app.configure("development", function(){
  app.use(express.logger());
  app.use(express.errorHandler({
    dumpException: true,
    showStack: true
  }));
});

//NODE_ENV=production
app.configure("production", function(){
  app.use(express.logger());
  app.use(express.errorHandler());
});

app.set("views", __dirname+"/views");
app.set("view engine", "jade");
app.set("view options", {layout: true});

app.get("/", function(req, res){
  res.render("root", {locals:{nick:"zerokol"}});
  /*jade.renderFile(__dirname+"/views/root.jade", {locals:{nick:"zerokol"}}, function(err, html){
        res.send(html);
  });*/
});

app.listen(8080);
