var express = require('express');
var http = require('http');
var path = require("path");

//connect().use(serveStatic(__dirname)).listen(8080);

app = express();

app.use(express.static(path.resolve(__dirname,"public")));

http.Server(app).listen(8080);