import React from 'react'
import { FlatList, Image, StyleSheet, Text, TouchableOpacity } from 'react-native'
import { View } from 'react-native'
import { useNavigation } from '@react-navigation/native'
import { API_BASE_URL } from '@env';
import { MaterialIcons } from '@expo/vector-icons';

function ListaPropostas({ Propostas }) {
    const navigation = useNavigation()

    const capitalizeFirstLetter = (string) => {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString(undefined, options);
    };

    return (
        <View style={styles.mainContainer}>
            <FlatList
                data={Propostas}
                nestedScrollEnabled={true}
                renderItem={({ item }) => (
                    <View>
                        <TouchableOpacity style={styles.container} onPress={() => navigation.navigate('Proposta', { Proposta: item })}>
                            <View style={styles.textoLista}>
                                <Text numberOfLines={4} style={styles.titulo}>{(item.descricao)}</Text>
                                <Text style={styles.tituloSec}>Tipo - {(item?.tipoCarga)}</Text>
                                <View style={{display:'flex', flexDirection:'row', justifyContent:'space-between'}}>
                                    <View style={styles.estadoContainer}>
                                        <MaterialIcons name="date-range" size={16} color="green" />
                                        <Text style={styles.texto}>Data: {formatDate(item.dataProposta)}</Text>
                                    </View>
                                    <View style={styles.estadoContainer}>
                                        <MaterialIcons name="info" size={16} color="green" />
                                        <Text style={styles.texto}>Estado: {capitalizeFirstLetter(item.estado)}</Text>
                                    </View>
                                </View>
                                <Text style={styles.tituloSec}>Frete: {item.precoFrete},00 MZN</Text>
                            </View>
                        </TouchableOpacity>
                        <View style={styles.borda}></View>
                    </View>
                )}
            />
        </View>
    )
}

const styles = StyleSheet.create({
    mainContainer: {
        flex: 1,
        backgroundColor: '#f5f5f5',
        padding: 10,
    },
    container: {
        backgroundColor: '#fff',
        borderRadius: 10,
        padding: 15,
        marginBottom: 10,
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 2 },
        shadowOpacity: 0.1,
        shadowRadius: 5,
        elevation: 3,
    },
    textoLista: {
        marginBottom: 10,
    },
    titulo: {
        fontSize: 16,
        fontWeight: 'bold',
        color: '#333',
    },
    tituloSec: {
        fontSize: 14,
        color: 'green',
        fontWeight: 'bold',
        marginTop: 5,
    },
    estadoContainer: {
        flexDirection: 'row',
        alignItems: 'center',
        marginTop: 5,
    },
    texto: {
        fontSize: 14,
        color: '#666',
        marginLeft: 5,
    },
    borda: {
        height: 1,
        backgroundColor: '#ddd',
        marginVertical: 10,
    },
})
export default ListaPropostas