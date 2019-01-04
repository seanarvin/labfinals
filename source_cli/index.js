const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql')
const hash = require('random-hash');
const session = require('express-session')
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

	req.session.uid = req.params.id;
	res.redirect('/');

});


//#index page
app.get('/',(req,res) => {
	let ip = req.get('host').split(":")[0];


	if(req.session.uid){
		db.query(`SELECT sps.id,user.user_id,s.service_id,address,service_name,CONCAT(user_fname,' ',user_lname) as user from user
			inner join spservices sps on sps.sp_id = user.user_id
			inner join services s on sps.category = s.service_id`, (error, results, fields) => {
				if (error) throw error;
				res.render('index', data = results);
			});
	}else{
		req.session.destroy(function(err) {
			res.redirect("http://"+ip+":8080/labfinals");
		});
	}
	
});
// #serviceworks
app.get('/serviceworks/:id',(req,res) =>{
	db.query(`SELECT * FROM spwork 
		inner join work on work.work_id = spwork.work
		WHERE spservice_id = ?`,
		[req.params.id],(error, results, fields) => {
			if (error) throw error;
			res.json(results)
		});
});
// #specifics
app.get('/specifics/:id',(req,res) =>{
	db.query(`SELECT * FROM specifics
		inner join services on services.service_id = specifics.service_id 
		where services.service_id = ?`,
		[req.params.id],(error, results, fields) => {
			if (error) throw error;
			res.json(results)
		});
});
//#search
app.get('/search/:value',(req,res) => {
	let where = ``;
	if (req.params.value){
		where = `where s.service_name = "`+req.params.value+`"`;
	}
	db.query(`SELECT sps.id,user.user_id,s.service_id,address,service_name,CONCAT(user_fname,' ',user_lname) as user from user
			inner join spservices sps on sps.sp_id = user.user_id
			inner join services s on sps.category = s.service_id ${where}`,
		(error, results, fields) => {
			if (error) throw error;
			res.json(results)
		});
});
// #transactions
app.get('/transactions',(req,res) =>{
	if(req.session.uid){
		let client_id = req.session.uid;
		db.query(`SELECT r.note,r.status,r.req_id, w.description, service_name, specifics,
			CONCAT(u.user_fname,' ',u.user_lname) as serviceprovider,
			DATE_FORMAT(r.date_requested, "%a, %b %d %Y") as date_requested,
			DATE_FORMAT(r.date, "%a, %b %d %Y") as date, 
			CONCAT(TIME_FORMAT(r.from, "%h %i %p"),'-',TIME_FORMAT(r.to, "%h %i %p")) as time 
			FROM requests r inner join user u on u.user_id = r.sp_id
			inner join work w on w.work_id = r.work_id
			inner join services s on s.service_id = w.service_id
			left join specifics spc on spc.specifics_id = r.specifics_id where client_id = ?
			And r.status not in ("rejected","completed","cancelled")`
			,[client_id],(error, results, fields) => {
				if (error) throw error;
				console.log(results[0]);
				res.render('transaction', data = results);

			});
	}else{
		res.redirect('/logout');
	}
});
// #history
app.get('/history',(req,res) =>{
	if(req.session.uid){

		let client_id = req.session.uid;

		db.query(`SELECT r.note,r.status,r.req_id, w.description, service_name, specifics,
			CONCAT(u.user_fname,' ',u.user_lname) as serviceprovider,
			DATE_FORMAT(r.date_requested, "%a, %b %d %Y") as date_requested,
			DATE_FORMAT(r.date, "%a, %b %d %Y") as date, 
			CONCAT(TIME_FORMAT(r.from, "%h %i %p"),'-',TIME_FORMAT(r.to, "%h %i %p")) as time 
			FROM requests r inner join user u on u.user_id = r.sp_id
			inner join work w on w.work_id = r.work_id
			inner join services s on s.service_id = w.service_id
			left join specifics spc on spc.specifics_id = r.specifics_id where client_id = ?
			And r.status in ("rejected","completed","cancelled")`
			,[client_id],(error, results, fields) => {
				if (error) throw error;
				res.render('history', data = results);

			});
	}else{
		res.redirect('/logout');
	}
});

// #view profile
app.get('/viewprofile',(req,res) =>{
	if(req.session.uid){

		let user_id = 12;
		db.query(`SELECT user_id,user_fname,user_lname,address,contact_no,email,user_name,password from user
			where user_id = ?`
			,[user_id],(error, results, fields) => {
				if (error) throw error;
				res.render('profile', data = results[0]);
			});
	}else{
		res.redirect('/logout');
	}
});
// #updateprofile
app.post('/updateprofile',(req,res) => {
	if(req.session.uid){

		let {firstname} = req.body;
		let {lastname} = req.body;
		let {email} = req.body;
		let {address} = req.body;
		let {contact} = req.body;
		let {username} = req.body;
		let {password} = req.body;
		let {userid} = req.body;

		let data = {
			"user_fname": firstname,
			"user_lname": lastname,
			"email": email,
			"address": address,
			"contact_no": contact,
			"user_name": username,
			"password": password,
		}

		db.query('UPDATE user SET ? WHERE user_id = ?', [data, userid], function (error, results, fields) {
			if (error) throw error;
			res.redirect('/viewprofile')
		});
	}else{
		res.redirect('/logout');
	}

});
// #request
app.post('/client/request',(req,res)=> {
	if(req.session.uid){

		let client_id = req.session.uid; 
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


//#logout
app.get('/logout',(req,res)=>{
	let ip = req.get('host').split(":")[0];

	req.session.destroy(function(err) {
		if (err) console.log(err);
		res.redirect("http://"+ip+":8080/labfinals/php/logout.php");
	});
});


let server = app.listen(3000, (err)=>{
	if(err) console.log('Error connecting to port 3000');
	console.log('Connected to Port 3000');
});