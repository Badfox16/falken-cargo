import React, { useState } from 'react';
import { View, Text, TextInput, Button, ScrollView, StyleSheet, Image, Alert, TouchableOpacity } from 'react-native';
import { Picker } from '@react-native-picker/picker';
import * as ImagePicker from 'expo-image-picker';
import axios from 'axios';
import { API_BASE_URL } from '@env';
import { Ionicons } from '@expo/vector-icons';
import { useAuth } from '../context/AuthContext';
import { useNavigation } from '@react-navigation/native';

const CargaForm = () => {
  const [descricao, setDescricao] = useState('');
  const [tipoCarga, setTipoCarga] = useState('');
  const [origem, setOrigem] = useState('');
  const [destino, setDestino] = useState('');
  const [precoFrete, setPrecoFrete] = useState('');
  const [foto, setFoto] = useState(null);
  const idUsuario = user?.idUsuario;

  const navigation = useNavigation();


  const handlePhotoSelection = async () => {
    let result = await ImagePicker.launchImageLibraryAsync({
      mediaTypes: ImagePicker.MediaTypeOptions.Images,
      allowsEditing: true,
      aspect: [4, 3],
      quality: 1,
    });

    if (!result.canceled) {
      setFoto(result.assets[0].uri);
    }
  };

  const handleSubmit = async () => {
    const formData = new FormData();
    formData.append('descricao', descricao);
    formData.append('idUsuario', idUsuario);
    formData.append('tipoCarga', tipoCarga);
    formData.append('origem', origem);
    formData.append('destino', destino);
    formData.append('precoFrete', precoFrete);
    if (foto) {
      const filename = foto.split('/').pop();
      const match = /\.(\w+)$/.exec(filename);
      const type = match ? `image/${match[1]}` : `image`;
      formData.append('foto', { uri: foto, name: filename, type });
    }

    try {
      const response = await axios.post( `${API_BASE_URL}/api/cargas/add`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      Alert.alert('Sucesso', 'Carga adicionada com sucesso!');
      navigation.goBack();
    } catch (error) {
      console.log(error);
      
      Alert.alert('Erro', 'Ocorreu um erro ao adicionar a carga.');
    }
  };

  return (
    <ScrollView contentContainerStyle={styles.container}>
      <Text style={styles.label}>Descrição da Carga:</Text>
      <TextInput
        style={styles.input}
        value={descricao}
        onChangeText={setDescricao}
        placeholder="Insira a descrição da carga"
        multiline
        required
      />

      <Text style={styles.label}>Tipo de Carga:</Text>
      <Picker
        selectedValue={tipoCarga}
        onValueChange={(itemValue) => setTipoCarga(itemValue)}
        style={styles.input}
      >
        <Picker.Item label="Selecione o tipo de carga" value="" />
        <Picker.Item label="Perigosa" value="Perigosa" />
        <Picker.Item label="Frágil" value="Frágil" />
        <Picker.Item label="Comum" value="Comum" />
        <Picker.Item label="Contentor" value="Contentor" />
        <Picker.Item label="Refrigerada" value="Refrigerada" />
        <Picker.Item label="Outro" value="Outro" />
      </Picker>

      <Text style={styles.label}>Origem:</Text>
      <TextInput
        style={styles.input}
        value={origem}
        onChangeText={setOrigem}
        placeholder="Insira a origem"
        required
      />

      <Text style={styles.label}>Destino:</Text>
      <TextInput
        style={styles.input}
        value={destino}
        onChangeText={setDestino}
        placeholder="Insira o destino"
        required
      />

      <Text style={styles.label}>Preço do Frete:</Text>
      <TextInput
        style={styles.input}
        value={precoFrete}
        onChangeText={setPrecoFrete}
        placeholder="Insira o preço do frete"
        keyboardType="numeric"
        required
      />

<TouchableOpacity style={styles.photoButton} onPress={handlePhotoSelection}>
        <Ionicons name="camera" size={24} color="white" />
        <Text style={styles.photoButtonText}>Selecionar Foto</Text>
      </TouchableOpacity>

      {foto && <Image source={{ uri: foto }} style={styles.image} />}

      <TouchableOpacity style={styles.submitButton} onPress={handleSubmit}>
        <Text style={styles.submitButtonText}>Adicionar Carga</Text>
      </TouchableOpacity>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    flexGrow: 1,
    padding: 20,
    backgroundColor: '#f5f5f5',
  },
  label: {
    fontSize: 16,
    fontWeight: 'bold',
    marginBottom: 5,
    color: '#333',
  },
  input: {
    height: 40,
    borderColor: '#ccc',
    borderWidth: 1,
    borderRadius: 5,
    paddingHorizontal: 10,
    marginBottom: 15,
    backgroundColor: '#fff',
  },
  picker: {
    height: 50,
    borderColor: '#ccc',
    borderWidth: 1,
    borderRadius: 5,
    marginBottom: 15,
    backgroundColor: '#fff',
  },
  photoButton: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#007bff',
    padding: 10,
    borderRadius: 5,
    marginBottom: 15,
  },
  photoButtonText: {
    color: 'white',
    marginLeft: 10,
  },
  image: {
    width: '100%',
    height: 200,
    borderRadius: 5,
    marginBottom: 15,
  },
  submitButton: {
    backgroundColor: 'green',
    padding: 15,
    borderRadius: 5,
    alignItems: 'center',
  },
  submitButtonText: {
    color: 'white',
    fontSize: 16,
    fontWeight: 'bold',
  },
});

export default CargaForm;