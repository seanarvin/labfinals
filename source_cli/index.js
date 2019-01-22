const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql')
const session = require('express-session');
const bcrypt = require('bcryptjs');
const app = express();


app.set('trust proxy', 1);
app.use(session({
	secret: 'keyboard cat',
	resave: false,
	saveUninitialized: true,
	cookie: { secure: false }
}));

const db = mysql.createConnection({
	host	 : 'localhost',
	user	 : 'root',
	password : 'toor',
	database : 'db'
});



db.connect((err) => {
	if (err) throw err;
	console.log('Database Connected')
});

app.use('/assets', express.static('assets'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }))
app.set('view engine','ejs');

// #save id to session
app.get('/index/:id',(req,res)=>{
	db.query(`SELECT  user_id,CONCAT(user_fname,' ',user_lname) as fullname from user
		where user_id = ?`
		,[req.params.id],(error, user, fields) => {
			if (error) throw error;
			req.session.userdata = user[0];
			res.redirect('/');
		});

});


//#index page
app.get('/',(req,res) => {
	let ip = req.get('host').split(":")[0];
	let userdata = req.session.userdata;
	if(userdata){
		db.query(`SELECT sp_id, FORMAT(AVG(rate),0) as rate FROM rate GROUP by sp_id`, 
			(error, rate, num) => {
				if (error) throw error;
				res.render('index', {userdata});
			});

	}else{
		req.session.destroy(function(err) {
			res.redirect("http://"+ip+":80/trabawho");
		});
	}
});
// #serviceworks
app.get('/serviceworks/:id',(req,res) =>{
	db.query(`SELECT * FROM work where status = "active" AND service_id = ?`,
		[req.params.id],(error, results, fields) => {
			if (error) throw error;
			res.json(results)
		});
});

//#search
app.get('/search/:value',(req,res) => {
	let having = ``;
	if (req.params.value !== 'all'){
		having = `Having (service_name like "%`+req.params.value+`%" OR user like "%`+req.params.value+`%")`;
	}
	db.query(`SELECT s.sp_id,user.user_id,CONCAT(housenumber," ",barangay,",",street,",",
		city,",",municipality) as address,contact_no,GROUP_CONCAT(service_name) as service_name,CONCAT(user_fname,' ',user_lname) as user from user
		inner join services s on s.sp_id = user.user_id where s.status = "active" GROUP by s.sp_id ${having} `,
		(error, results, fields) => {
			if (error) throw error;
			db.query(`SELECT sp_id, FORMAT(AVG(rate),0) as rate FROM rate GROUP by sp_id`, 
				(error, rate, fields1) => {
					let rating = {};
					let data = [];

					rate.forEach(function(row){
						rating[row.sp_id] = row.rate;
					});			
					results.forEach(function(row){
						data.push({
							"service_id": row.service_id,
							"sp_id": row.sp_id,
							"user_id": row.sp_id,
							"address": row.address,
							"contact_no": row.contact_no,
							"service_name": row.service_name,
							"user": row.user ,
							"rate": rating[row.sp_id]
						});
					});
					res.json({data});
				});
		});
});

