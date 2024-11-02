import React, { useState } from 'react';
import { View, Text, TextInput, Button, ScrollView, StyleSheet, Image } from 'react-native';
import { Picker } from '@react-native-picker/picker';
import * as ImagePicker from 'expo-image-picker';

const CargaForm = () => {
  const [descricao, setDescricao] = useState('');
  const [tipoCarga, setTipoCarga] = useState('');
  const [origem, setOrigem] = useState('');
  const [destino, setDestino] = useState('');
  const [precoFrete, setPrecoFrete] = useState('');
  const [foto, setFoto] = useState(null);

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

  const handleSubmit = () => {
    // Handle form submission
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

      <Text style={styles.label}>Foto:</Text>
      <Button title="Escolher Foto" onPress={handlePhotoSelection} />
      {foto && <Image source={{ uri: foto }} style={styles.image} />}

      <View></View>

      <Button title="Cadastrar" onPress={handleSubmit} />
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    padding: 20,
  },
  label: {
    marginVertical: 10,
    fontWeight: 'bold',
  },
  input: {
    borderWidth: 1,
    borderColor: '#ccc',
    padding: 10,
    borderRadius: 5,
    marginBottom: 20,
  },
  image: {
    width: 100,
    height: 100,
    marginVertical: 10,
  },
});

export default CargaForm;