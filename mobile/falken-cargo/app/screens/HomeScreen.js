// screens/HomeScreen.js
import React, { useEffect, useState } from 'react';
import { View, Text, Button, FlatList } from 'react-native';
import { useSQLite } from '../db/SQLiteContext';
import CargaForm from '../components/CargaForm';

const HomeScreen = () => {

  return (
    <View>
      <CargaForm/>
    </View>
  );
};

export default HomeScreen;
