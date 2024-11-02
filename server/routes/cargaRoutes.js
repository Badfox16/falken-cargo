const express = require('express');
const router = express.Router();
const cargaController = require('../controllers/cargaController');
const upload = require('../config/uploadConfig');

router.get('/cargas', cargaController.getAllCargas);
router.post('/cargas', upload.single('foto'), cargaController.addCarga);

module.exports = router;