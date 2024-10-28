// db/SQLiteContext.js
import React, { createContext, useContext, useEffect, useState } from 'react';
import * as SQLite from 'expo-sqlite';
import { setupDatabase, addUser, getAllUsers, getUserById, updateUser, deleteUser } from './database';

const SQLiteContext = createContext();

export const SQLiteProvider = ({ children }) => {
  const [dbReady, setDbReady] = useState(false);

  useEffect(() => {
    const initializeDatabase = async () => {
      await setupDatabase();
      setDbReady(true);
    };
    initializeDatabase();
  }, []);

  const dbOperations = {
    addUser,
    getAllUsers,
    getUserById,
    updateUser,
    deleteUser,
  };

  return (
    <SQLiteContext.Provider value={{ dbReady, ...dbOperations }}>
      {children}
    </SQLiteContext.Provider>
  );
};

export const useSQLite = () => useContext(SQLiteContext);
