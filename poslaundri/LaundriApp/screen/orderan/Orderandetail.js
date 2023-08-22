import React, {
    useEffect,
    useState
} from 'react';
import {
    View,
    FlatList,
    StatusBar,
    TouchableOpacity,
    Image,
    Alert,
    ScrollView,
    Modal,
    Dimensions,
    PermissionsAndroid,
} from 'react-native';
import {
    Appbar,
    TextInput,
    Text,
} from 'react-native-paper';
import Icon from 'react-native-vector-icons/dist/Feather';
import LinearGradient from 'react-native-linear-gradient';
import { WaveIndicator } from 'react-native-indicators';
import AsyncStorage from '@react-native-async-storage/async-storage';
import DATA_API from "./../api/data";
import IMAGE_API from "./../api/images";

const Width = Dimensions.get('window').width;

const Orderandetail = ({ navigation, route }) => {
    const ImagePicker = require('react-native-image-picker');

    const id = route.params.item.id
    const [data, setdata] = useState('')
    const [loading, setloading] = useState(true)

    const [modalVisible, setModalVisible] = useState(false);
    // Hasil ambil data gambar
    const [filename, setfilename] = useState('')
    const [filetype, setfiletype] = useState('')
    const [fileuri, setfileuri] = useState('')



    useEffect(() => {
        ambilOrderan()
    }, [])

    // Ambil data layanan
    async function ambilOrderan() {

        fetch(`${DATA_API}/orderan/detail/${id}`)
            .then(response => response.json())
            .then(async function (data) {
                setloading(false)
                if (data.code === 200) {
                    setdata(data.data[0])
                }
            })
            .catch((error) => {
                setloading(false)
                console.log(error.message)
            });
    }

    async function batalOrderan() {
        setloading(true)

        const formData = new FormData();
        formData.append("id", id);
        formData.append("status_order", "Batal");
        await fetch(`${DATA_API}/orderan/editBatal`, {
            method: 'POST',
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            body: formData,
        })

            .then(response => response.json())
            .then(function (data) {
                setloading(false)

                if (data.code === 200) {
                    setloading(false)
                    setdata(data.data[0])
                    setModalVisible(false)
                    Alert.alert(`${data.code}`, `${data.message}`, [
                        {
                            text: 'OK',
                            onPress: () => navigation.replace('Orderan'),
                        },
                    ])
                } else {
                    setloading(false)
                    Alert.alert(`${data.code}`, `${data.message}`, [
                        {
                            text: 'OK',
                        },
                    ])
                }

            })
            .catch((error) => {
                setloading(false)
                console.log('ok')
            });
    }




    //  Selesaikan orderan bayar ditempat

    async function bayarDitempat() {
        setModalVisible(false)
        setloading(true)

        const formData = new FormData();
        formData.append("id", id);
        formData.append("status_order", "Selesai");
        formData.append("tipe", "Bayar Ditempat");
        await fetch(`${DATA_API}/orderan/edit`, {
            method: 'POST',
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            body: formData,
        })

            .then(response => response.json())
            .then(function (data) {
                setloading(false)

                if (data.code === 200) {
                    setloading(false)
                    setdata(data.data[0])
                    setModalVisible(false)
                    Alert.alert(`${data.code}`, `${data.message}`, [
                        {
                            text: 'OK',
                            onPress: () => navigation.navigate('Orderan'),
                        },
                    ])
                } else {
                    setloading(false)
                    Alert.alert(`${data.code}`, `${data.message}`, [
                        {
                            text: 'OK',
                        },
                    ])
                }

            })
            .catch((error) => {
                setloading(false)
                console.log('ok')
            });
    }

    // Selesaikan orderan fia transfer
    async function bayarTransfer() {
        setModalVisible(false)
        try {
            const granted = await PermissionsAndroid.request(
                PermissionsAndroid.PERMISSIONS.CAMERA,
                {
                    title: 'Cool Photo App Camera Permission',
                    message:
                        'Cool Photo App needs access to your camera ' +
                        'so you can take awesome pictures.',
                    buttonNeutral: 'Ask Me Later',
                    buttonNegative: 'Cancel',
                    buttonPositive: 'OK',
                },
            );
            if (granted === PermissionsAndroid.RESULTS.GRANTED) {
                let options = {
                    storageOptions: {
                        skipBackup: true,
                        path: 'images',
                    },
                };
                ImagePicker.launchCamera(options, res => {

                    let source = res.assets[0];


                    const formData = new FormData();
                    formData.append("id", id);
                    formData.append("status_order", "Selesai");
                    formData.append("tipe", "Transfer");
                    formData.append("bukti", {
                        uri: source.uri,
                        name: source.fileName,
                        type: source.type,
                    });
                    fetch(`${DATA_API}/orderan/edit`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        },
                        body: formData,
                    })

                        .then(response => response.json())
                        .then(function (data) {
                            setloading(false)

                            if (data.code === 200) {
                                setloading(false)
                                setdata(data.data[0])
                                setModalVisible(false)
                                Alert.alert(`${data.code}`, `${data.message}`, [
                                    {
                                        text: 'OK',
                                        onPress: () => navigation.replace('Orderan'),
                                    },
                                ])
                            } else {
                                setloading(false)
                                Alert.alert(`${data.code}`, `${data.message}`, [
                                    {
                                        text: 'OK',
                                    },
                                ])
                            }

                        })
                        .catch((error) => {
                            setloading(false)
                            console.log('ok')
                        });


                });
            } else {
                console.log('Camera permission denied');
            }
        } catch (err) {
            console.warn(err);
        }
    }


    return (
        <View>
            {
                loading ? (
                    <View className="flex-1 flex items-center justify-center absolute w-full h-full z-50" style={{ backgroundColor: 'rgba(255,255,255,0.8)' }}>
                        <StatusBar barStyle={'dark-content'} backgroundColor={'transparent'} translucent />
                        <WaveIndicator color='#AB38E3' animationDuration={2000} size={70} />
                        <Text className="text-center font-medium text-sm text-[#AB38E3] absolute top-[57%]">Sedang memuat data ...</Text>
                    </View>
                ) : null
            }
            <LinearGradient colors={
                ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
            }
                className="flex flex-row items-center justify-between pt-8 pb-2"
                start={{ x: 0, y: 2 }} end={{ x: 2, y: 0 }}
            >
                <View className="flex flex-row items-center">
                    <View className="flex flex-row items-center">
                        <TouchableOpacity
                            onPress={() => navigation.replace("Orderan")}
                            className="w-[57px] h-[57px] items-center justify-center"
                        >
                            <Icon name="arrow-left" size={24} color="white" />
                        </TouchableOpacity>
                        <Text className="mx-4 text-xl font-medium text-white">DETAIL ORDERAN</Text>
                    </View>
                </View>
            </LinearGradient>
            {
                data.layanan != undefined ? (
                    <ScrollView className="mt-3 p-6">
                        <View className="p-6 bg-white mb-3 border-2 border-slate-300 rounded-md border-dotted">
                            <Text className="font-bold text-xl text-slate-600 mb-6">Orderan</Text>
                            <Image source={{ uri: `${IMAGE_API}/${data.gambar_order}` }} className="w-full h-40 rounded-md mb-3" />
                            <View className="flex flex-row items-center justify-between mb-3">
                                <Text className="font-medium text-base text-slate-500">Tanggal</Text>
                                <Text className="font-medium text-base text-slate-600">{data.created_at}</Text>
                            </View>
                            <View className="flex flex-row items-center justify-between mb-3">
                                <Text className="font-medium text-base text-slate-500">Status</Text>
                                <Text className="font-medium text-base text-slate-600">{data.status_order}</Text>
                            </View>
                            <View className="flex flex-row items-center justify-between mb-3">
                                <Text className="font-medium text-base text-slate-500">Layanan</Text>
                                <Text className="font-medium text-base text-slate-600">{data.layanan.nama_layanan}</Text>
                            </View>
                            <View className="flex flex-row items-center justify-between mb-3">
                                <Text className="font-medium text-base text-slate-500">Berat</Text>
                                <Text className="font-medium text-base text-slate-600">{data.berat + ' / ' + data.layanan.satuan_harga}</Text>
                            </View>
                            <View className="flex flex-row items-center justify-between mb-3">
                                <Text className="font-medium text-base text-slate-500">Harga Satuan</Text>
                                <Text className="font-medium text-base text-slate-600">{data.layanan.harga_layanan}</Text>
                            </View>
                            <View className="flex flex-row items-center justify-between mb-3">
                                <Text className="font-medium text-base text-slate-500">Subtotal</Text>
                                <Text className="font-medium text-base text-slate-600">{data.total}</Text>
                            </View>
                        </View>

                        {
                            data.pembayaran != null ? (
                                data.pembayaran.tipe == 'Bayar ditempat' ? (
                                    <View className={`p-6 bg-white border-2 border-slate-300 rounded-md border-dotted ${data.pembayaran != null && data.status_order === 'Proses' ? 'mb-6' : 'mb-[160px]'}`}>
                                        <Text className="font-bold text-xl text-slate-600 mb-6">Pembayaran</Text>
                                        <View className="flex flex-row items-center justify-between mb-3">
                                            <Text className="font-medium text-base text-slate-500">Tipe Pembayaran</Text>
                                            <Text className="font-medium text-base text-slate-600">{data.pembayaran.tipe}</Text>
                                        </View>
                                        <View className="flex flex-row items-center justify-between mb-3">
                                            <Text className="font-medium text-base text-slate-500">Status Pembayaran</Text>
                                            <Text className="font-medium text-base text-slate-600">{data.pembayaran.status}</Text>
                                        </View>
                                    </View>
                                ) : (
                                    <View className={`p-6 bg-white border-2 border-slate-300 rounded-md border-dotted ${data.pembayaran != null && data.status_order === 'Proses' ? 'mb-6' : 'mb-[160px]'}`}>
                                        <Text className="font-bold text-xl text-slate-600 mb-6">Pembayaran</Text>
                                        <View className="flex flex-row items-center justify-between mb-3">
                                            <Text className="font-medium text-base text-slate-500">Tipe Pembayaran</Text>
                                            <Text className="font-medium text-base text-slate-600">{data.pembayaran.tipe}</Text>
                                        </View>
                                        <View className="flex flex-row items-center justify-between mb-3">
                                            <Text className="font-medium text-base text-slate-500">Status Pembayaran</Text>
                                            <Text className="font-medium text-base text-slate-600">{data.pembayaran.status}</Text>
                                        </View>
                                        <View className="flex mb-3">
                                            <Text className="font-medium text-base text-slate-500 mb-6">Bukti Pembayaran</Text>
                                            <Image source={{ uri: `${IMAGE_API}/${data.pembayaran.bukti}` }} className="w-full h-40 rounded-md mb-3" />
                                        </View>

                                    </View>
                                )

                            ) : (
                                data.status_order === 'Proses' ? (
                                    <>
                                        <Text className="text-base font-medium text-yellow-400 text-center">Orderan Sedang diproses</Text>
                                        <View className="flex flex-row items-center justify-between mt-6 mb-[150px]">
                                            <TouchableOpacity
                                                onPress={() => setModalVisible(true)}
                                                className="flex items-center justify-center px-6 py-4 bg-purple-600 rounded" style={{ width: Width / 2.5 }}
                                            >
                                                <Text className="text-base font-medium text-white">Selesaikan</Text>
                                            </TouchableOpacity>
                                            <TouchableOpacity
                                                onPress={batalOrderan}
                                                className="flex items-center justify-center px-6 py-4 bg-red-600 rounded" style={{ width: Width / 2.5 }}
                                            >
                                                <Text className="text-base font-medium text-white">Batalkan</Text>
                                            </TouchableOpacity>
                                        </View>
                                    </>

                                ) : null
                            )
                        }

                        {
                            data.pembayaran != null && data.status_order === 'Proses' ? (
                                <TouchableOpacity
                                    onPress={selesaiOrderan}
                                    className="flex items-center justify-center px-6 py-4 bg-green-600 mb-[150px]"
                                >
                                    <Text className="text-base font-medium text-white">Orderan Selesai</Text>
                                </TouchableOpacity>
                            ) : null
                        }


                    </ScrollView>
                ) : null
            }
            <Modal
                animationType="fade"
                transparent={true}
                visible={modalVisible}
            >
                <StatusBar barStyle={'dark-content'} backgroundColor={'transparent'} translucent />
                <View className="flex-1 items-end justify-end " style={{ backgroundColor: 'rgba(0,0,0,0.3)' }}>
                    <View className=" bg-white w-full rounded-t-[40px]">
                        <TouchableOpacity
                            onPress={() => setModalVisible(false)}
                            className="flex items-center justify-center p-6"
                        >
                            <View className="w-[50px] h-1 rounded-lg bg-slate-600"></View>
                        </TouchableOpacity>
                        <View className="p-6">
                            <View>
                                <TouchableOpacity
                                    onPress={bayarDitempat}
                                    className="flex flex-row items-center mb-6"
                                >
                                    <View className="w-8 h-8 border-2 border-slate-400 rounded-md"></View>
                                    <Text className="text-base font-medium ml-3 uppercase text-slate-400">(COD) BAYAR DITEMPAT</Text>
                                </TouchableOpacity>
                                <TouchableOpacity
                                    onPress={bayarTransfer}
                                    className="flex flex-row items-center mb-6"
                                >
                                    <View className="w-8 h-8 border-2 border-slate-400 rounded-md"></View>
                                    <Text className="text-base font-medium ml-3 uppercase text-slate-400">VIA TRANSFER</Text>
                                </TouchableOpacity>
                            </View>
                        </View>
                    </View>
                </View>
            </Modal>
        </View>
    )
}

export default Orderandetail