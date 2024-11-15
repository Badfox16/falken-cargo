import React from 'react'
import { FlatList, Image, StyleSheet, Text, TouchableOpacity } from 'react-native'
import { View } from 'react-native'
import { useNavigation } from '@react-navigation/native'
import { API_BASE_URL } from '@env';

function ListaTransportadoras({ Transportadoras }) {
    const navigation = useNavigation()

    return (
        <View style={{marginHorizontal: 10}}>
            <FlatList
                data={Transportadoras}
                nestedScrollEnabled={true}
                renderItem={({ item }) => (
                    <View>
                        <TouchableOpacity style={styles.container} onPress={() => navigation.navigate('Transportadora', { Transportadora: item })}>
                            <Image source={{ uri: `${API_BASE_URL}${item.caminhoFoto}` }}
                                style={styles.img}
                            />
                            <View style={styles.textoLista}>
                                <Text numberOfLines={4} style={styles.titulo}>{item.nome}</Text>
                                <Text style={styles.tituloSec}> {item.endereco}</Text>
                                <Text style={styles.texto}>Contacto: {item?.telefone}</Text>
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
        resizeMode: 'contain',
    },
    container: {
        margin: 10,
        display: 'flex',
        flexDirection: 'row',
        backgroundColor: '#fff',
        borderRadius: 10,
        padding: 10,
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 2 },
        shadowOpacity: 0.8,
        shadowRadius: 2,
        elevation: 5,
    },
    titulo: {
        fontSize: 15,
        fontWeight: 'bold',
        color: 'grey'
    },
    tituloSec: {
        fontSize: 13,
        fontWeight: 'bold',
        marginBottom: 5,
        color: 'green',
    },
    texto: {
        marginTop: 1,
        color: '#030405',
        fontSize: 13,
    },
    textoLista: {
        marginRight: 130,
        marginLeft: 10,
    },
    borda: {
        height: 1,
        backgroundColor: 'green',
        marginTop: 5,
        marginLeft: -20
    }
})
export default ListaTransportadoras