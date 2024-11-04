import React from 'react';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import TabNavigator from './TabNavigator';
import DetalhesCarga from '../screens/carga/Detalhes';
import CriarCarga from '../screens/carga/Criar';
import EditarCarga from '../screens/carga/Editar';
import DetalhesTransportadora from '../screens/transportadora/Detalhes'
import Proposta from '../screens/proposta/Proposta';
import Login from '../screens/LoginScreen';
import { useAuth } from '../context/AuthContext';

const Stack = createNativeStackNavigator();

const MainNavigator = () => {
  const { user } = useAuth();

  return (
    <Stack.Navigator screenOptions={{ headerShown: false }}>
      {user ? (
        <>
          <Stack.Screen name="Tabs" component={TabNavigator} />
          <Stack.Screen name="Transportadora" component={DetalhesTransportadora} />
          <Stack.Screen name="Detalhes" component={DetalhesCarga} />
          <Stack.Screen name="Proposta" component={Proposta} />
          <Stack.Screen name="CriarCarga" component={CriarCarga} />
          <Stack.Screen name="EditarCarga" component={EditarCarga} />
        </>
      ) : (
        <Stack.Screen name="Login" component={Login} />
      )}
    </Stack.Navigator>
  );
};

export default MainNavigator;