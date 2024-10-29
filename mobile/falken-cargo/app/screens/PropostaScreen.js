import { View, Text, ScrollView, RefreshControl } from 'react-native';
import React, { useEffect, useState, useCallback } from 'react';
import axios from 'axios';
import { API_BASE_URL } from '@env';
import ListaPropostas from '../components/ListaPropostas';
import { useAuth } from '../context/AuthContext';


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
      console.log(response.data);
      
    } catch (error) {
      console.error('Error fetching Propostas:', error);
    } finally {
      setLoading(false);
      setRefreshing(false);
    }
  };

  useEffect(() => {
    fetchPropostas();
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