const express = require('express');
const router = express.Router();
const transportadoraController = require('../controllers/transportadoraController');
const upload = require('../config/upload');

router.get('/', transportadoraController.getAllTransportadoras);
router.post('/add', upload.single('foto'), transportadoraController.addTransportadora);

module.exports = router;