// LoginScreen.js
import { View, Text, StyleSheet, TextInput, Pressable, Alert } from 'react-native';
import React, { useState } from 'react';
import { useNavigation } from '@react-navigation/native';
import { API_BASE_URL } from '@env';
import axios from 'axios';
import { useAuth } from '../context/AuthContext';

export default function Login() {
  const navigation = useNavigation();
  const { login } = useAuth();

  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleLogin = async () => {    
    try {
      const response = await axios.post(`${API_BASE_URL}/api/users/login`, {
      email,
      senha: password,
      });

      if (response.status === 200) {
      login(response.data); // Armazena os dados do usuário no contexto
      navigation.navigate('Tabs'); // Navega para a tela principal
      } else {
      Alert.alert('Erro', 'Credenciais inválidas');
      }
    } catch (error) {
      if (error.response && error.response.status === 404) {
      Alert.alert('Erro', 'Credenciais inválidas');
      } else {
      console.error(error);
      Alert.alert('Erro', 'Ocorreu um erro ao fazer login');
      }
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Login</Text>
      <TextInput
        style={styles.input}
        placeholder='Email'
        value={email}
        onChangeText={setEmail}
      />
      <TextInput
        style={styles.input}
        placeholder='Senha'
        secureTextEntry
        value={password}
        onChangeText={setPassword}
      />
      <Pressable style={styles.button} onPress={handleLogin}>
        <Text style={styles.buttonText}>Entrar</Text>
      </Pressable>
      <Pressable style={styles.link} onPress={() => navigation.navigate('Cadastro')}>
        <Text style={styles.linkText}>Não tem uma conta? Faça o seu cadastro</Text>
      </Pressable>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 30,
  },
  input: {
    width: '80%',
    padding: 10,
    borderWidth: 1,
    borderColor: '#tomato',
    marginVertical: 5,
  },
  button: {
    backgroundColor: 'tomato',
    padding: 10,
    marginVertical: 10,
    width: '80%',
    borderRadius: 5,
  },
  buttonText: {
    color: 'white',
    textAlign: 'center',
    fontSize: 18,
  },
  link: {
    marginTop: 10,
  },
  linkText: {
    color: 'tomato',
  },
  userText: {
    fontSize: 18,
    marginBottom: 30,
  },
});