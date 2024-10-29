// App.js
import React from 'react';
import { StatusBar } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { SQLiteProvider } from './app/db/SQLiteContext';
import { AuthProvider, useAuth } from './app/context/AuthContext';
import HomeScreen from './app/screens/HomeScreen';
import CargaScreen from './app/screens/CargaScreen';
import PropostaScreen from './app/screens/PropostaScreen';
import DetalhesCarga from './app/screens/Carga';
import { Ionicons } from 'react-native-vector-icons';
import Login from './app/screens/LoginScreen';
import Proposta from './app/screens/Proposta';

const Tab = createBottomTabNavigator();
const Stack = createNativeStackNavigator();

function TabNavigator() {
  return (
    <Tab.Navigator
      initialRouteName="Cargas"
      screenOptions={({ route }) => ({
        tabBarIcon: ({ color, size }) => {
          let iconName;
            if (route.name === 'Cargas') {
            iconName = 'cube-outline';
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
      <Tab.Screen name="Cargas" component={CargaScreen} />
      <Tab.Screen name="Propostas" component={PropostaScreen} />
    </Tab.Navigator>
  );
}

export default function App() {
  return (
    <AuthProvider>
      <SQLiteProvider>
        <StatusBar barStyle="light-content" />
        <NavigationContainer>
          <MainNavigator />
        </NavigationContainer>
      </SQLiteProvider>
    </AuthProvider>
  );
}

function MainNavigator() {
  const { user } = useAuth();

  return (
    <Stack.Navigator screenOptions={{ headerShown: false }}>
      {user ? (
        <>
          <Stack.Screen name="Tabs" component={TabNavigator} />
          <Stack.Screen name="Detalhes" component={DetalhesCarga} />
          <Stack.Screen name="Proposta" component={Proposta} />
        </>
      ) : (
        <Stack.Screen name="Login" component={Login} />
      )}
    </Stack.Navigator>
  );
}