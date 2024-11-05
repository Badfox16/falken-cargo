import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import HomeScreen from '../screens/home/HomeScreen';
import CargaScreen from '../screens/carga/CargaScreen';
import PropostaScreen from '../screens/proposta/PropostaScreen';
import { Ionicons } from 'react-native-vector-icons';

const Tab = createBottomTabNavigator();

const TabNavigator = () => {
  return (
    <Tab.Navigator
      initialRouteName="Cargas"
      screenOptions={({ route }) => ({
        tabBarIcon: ({ color, size }) => {
          let iconName;
          if (route.name === 'Cargas') {
            iconName = 'cube-outline';
          } else if (route.name === 'Perfil') {
            iconName = 'person-outline';
          } else if (route.name === 'Propostas') {
            iconName = 'document-text-outline';
          }
          return <Ionicons name={iconName} size={size} color={color} />;
        },
        tabBarActiveTintColor: 'tomato',
        tabBarInactiveTintColor: 'gray',
        headerShown: false,
      })}
    >
      <Tab.Screen name="Perfil" component={HomeScreen} />
      <Tab.Screen name="Cargas" component={CargaScreen} />
      <Tab.Screen name="Propostas" component={PropostaScreen} />
    </Tab.Navigator>
  );
};

export default TabNavigator;