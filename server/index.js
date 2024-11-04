const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const morgan = require('morgan');
const dotenv = require('dotenv');
const path = require('path');
const cargaController = require('./controllers/cargaController');
const upload = require('./config/upload');
const router = express.Router();

dotenv.config();

const userRoutes = require('./routes/userRoutes');
const cargaRoutes = require('./routes/cargaRoutes');
const transportadoraRoutes = require('./routes/transportadoraRoutes');
const propostaRoutes = require('./routes/propostaRoutes');

const app = express();

app.use(cors({
  origin: '*',
}));
app.use(bodyParser.json());
app.use(morgan('dev'));

app.use('/uploads', express.static(path.join(__dirname, 'uploads')));

app.use('/api/users', userRoutes);
app.use('/api/cargas', cargaRoutes);
app.use('/api/transportadoras', transportadoraRoutes);
app.use('/api/propostas', propostaRoutes);

// Editar uma carga
router.post('/edit', upload.single('foto'), cargaController.editCarga);

const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
  console.log(`Servidor a correr na porta: ${PORT}`);
});