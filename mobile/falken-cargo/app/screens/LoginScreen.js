import { View, Text, StyleSheet, TextInput, Pressable, Alert } from 'react-native'
import React, { useState } from 'react'
import { useSQLite } from '../db/SQLiteContext';
import { useNavigation } from '@react-navigation/native'


export default function Login() {
    const navigation = useNavigation()

    const [userName, setUserName] = useState('');
    const [password, setPassword] = useState('');

    const handleLogin = async() => {
        console.log('userName', userName);
        
    }
    return (
        <View style={styles.container}>
            <Text style={styles.title}>Login</Text>
            <TextInput 
                style={styles.input}
                placeholder='Username'
                value={userName}
                onChangeText={setUserName}
            />
            <TextInput 
                style={styles.input}
                placeholder='Senha'
                secureTextEntry
                value={password}
                onChangeText={setPassword}
            />
            <Pressable style={styles.button} onPress={handleLogin}>
                <Text style={styles.buttonText} >Entrar</Text>
            </Pressable>
            <Pressable style={styles.link} onPress={() => navigation.navigate('Cadastro')}>
                <Text style={styles.linkText}>Não tem uma conta? Faça o seu cadastro</Text>
            </Pressable>
        </View>
    )
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
      borderColor: '#ccc',
      marginVertical: 5,
    },
    button: {
      backgroundColor: 'blue',
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
    link : {
      marginTop: 10,
    },
    linkText: {
      color: 'blue',
    },
    userText: {
      fontSize: 18,
      marginBottom: 30,
    }
  });