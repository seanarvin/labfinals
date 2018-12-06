/** ------------ Queries from the Database ------------*/

  
  
  con.query("SELECT * FROM user", function (err, result, fields) {
    if (err) throw err;
    console.log(result);
  });
});
/** ------------ Queries from the Database ------------*/