const express = require('express');
const propostaController = require('../controllers/propostaController');

const router = express.Router();

router.get('/', propostaController.getPropostasByTransportadora);
router.get('/minhas', propostaController.getPropostasByUsuario);
router.post('/criar', propostaController.submitProposta);
router.put('/aceitar/:idProposta', propostaController.aceitarProposta)
router.put('/recusar/:idProposta', propostaController.recusarProposta)

module.exports = router;