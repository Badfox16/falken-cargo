// db/database.js
import * as SQLite from 'expo-sqlite';

let db;

const openDatabase = async () => {
  db = await SQLite.openDatabaseAsync('usersDatabase.db');
};

const initializeDatabase = async () => {
  if (!db) {
    await openDatabase();
  }
};

initializeDatabase();

// Funções CRUD
export const setupDatabase = async () => {
  await initializeDatabase();
  await db.execAsync(`
    CREATE TABLE IF NOT EXISTS users (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      name TEXT NOT NULL,
      password TEXT NOT NULL
    );
  `);
};

export const addUser = async (name, password) => {
  await initializeDatabase();
  const result = await db.runAsync(
    'INSERT INTO users (name, password) VALUES (?, ?)', [name, password]
  );
  return result.lastInsertRowId;
};

export const getAllUsers = async () => {
  await initializeDatabase();
  const users = await db.getAllAsync('SELECT * FROM users');
  return users;
};

export const getUserById = async (id) => {
  await initializeDatabase();
  const user = await db.getFirstAsync('SELECT * FROM users WHERE id = ?', [id]);
  return user;
};

export const updateUser = async (id, name, password) => {
  await initializeDatabase();
  const result = await db.runAsync(
    'UPDATE users SET name = ?, password = ? WHERE id = ?',
    [name, password, id]
  );
  return result.changes > 0;
};

export const deleteUser = async (id) => {
  await initializeDatabase();
  const result = await db.runAsync('DELETE FROM users WHERE id = ?', [id]);
  return result.changes > 0;
};
