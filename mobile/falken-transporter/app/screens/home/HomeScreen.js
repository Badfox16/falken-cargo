// screens/HomeScreen.js
import React, { useEffect, useState } from 'react';
import { View, Text, Button, FlatList } from 'react-native';
import CargaForm from '../../components/CargaForm';
import ListaTransportadoras from '../../components/ListaTransportadoras';

const HomeScreen = () => {

  return (
    <View>
      <ListaTransportadoras/>
    </View>
  );
};

export default HomeScreen;
