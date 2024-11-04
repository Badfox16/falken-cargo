const express = require('express');
const propostaController = require('../controllers/propostaController');

const router = express.Router();

router.get('/', propostaController.getPropostasByTransportadora);
router.get('/minhas', propostaController.getPropostasByUsuario);
router.post('/criar', propostaController.submitProposta);

module.exports = router;