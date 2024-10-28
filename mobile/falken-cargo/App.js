// App.js
import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { Ionicons } from 'react-native-vector-icons';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { SQLiteProvider } from './app/db/SQLiteContext';
import HomeScreen from './app/screens/HomeScreen';
import Login from './app/screens/LoginScreen';
import Cadastro from './app/screens/Cadastro';

const Tab = createBottomTabNavigator();

export default function App() {
  return (
    <SQLiteProvider>
      <NavigationContainer>
        <Tab.Navigator
          initialRouteName="Home"
          screenOptions={({ route }) => ({
            tabBarIcon: ({ color, size }) => {
              let iconName;
              if (route.name === 'Home') {
                iconName = 'home';
              } else if (route.name === 'Login') {
                iconName = 'log-in';
              } else if (route.name === 'Cadastro') {
                iconName = 'person-add';
              }
              return <Ionicons name={iconName} size={size} color={color} />;
            },
          })}
        >
          <Tab.Screen name="Home" component={HomeScreen} />
          <Tab.Screen name="Login" component={Login} />
          <Tab.Screen name="Cadastro" component={Cadastro} />
        </Tab.Navigator>
      </NavigationContainer>
    </SQLiteProvider>
  );
}
