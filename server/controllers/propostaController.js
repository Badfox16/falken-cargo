const db = require('../config/db');

exports.submitProposta = (req, res) => {
    const { idTransportadora, idCarga} = req.body;
    
    const query = 'INSERT INTO tbProposta (idTransportadora, idCarga) VALUES (?,?)';
    db.query(query, [idTransportadora, idCarga], (err, result) => {
        if (err) {
            return res.status(500).send('Error submitting proposal');
        }
        res.status(201).send('Proposal submitted successfully');
    });
};

exports.getPropostasByTransportadora = (req, res) => {
    const { idTransportadora } = req.query;

    const query = `
        SELECT p.*, c.descricao, c.tipoCarga, c.origem, c.destino, c.precoFrete, c.caminhoFoto, c.estado AS estadoCarga,
               u.nome AS nomeUsuario, u.apelido AS apelidoUsuario
        FROM tbProposta p
        JOIN tbCarga c ON p.idCarga = c.idCarga
        JOIN tbUsuario u ON c.idUsuario = u.idUsuario
        WHERE p.idTransportadora = ?
    `;
    db.query(query, [idTransportadora], (err, results) => {
        if (err) {
            return res.status(500).send('Error retrieving proposals');
        }
        res.status(200).json(results);
    });
};

exports.getPropostasByUsuario = (req, res) => {
    const { idUsuario } = req.query;

    const query = `
        SELECT p.*, c.descricao, c.tipoCarga, c.origem, c.destino, c.precoFrete, c.caminhoFoto, c.estado AS estadoCarga,
               t.nome AS nomeTransportadora, t.endereco AS enderecoTransportadora
        FROM tbProposta p
        JOIN tbCarga c ON p.idCarga = c.idCarga
        JOIN tbTransportadora t ON p.idTransportadora = t.idTransportadora
        WHERE c.idUsuario = ?;
    `;
    db.query(query, [idUsuario], (err, results) => {
        if (err) {
            return res.status(500).send('Error retrieving proposals');
        }
        res.status(200).json(results);
    });
};

exports.aceitarProposta = (req, res) => {
    const { idProposta } = req.body;

    const query = 'UPDATE tbProposta SET estado = "aceita" WHERE idProposta = ?';
    db.query(query, [idProposta], (err, result) => {
        if (err) {
            return res.status(500).send('Error accepting proposal');
        }
        res.status(200).send('Proposal accepted successfully');
    });
};

exports.recusarProposta = (req, res) => {
    const { idProposta } = req.body;

    const query = 'UPDATE tbProposta SET estado = "rejeitada" WHERE idProposta = ?';
    db.query(query, [idProposta], (err, result) => {
        if (err) {
            return res.status(500).send('Error rejecting proposal');
        }
        res.status(200).send('Proposal rejected successfully');
    });
};
