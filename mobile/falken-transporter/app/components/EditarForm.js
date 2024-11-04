import React, { useState, useEffect } from 'react';
import { View, Text, TextInput, Button, ScrollView, StyleSheet, Image, Alert, TouchableOpacity } from 'react-native';
import { Picker } from '@react-native-picker/picker';
import * as ImagePicker from 'expo-image-picker';
import axios from 'axios';
import { API_BASE_URL } from '@env';
import { Ionicons } from '@expo/vector-icons';
import { useRoute, useNavigation } from '@react-navigation/native';

const EditarForm = () => {
  const route = useRoute();
  const navigation = useNavigation();
  const { Carga } = route.params;

  const [descricao, setDescricao] = useState(Carga.descricao);
  const [tipoCarga, setTipoCarga] = useState(Carga.tipoCarga);
  const [origem, setOrigem] = useState(Carga.origem);
  const [destino, setDestino] = useState(Carga.destino);
  const [precoFrete, setPrecoFrete] = useState(Carga.precoFrete.toString());
  const [foto, setFoto] = useState(Carga.caminhoFoto);

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
      const response = await axios.put(`${API_BASE_URL}/cargas/${Carga.idCarga}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      Alert.alert('Sucesso', 'Carga atualizada com sucesso!');
      navigation.goBack();
    } catch (error) {
      Alert.alert('Erro', 'Ocorreu um erro ao atualizar a carga.');
    }
  };

  return (
    <ScrollView contentContainerStyle={styles.container}>
        <Text style={{color:'green', fontSize:18, fontWeight:'bold', marginHorizontal:'auto'}}>Editar Carga</Text>

      <Text style={styles.label}>Descrição</Text>
      <TextInput
        style={styles.input}
        value={descricao}
        onChangeText={setDescricao}
        placeholder="Descrição da carga"
      />

      <Text style={styles.label}>Tipo de Carga</Text>
      <Picker
        selectedValue={tipoCarga}
        style={styles.picker}
        onValueChange={(itemValue) => setTipoCarga(itemValue)}
      >
      <Picker.Item label="Selecione o tipo de carga" value="" />
        <Picker.Item label="Perigosa" value="Perigosa" />
        <Picker.Item label="Frágil" value="Frágil" />
        <Picker.Item label="Comum" value="Comum" />
        <Picker.Item label="Contentor" value="Contentor" />
        <Picker.Item label="Refrigerada" value="Refrigerada" />
        <Picker.Item label="Outro" value="Outro" />
      </Picker>

      <Text style={styles.label}>Origem</Text>
      <TextInput
        style={styles.input}
        value={origem}
        onChangeText={setOrigem}
        placeholder="Origem da carga"
      />

      <Text style={styles.label}>Destino</Text>
      <TextInput
        style={styles.input}
        value={destino}
        onChangeText={setDestino}
        placeholder="Destino da carga"
      />

      <Text style={styles.label}>Preço do Frete</Text>
      <TextInput
        style={styles.input}
        value={precoFrete}
        onChangeText={setPrecoFrete}
        placeholder="Preço do frete"
        keyboardType="numeric"
      />

      <TouchableOpacity style={styles.photoButton} onPress={handlePhotoSelection}>
        <Ionicons name="camera" size={24} color="white" />
        <Text style={styles.photoButtonText}>Selecionar Foto</Text>
      </TouchableOpacity>

      {foto && <Image source={{ uri: `${API_BASE_URL}${foto}` }} style={styles.image} />}

      <TouchableOpacity style={styles.submitButton} onPress={handleSubmit}>
        <Text style={styles.submitButtonText}>Atualizar Carga</Text>
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
    color: 'green',
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
    padding: 12,
    borderRadius: 5,
    alignItems: 'center',
  },
  submitButtonText: {
    color: 'white',
    fontSize: 16,
    fontWeight: 'bold',
  },
});

export default EditarForm;