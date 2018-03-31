var express = require('express');
var app = express();
var sqlite = require('sqlite3').verbose();

var db = new sqlite.Database('/files.db');

app.listen(8080);
console.log("App listening in the port 8080");