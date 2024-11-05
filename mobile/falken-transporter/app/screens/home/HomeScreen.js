// screens/HomeScreen.js
import React, { useEffect, useState } from 'react';
import { View, Text, Button, FlatList, Image, StyleSheet } from 'react-native';
import { API_BASE_URL } from '@env';
import { useAuth } from '../../context/AuthContext';

const HomeScreen = () => {
  const { user, logout } = useAuth();

  return (
    <View style={styles.container}>
      <Image source={{ uri: `${API_BASE_URL}${user.caminhoFoto}` }} style={styles.image} />
      <Text style={styles.text}>Nome: {user.nome} {user.apelido}</Text>
      <Text style={styles.text}>Email: {user.email}</Text>
      <Text style={styles.text}>Telefone: {user.telefone}</Text>
      <Button title="Logout" onPress={logout} color="green" />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
  },
  image: {
    width: 100,
    height: 100,
    marginBottom: 20,
    resizeMode: 'contain',
  },
  text: {
    fontSize: 16,
    marginBottom: 10,
  },
});

export default HomeScreen;
