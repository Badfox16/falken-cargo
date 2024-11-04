import { View, Text } from 'react-native'
import React from 'react'
import CargaForm from '../../components/CargaForm'

export default function Criar() {
  return (
    <View>
        <Text style={{color:'green', fontSize:18, fontWeight:'bold', marginHorizontal:'auto'}}>Criar Carga</Text>
        <CargaForm/>
    </View>
  )
}