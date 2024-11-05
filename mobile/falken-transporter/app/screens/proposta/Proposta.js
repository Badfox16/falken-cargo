import { View, Text, Image, StyleSheet, Dimensions, TouchableOpacity, ScrollView } from 'react-native'
import React from 'react'
import { useNavigation, useRoute } from '@react-navigation/native'
import Ionicons from '@expo/vector-icons/Ionicons';
import { API_BASE_URL } from '@env';
import axios from 'axios';

export default function Proposta() {
    const Proposta = useRoute().params.Proposta
    const navigation = useNavigation()

    const capitalizeFirstLetter = (string) => {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    const handleAcceptProposal = async () => {
        try {
            const response = await axios.put(`${API_BASE_URL}/api/propostas/aceitar/${Proposta.idProposta}`, {
                idProposta: Proposta.idProposta
            });
            if (response.status === 200) {
                alert('Proposta aceita com sucesso!');
                navigation.goBack();
            }
        } catch (error) {
            alert('Erro ao aceitar a proposta');
        }
    };

    const handleRejectProposal = async () => {
        try {
            const response = await axios.put(`${API_BASE_URL}/api/propostas/recusar/${Proposta.idProposta}`, {
                idProposta: Proposta.idProposta
            });
            if (response.status === 200) {
                alert('Proposta recusada com sucesso!');
                navigation.goBack();
            }
        } catch (error) {
            alert('Erro ao recusar a proposta');
        }
    };
    
    return (
        <ScrollView style={styles.container} showsVerticalScrollIndicator={false} >
            <View style={{ display: 'flex', flexDirection: 'row', justifyContent: 'space-between', marginVertical: 10 }}>
                <TouchableOpacity onPress={() => navigation.goBack()}>
                    <Ionicons name="arrow-back-circle-outline" size={28} color={'green'} />
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
                <Text style={styles.titulo2}>Transportadora:</Text>
                <Text style={styles.description}> {Proposta.nomeTransportadora}</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Preço:</Text>
                <Text style={styles.texto}> {Proposta.precoFrete},00 MZN</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'row' }}>
                <Text style={styles.titulo2}>Endereço da Transportadora:</Text>
                <Text style={[styles.description, { flex: 1, flexWrap: 'wrap' }]}> {Proposta.enderecoTransportadora}</Text>
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
        
        {Proposta.estado.toLowerCase() === 'pendente' && (
            <View style={{ display: 'flex', flexDirection: 'row', justifyContent: 'space-around', marginVertical: 20 }}>
                <TouchableOpacity style={styles.buttonAccept} onPress={handleAcceptProposal}>
                    <Text style={styles.buttonText}>Aceitar</Text>
                </TouchableOpacity>
                <TouchableOpacity style={styles.buttonReject} onPress={handleRejectProposal}>
                    <Text style={styles.buttonText}>Recusar</Text>
                </TouchableOpacity>
            </View>
        )}
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
    },
    buttonAccept: {
        backgroundColor: 'green',
        padding: 10,
        borderRadius: 5,
        alignItems: 'center',
        width: '40%',
    },
    buttonReject: {
        backgroundColor: 'red',
        padding: 10,
        borderRadius: 5,
        alignItems: 'center',
        width: '40%',
    },
    buttonText: {
        color: 'white',
        fontWeight: 'bold',
        fontSize: 16,
    }
})
