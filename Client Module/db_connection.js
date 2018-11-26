/** ------------ Connection to Database ------------*/
var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "db"
});
/** ------------ Connection to Database ------------*/

/** ------------ Queries from the Database ------------*/
con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
  
  
  con.query("SELECT * FROM user", function (err, result, fields) {
    if (err) throw err;
    console.log(result);
  });
});




/** ------------ Queries from the Database ------------*/