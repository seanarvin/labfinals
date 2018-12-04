var Cryptr = require('cryptr');
var express = require("express");
var connection = require('./../config');
// cryptr = new Cryptr('myTotalySecretKey');
 
module.exports.register = function (req, res) {
    var today = new Date();
    var encryptedString = cryptr.encrypt(req.body.password);
    var users = {
        "user_fname": req.body.user_fname,
        "user_lname": req.body.user_lname,
        "contact_no": req.body.contact_no,
        "address": req.body.address,
        "user_role": req.body.user_role,
        "user_name": req.body.user_name,
        "email": req.body.email,
        "password": encryptedString
    }
    connection.query('INSERT INTO user SET ?', users, function (error, results, fields) {
        if (error) {
    res.json({
            status: false,
            message: 'there are some error with query'
    })
      }else{
          res.json({
            status: true,
            data: results,
            message: 'user registered sucessfully'
        })
      }
    });
}
