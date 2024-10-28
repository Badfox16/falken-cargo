import { View, Text, ScrollView } from 'react-native';
import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { API_BASE_URL } from '@env';
import ListaCargas from '../components/ListaCargas';

export default function CargaScreen() {
  const [cargas, setCargas] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchCargas = async () => {
      try {
        const response = await axios.get(`${API_BASE_URL}/api/cargas`);
        setCargas(response.data);
        
      } catch (error) {
        console.error('Error fetching cargas:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchCargas();
  }, []);

  if (loading) {
    return (
      <View>
        <Text>A carregar...</Text>
      </View>
    );
  }

  return (
    <ScrollView>
      <ListaCargas Cargas={cargas} />
    </ScrollView>
  );
}