const db = require('../config/db');

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