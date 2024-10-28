const db = require('../config/db');

exports.register = (req, res) => {
  const { nome, apelido, email, telefone, senha } = req.body;

  const query = 'INSERT INTO tbUsuario (nome, apelido, email, telefone, senha) VALUES (?, ?, ?, ?, ?)';
  db.query(query, [nome, apelido, email, telefone, senha], (err, result) => {
    if (err) {
      return res.status(500).send('Error registering user');
    }
    res.status(201).send('User registered successfully');
  });
};

exports.login = (req, res) => {
  const { email, senha } = req.body;

  const query = 'SELECT * FROM tbUsuario WHERE email = ? AND senha = ?';
  db.query(query, [email, senha], (err, results) => {
    if (err) {
      return res.status(500).send('Error logging in');
    }
    if (results.length === 0) {
      return res.status(404).send('User not found');
    }


    res.status(200);
  });
};