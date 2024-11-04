const db = require('../config/db');
const upload = require('../config/upload');

exports.getAllCargas = (req, res) => {
  const query = `
    SELECT tbCarga.*, tbUsuario.nome, tbUsuario.apelido 
    FROM tbCarga 
    JOIN tbUsuario ON tbCarga.idUsuario = tbUsuario.idUsuario
    WHERE tbCarga.estado = 'pendente'
  `;
  
  db.query(query, (err, results) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.status(200).json(results);
  });
};

exports.addCarga = (req, res) => {
  const { descricao, tipoCarga, origem, destino, precoFrete } = req.body;
  const foto = req.file ? req.file.filename : null;
  const idUsuario = 2; // Para teste
  
  const query = `
    INSERT INTO tbCarga (descricao, tipoCarga, origem, destino, precoFrete, caminhoFoto, idUsuario, estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, 'pendente')
  `;

  db.query(query, [descricao, tipoCarga, origem, destino, precoFrete, foto, idUsuario], (err, results) => {
    if (err) {
      console.log(err);
      return res.status(500).json({ error: err.message });
    }
    res.status(201).json({ message: 'Carga adicionada com sucesso!' });
  });
};

exports.getCargasByUsuario = (req, res) => {
  const { idUsuario } = req.params;

  const query = `
    SELECT * FROM tbCarga
    WHERE idUsuario = ?
  `;

  db.query(query, [idUsuario], (err, results) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.status(200).json(results);
  });
};