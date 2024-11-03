const db = require('../config/db');

exports.login = (req, res) => {
  const { email, senha } = req.body;

  const query = 'SELECT * FROM tbTransportadora WHERE email = ? AND senha = ?';
  db.query(query, [email, senha], (err, results) => {
    if (err) {
      return res.status(500).send('Error logging in');
    }
    if (results.length === 0) {
      return res.status(404).send('User not found');
    }
    res.status(200).json(results[0]);
  });
};

exports.entrar = (req, res) => {
  const { email, senha } = req.body;

  const query = 'SELECT * FROM tbUsuario WHERE email = ? AND senha = ?';
  db.query(query, [email, senha], (err, results) => {
    if (err) {
      return res.status(500).send('Error logging in');
    }
    if (results.length === 0) {
      return res.status(404).send('User not found');
    }
    res.status(200).json(results[0]);
  });
};