import React from 'react'
import { FlatList, Image, StyleSheet, Text, TouchableOpacity } from 'react-native'
import { View } from 'react-native'
import { useNavigation } from '@react-navigation/native'
import { API_BASE_URL } from '@env';
import { Ionicons } from '@expo/vector-icons'; // Importar ícone

function ListaCargas({ Cargas }) {
    const navigation = useNavigation()

    return (
        <View style={{marginHorizontal: 10}}>
            <TouchableOpacity 
                style={styles.addButton} 
                onPress={() => navigation.navigate('CriarCarga')}
            >
                <Ionicons name="add-circle" size={50} color="green" />
            </TouchableOpacity>
            <FlatList
                data={Cargas}
                nestedScrollEnabled={true}
                renderItem={({ item }) => (
                    <View>
                        <TouchableOpacity style={styles.container} onPress={() => navigation.navigate('Detalhes', { Carga: item })}>
                            <Image source={{ uri: `${API_BASE_URL}${item.caminhoFoto}` }}
                                style={styles.img}
                            />
                            <View style={styles.textoLista}>
                                <Text numberOfLines={4} style={styles.titulo}>{item.descricao}</Text>
                                <Text style={styles.tituloSec}>Tipo - {item?.tipoCarga}</Text>
                                <Text style={styles.texto}>Origem: {item.origem}</Text>
                                <Text style={styles.texto}>Destino: {item.destino}</Text>
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
    img: {
        width: 110,
        height: 100,
        borderRadius: 10,
    },
    container: {
        margin: 10,
        flexDirection: 'row',
        alignItems: 'center',
    },
    addButton: {
        alignItems: 'center',
        marginVertical: 10,
    },
    textoLista: {
        marginLeft: 10,
        flex: 1,
    },
    titulo: {
        fontSize: 16,
        fontWeight: 'bold',
    },
    tituloSec: {
        fontSize: 14,
        fontWeight: 'bold',
        color: 'green',
    },
    texto: {
        fontSize: 14,
    },
    borda: {
        borderBottomWidth: 1,
        borderBottomColor: '#ccc',
        marginHorizontal: 10,
    },
});

export default ListaCargas;