const express = require('express');
const propostaController = require('../controllers/propostaController');

const router = express.Router();

router.get('/', propostaController.getPropostasByTransportadora);
router.post('/criar', propostaController.submitProposta);

module.exports = router;