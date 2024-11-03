import React from 'react';
import { StatusBar } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { AuthProvider } from './app/context/AuthContext';
import MainNavigator from './app/navigation/MainNavigator';

export default function App() {
  return (
    <AuthProvider>
        <StatusBar barStyle="light-content" />
        <NavigationContainer>
          <MainNavigator />
        </NavigationContainer>
    </AuthProvider>
  );
}