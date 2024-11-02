const multer = require('multer');
const path = require('path');

const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, path.resolve(__dirname, '../uploads/'));  },
  filename: (req, file, cb) => {
    cb(null, `/uploads/${Date.now()}-${file.originalname}`);
  },
});

const upload = multer({ storage });

module.exports = upload;