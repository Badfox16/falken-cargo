import { View, Text, ScrollView, RefreshControl, LogBox } from 'react-native';
import React, { useEffect, useState, useCallback } from 'react';
import axios from 'axios';
import { API_BASE_URL } from '@env';
import ListaPropostas from '../../components/ListaPropostas';
import { useAuth } from '../../context/AuthContext';


export default function PropostaScreen() {
  const [Propostas, setPropostas] = useState([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);
  const { user } = useAuth();

  const fetchPropostas = async () => {
    try {
      const response = await axios.get(`${API_BASE_URL}/api/propostas`, {
        params: {
          idTransportadora: user.idTransportadora
        }
      });
      setPropostas(response.data);
      
    } catch (error) {
      console.error('Error fetching Propostas:', error);
    } finally {
      setLoading(false);
      setRefreshing(false);
    }
  };

  useEffect(() => {
    fetchPropostas();
    LogBox.ignoreLogs([
      'VirtualizedLists should never be nested inside plain ScrollViews with the same orientation',
    ]);
  }, []);

  const onRefresh = useCallback(() => {
    setRefreshing(true);
    fetchPropostas();
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
      <ListaPropostas Propostas={Propostas} />
    </ScrollView>
  );
}