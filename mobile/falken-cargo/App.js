// App.js
import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { Ionicons } from 'react-native-vector-icons';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { SQLiteProvider } from './app/db/SQLiteContext';
import HomeScreen from './app/screens/HomeScreen';
import Login from './app/screens/LoginScreen';
import Cadastro from './app/screens/Cadastro';
import CargaScreen from './app/screens/CargaScreen';
import PropostaScreen from './app/screens/PropostaScreen';

const Tab = createBottomTabNavigator();

export default function App() {
  return (
    <SQLiteProvider>
      <NavigationContainer>
        <Tab.Navigator
          initialRouteName="Inicio"
          screenOptions={({ route }) => ({
            tabBarIcon: ({ color, size }) => {
              let iconName;
              if (route.name === 'Inicio') {
                iconName = 'home';
              } else if (route.name === 'Cargas') {
                iconName = 'log-in';
              } else if (route.name === 'Propostas') {
                iconName = 'person-add';
              }
              return <Ionicons name={iconName} size={size} color={color} />;
            },
          })}
        >
          <Tab.Screen name="Inicio" component={HomeScreen} />
          <Tab.Screen name="Cargas" component={CargaScreen} />
          <Tab.Screen name="Propostas" component={PropostaScreen} />
        </Tab.Navigator>
      </NavigationContainer>
    </SQLiteProvider>
  );
}
