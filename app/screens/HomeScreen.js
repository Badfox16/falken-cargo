// screens/HomeScreen.js
import React, { useEffect, useState } from 'react';
import { View, Text, Button, FlatList } from 'react-native';
import { useSQLite } from '../db/SQLiteContext';

const HomeScreen = () => {
  const { dbReady, getAllUsers, addUser } = useSQLite();
  const [users, setUsers] = useState([]);

  useEffect(() => {
    if (dbReady) {
      loadUsers();
    }
  }, [dbReady]);

  const loadUsers = async () => {
    const usersFromDB = await getAllUsers();
    setUsers(usersFromDB);
  };

  const handleAddUser = async () => {
    await addUser('Novo Usuário2', 'novo@usuario2.com');
    loadUsers();
  };

  return (
    <View>
      <Text>Usuários:</Text>
      <FlatList
        data={users}
        keyExtractor={(item) => item.id.toString()}
        renderItem={({ item }) => (
          <Text>{item.name} - {item.email}</Text>
        )}
      />
      <Button title="Adicionar Usuário" onPress={handleAddUser} />
    </View>
  );
};

export default HomeScreen;
