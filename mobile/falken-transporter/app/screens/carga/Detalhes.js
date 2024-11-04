import { View, Text, Image, StyleSheet, Dimensions, TouchableOpacity, ScrollView, Share } from 'react-native'
import React from 'react'
import { useNavigation, useRoute } from '@react-navigation/native'
import Ionicons from '@expo/vector-icons/Ionicons';
import { useAuth } from '../../context/AuthContext';
import { API_BASE_URL } from '@env';

export default function Carga() {
    const Carga = useRoute().params.Carga
    const navigation = useNavigation()
    const { user } = useAuth();

    const editarCarga = () => {
        navigation.navigate('EditarCarga', { Carga });
    }

    return (
        <ScrollView style={styles.container} showsVerticalScrollIndicator={false} >
            <View style={{ display: 'flex', flexDirection: 'row', justifyContent: 'space-between', marginVertical: 10 }}>
                <TouchableOpacity onPress={() => navigation.goBack()}>
                    <Ionicons name="arrow-back-circle-outline" size={28} color={'green'} />
                </TouchableOpacity>
            </View>
            <Image source={{ uri: `${API_BASE_URL}${Carga.caminhoFoto}` }} style={styles.imagem} />
            <Text style={styles.titulo}>{Carga.descricao}</Text>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Tipo de Carga:</Text>
                <Text style={styles.texto}> {Carga.tipoCarga}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Origem:</Text>
                <Text style={styles.description}> {Carga.origem}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Destino:</Text>
                <Text style={styles.texto}> {Carga.destino}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Preço:</Text>
                <Text style={styles.texto}> {Carga.precoFrete},00 MZN</Text>
            </View>
            <TouchableOpacity onPress={() => editarCarga()} style={{ marginTop: 20, alignItems: 'center' }}>
                <View style={{ backgroundColor: 'green', padding: 10, borderRadius: 5 }}>
                    <Text style={{ color: 'white', fontWeight: 'bold' }}>Editar Carga</Text>
                </View>
            </TouchableOpacity>
        </ScrollView>
    )
}

const styles = StyleSheet.create({
    container: {
        margin: 10,
    },
    imagem: {
        height: Dimensions.get('screen').width * 0.75,
        borderRadius: 15,
        width: '100%',
    },
    titulo: {
        fontSize: 20,
        fontWeight: 'bold',
        marginTop: 5,
        color: 'green',
    },
    titulo2: {
        fontSize: 16,
        fontWeight: 'bold',
        marginTop: 5,
        color: 'green',
    },
    texto: {
        color: 'gray',
        fontSize: 15,
        marginTop: 5,
    },
    description: {
        marginTop: 5,
        color: 'grey',
        fontWeight: 'bold',
        fontSize: 15,
        lineHeight: 20,
    },
    ler: {
        fontSize: 15,
        fontWeight: 'bold',
        color: 'gray',
    }
})
