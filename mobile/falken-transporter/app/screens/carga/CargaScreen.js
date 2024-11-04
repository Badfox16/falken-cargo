import { View, Text, ScrollView, RefreshControl, LogBox } from 'react-native';
import React, { useEffect, useState, useCallback } from 'react';
import axios from 'axios';
import { API_BASE_URL } from '@env';
import ListaCargas from '../../components/ListaCargas';
import { useAuth } from '../../context/AuthContext';


export default function CargaScreen() {
  const [cargas, setCargas] = useState([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);
  const { user } = useAuth();
  const idUsuario = user?.idUsuario;

  const fetchCargas = async () => {
    try {
      const response = await axios.get(`${API_BASE_URL}/api/cargas/${idUsuario}`);
      setCargas(response.data);
    } catch (error) {
      console.error('Error fetching cargas:', error);
    } finally {
      setLoading(false);
      setRefreshing(false);
    }
  };

  useEffect(() => {
    fetchCargas();
    LogBox.ignoreLogs([
      'VirtualizedLists should never be nested inside plain ScrollViews with the same orientation',
    ]);
  }, []);

  const onRefresh = useCallback(() => {
    setRefreshing(true);
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
    <ScrollView
      refreshControl={
        <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
      }
    >
      <ListaCargas Cargas={cargas} />
    </ScrollView>
  );
}