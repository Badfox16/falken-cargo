const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const morgan = require('morgan');
const dotenv = require('dotenv');
const path = require('path');

dotenv.config();

const userRoutes = require('./routes/userRoutes');
const cargaRoutes = require('./routes/cargaRoutes');
const propostaRoutes = require('./routes/cargaRoutes');

const app = express();

app.use(cors({
  origin: 'exp://192.168.43.199:8081'
}));
app.use(bodyParser.json());
app.use(morgan('dev'));

app.use('/uploads', express.static(path.join(__dirname, 'uploads')));

app.use('/api/users', userRoutes);
app.use('/api/cargas', cargaRoutes);

const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
  console.log(`Servidor a correr na porta: ${PORT}`);
});