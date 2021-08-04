var express = require('express');
var router = express.Router();
var db = require('../koneksi');
var env = require('../env');

var multer = require('multer');
var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './public/pembimbing')
    },
    filename: function (req, file, cb) {
        cb(null, file.originalname)
    }
})
var upload = multer({ storage: storage});
var uploadImage = upload.single('photo')

router.get('/', function(req, res, next) {
    res.send('respond with a resource')
});

router.post('/create', function(req, res, next) {
    uploadImage(req, res, function(error) {
        if(error instanceof multer.MulterError) {
            res.json({ message: 'samting wong multer', result: error})
        } else if(error) {
            res.json({ message: 'samting wong', result: error})
        }
        //ambil nama file
        let fileName = req.file.filename;
        //ambil link atau url
        let urlFile = `${env.API_URL}/pembimbing/${fileName}`

        let form = {
            name: req.body.name,
            photo: urlFile,
            email: req.body.email,
            password: req.body.password,
        }

        let sql = `INSERT INTO pembimbing (name, photo, email, password) VALUES (?)`;
        let data = [form.name, form.photo, form.email, form.password];
        db.query(sql, [data], (error, rows) => {
            if(error) res.json({ message: 'samting wong', result: error})
            res.json(form)
        });
    });
});

router.patch('/update/:id', function(req, res, next) {
    let id = req.params.id;

    uploadImage(req, res, function(error) {
        if(error instanceof multer.MulterError) {
            res.json({ message: 'samting wong multer', result: error})
        } else if(error) {
            res.json({ message: 'samting wong', result: error})
        }
        //ambil nama file
        let fileName = req.file.filename;
        //ambil link atau url
        let urlFile = `${env.API_URL}/pembimbing/${fileName}`

        let form = {
            name: req.body.name,
            photo: urlFile,
            email: req.body.email,
            password: req.body.password,
        }
        let sql =   `UPDATE pembimbing SET name = ?, photo = ?, email = ?, password = ? WHERE id = ?`;
        db.query(sql, [form.name, form.photo, form.email, form.password, id], (error, rows) => {
            if(error) res.json({ message: 'samting wong', result: error})
            let sql = `SELECT * FROM pembimbing WHERE id = ?`;
            db.query(sql, [id], (error, rows) => {
                if(error) res.json({ message: 'samting wong', result: error})
                res.json(rows)
            });
        });
    });
});

router.get('/get/:id', function(req, res, next) {
    let id = req.params.id;

    let sql = `SELECT * FROM pembimbing WHERE id = ?`;
    db.query(sql, [id], (error, rows) => {
        if(error) res.json({ message: 'samting wong', result: error})

        res.json(rows)
    });
});

router.get('/getall', function(req, res, next) {
    let sql = `SELECT * FROM pembimbing`;
    db.query(sql, (error, rows) => {
        if(error) res.json({ message: 'samting wong', result: error})

        res.json(rows)
    });
});

router.delete('/delete/:id', function(req, res, next) {
    let id = req.params.id;

    let sql = `DELETE FROM pembimbing WHERE id = ?`;
    db.query(sql, [id], (error, rows) => {
        if(error) res.json ({ message: 'samting wong', result: error})

        res.json(rows)
    });
});

module.exports = router;
