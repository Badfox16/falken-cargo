const express = require('express');
const cargaController = require('../controllers/cargaController');

const router = express.Router();

router.get('/', cargaController.getAllCargas);

module.exports = router;