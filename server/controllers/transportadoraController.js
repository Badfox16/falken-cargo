const db = require('../config/db');
const upload = require('../config/upload');

exports.getAllTransportadoras = (req, res) => {
  const query = `
    SELECT * FROM tbTransportadora
  `;
  
  db.query(query, (err, results) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.status(200).json(results);
  });
};

exports.addTransportadora = (req, res) => {
  const { nome, email, telefone, endereco, senha } = req.body;
  const foto = req.file ? req.file.filename : null;

  
  const query = `
    INSERT INTO tbTransportadora (nome, email, telefone, endereco, senha, caminhoFoto)
    VALUES (?, ?, ?, ?, ?, ?, ?)
  `;

  db.query(query, [nome, email, telefone, endereco, senha, foto], (err, results) => {
    if (err) {
      console.log(err);
      return res.status(500).json({ error: err.message });
    }
    res.status(201).json({ message: 'Transportadora adicionada com sucesso!' });
  });
};