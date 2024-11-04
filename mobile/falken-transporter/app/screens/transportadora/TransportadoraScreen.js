import { View, Text, ScrollView, RefreshControl, LogBox } from 'react-native';
import React, { useEffect, useState, useCallback } from 'react';
import axios from 'axios';
import { API_BASE_URL } from '@env';
import ListaTransportadoras from '../../components/ListaTransportadoras';

export default function TransportadoraScreen() {
  const [Transportadoras, setTransportadoras] = useState([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);

  const fetchTransportadoras = async () => {
    try {
      const response = await axios.get(`${API_BASE_URL}/api/transportadoras`);
      setTransportadoras(response.data);
    } catch (error) {
      console.error('Error fetching Transportadoras:', error);
    } finally {
      setLoading(false);
      setRefreshing(false);
    }
  };

  useEffect(() => {
    fetchTransportadoras();
    LogBox.ignoreLogs([
      'VirtualizedLists should never be nested inside plain ScrollViews with the same orientation',
    ]);
  }, []);

  const onRefresh = useCallback(() => {
    setRefreshing(true);
    fetchTransportadoras();
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
      <ListaTransportadoras Transportadoras={Transportadoras} />
    </ScrollView>
  );
}