// App.js
import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator} from '@react-navigation/native-stack';
import { SQLiteProvider } from './app/db/SQLiteContext';
import HomeScreen from './app/screens/HomeScreen';
import Login from './app/screens/LoginScreen';
import Cadastro from './app/screens/Cadastro';

const Stack = createNativeStackNavigator();

export default function App() {
  return (
    <SQLiteProvider>
      <NavigationContainer>
        <Stack.Navigator initialRouteName="Cadastro" screenOptions={{headerShown: false}}>
          <Stack.Screen name="Cadastro" component={Cadastro} />
          <Stack.Screen name="Home" component={HomeScreen} />
          <Stack.Screen name="Login" component={Login} />
        </Stack.Navigator>
      </NavigationContainer>
    </SQLiteProvider>
  );
}
