import { View, Text, Image, StyleSheet, Dimensions, TouchableOpacity, ScrollView } from 'react-native'
import React from 'react'
import { useNavigation, useRoute } from '@react-navigation/native'
import Ionicons from '@expo/vector-icons/Ionicons';
import { API_BASE_URL } from '@env';

export default function Proposta() {
    const Proposta = useRoute().params.Proposta
    const navigation = useNavigation()

    const capitalizeFirstLetter = (string) => {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    return (
        <ScrollView style={styles.container} showsVerticalScrollIndicator={false} >
            <View style={{ display: 'flex', flexDirection: 'row', justifyContent: 'space-between', marginVertical: 10 }}>
                <TouchableOpacity onPress={() => navigation.goBack()}>
                    <Ionicons name="arrow-back-circle-outline" size={28} color={'tomato'} />
                </TouchableOpacity>
            </View>
            <Image source={{ uri: `${API_BASE_URL}${Proposta.caminhoFoto}` }} style={styles.imagem} />
            <Text style={styles.titulo}>{Proposta.descricao}</Text>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Tipo de Proposta:</Text>
                <Text style={styles.texto}> {Proposta.tipoCarga}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Origem:</Text>
                <Text style={styles.description}> {Proposta.origem}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Destino:</Text>
                <Text style={styles.texto}> {Proposta.destino}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Contratante:</Text>
                <Text style={styles.description}> {Proposta.nomeUsuario} {Proposta.apelidoUsuario}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Preço:</Text>
                <Text style={styles.texto}> {Proposta.precoFrete},00 MZN</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Estado da Proposta:</Text>
                <Text style={styles.texto}> {capitalizeFirstLetter(Proposta.estado)}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Data da Proposta:</Text>
                <Text style={styles.texto}> {new Date(Proposta.dataProposta).toLocaleDateString()}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Estado da Carga:</Text>
                <Text style={styles.texto}> {capitalizeFirstLetter(Proposta.estadoCarga)}</Text>
            </View>
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
        color: 'tomato',
    },
    titulo2: {
        fontSize: 16,
        fontWeight: 'bold',
        marginTop: 5,
        color: 'tomato',
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
