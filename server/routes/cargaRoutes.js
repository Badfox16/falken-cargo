const express = require('express');
const router = express.Router();
const cargaController = require('../controllers/cargaController');
const upload = require('../config/upload');

router.get('/', cargaController.getAllCargas);
router.get('/:idUsuario', cargaController.getCargasByUsuario);
router.post('/add', upload.single('foto'), cargaController.addCarga);

module.exports = router;