//# services
app.get('/services/:id',(req,res) => {
	let id = req.params.id;
	db.query(`SELECT * FROM services WHERE sp_id = ?`,[id],(error, results, fields) => {
		if (error) throw error;
		res.json(results);
	});
});
// #transactions
app.get('/transactions',(req,res) =>{
	let userdata = req.session.userdata;
	if(userdata){
		let client_id = userdata.user_id;
		db.query(`SELECT r.sp_id,r.note,r.status,r.req_id, w.description, service_name, specifics,
			CONCAT(u.user_fname,' ',u.user_lname) as serviceprovider,
			DATE_FORMAT(r.date_requested, "%a, %b %d %Y") as date_requested,
			DATE_FORMAT(r.date, "%a, %b %d %Y") as date, 
			CONCAT(TIME_FORMAT(r.from, "%h %i %p"),'-',TIME_FORMAT(r.to, "%h %i %p")) as time 
			FROM requests r inner join user u on u.user_id = r.sp_id
			inner join work w on w.work_id = r.work_id
			inner join services s on s.service_id = w.service_id
			where client_id = ?`
			,[client_id],(error, results, fields) => {
				if (error) throw error;
				res.render('transaction', {data: results,userdata});

			});
	}else{
		res.redirect('/logout');
	}
});
// #view profile
app.get('/viewprofile',(req,res) =>{
	let userdata = req.session.userdata;
	if(userdata){
		let user_id = userdata.user_id;
		db.query(`SELECT * from user where user_id = ?`
			,[user_id],(error, results, fields) => {
				if (error) throw error;
				res.render('profile', {data:results[0],userdata});
			});
	}else{
		res.redirect('/logout');
	}
});
// #updateprofile
app.post('/updateprofile',(req,res) => {

	if(req.session.userdata){
		let userid = req.session.userdata.user_id;
		let data = {};

		if(req.body.password){
			let {password} = req.body;
			var hash = bcrypt.hashSync(password, 10);
			data =  {
				"password": hash
			};
		}else{

			let {firstname} = req.body;
			let {lastname} = req.body;
			let {email} = req.body;
			let {housenumber} = req.body;
			let {barangay} = req.body;
			let {street} = req.body;
			let {city} = req.body;
			let {municipality} = req.body;
			let {contact} = req.body;
			let {username} = req.body;

			data = {
				"user_fname": firstname,
				"user_lname": lastname,
				"email": email,
				"housenumber": housenumber,
				"barangay": barangay,
				"street": street,
				"city": city,
				"municipality": municipality,
				"contact_no": contact,
				"user_name": username,
			}
		}

		db.query('UPDATE user SET ? WHERE user_id = ?', [data, userid], function (error, results, fields) {
			if (error) throw error;
			res.redirect('/viewprofile')
		});
	}else{
		res.redirect('/logout');
	}

});
//#cancel
app.post('/cancel',(req,res) => {
	let {id} = req.body;
	db.query(`UPDATE requests set status="cancelled" where req_id=?`,[id],(error,results)=>{
		if(error) throw error;
		res.redirect('/transactions');
	});
});
//#rate and comment
app.post('/rate',(req,res) => {
	if(req.session.userdata){
		let client_id = req.session.userdata.user_id; 
		let {sp_id} = req.body;
		let {rate} = req.body;
		let {comment} = req.body;
		db.query(`Insert into rate set 
			rate =?, comment = ?, sp_id=?, client_id =?`,
			[rate,comment,sp_id,client_id],(error,results)=>{
				if(error) throw error;
				res.redirect('/transactions');
			});
	}else{
		res.redirect('/logout');
	}
});
// #request
app.post('/client/request',(req,res)=> {
	if(req.session.userdata){

		let client_id = req.session.userdata.user_id; 
		let data = req.body;
 	// client will do request
 	db.query('INSERT INTO requests SET ? , client_id = ? ',[data,client_id], (error, results, fields) => {
 		if (error) throw error;
 		res.json(data);
 	});
 }else{
 	res.redirect('/logout');
 }

});


//#validate password
app.post('/validatepassword',(req,res)=> {
	if(req.session.userdata){
		let user_id = req.session.userdata.user_id;
		let hash = "default-hash";
		let {oldpass} = req.body;

		db.query(`SELECT password from user where user_id = ?`
			,[user_id],(error, results, fields) => {
				if (error) throw error;
				hash = results[0]["password"];
				res.json(bcrypt.compareSync(oldpass, hash));
			});
	}else{
		res.redirect('/logout');
	}

});
//#validate password
app.get('/comments/:sp_id',(req,res)=> {
	if(req.session.userdata){

		db.query(`SELECT CONCAT(user_fname," ",user_lname) as name,comment,rate 
			FROM rate inner join user on user_id = sp_id where sp_id = ?`,
			[req.params.sp_id],(error, results, fields) => {
				if (error) throw error;
				res.json(results);
			});
	}else{
		res.redirect('/logout');
	}

});

//#logout
app.get('/logout',(req,res)=>{
	let ip = req.get('host').split(":")[0];

	req.session.destroy(function(err) {
		if (err) console.log(err);
		res.redirect("http://"+ip+":80/trabawho/php/logout.php");
	});
});


let server = app.listen(3000, (err)=>{
	if(err) console.log('Error connecting to port 3000');
	console.log('Connected to Port 3000');
});

