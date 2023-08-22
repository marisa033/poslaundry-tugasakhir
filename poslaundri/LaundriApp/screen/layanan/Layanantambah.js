import React, {
    useEffect,
    useState
} from 'react';
import {
    View,
    Text,
    StatusBar,
    TouchableOpacity,
    ScrollView,
    TextInput,
    Modal,
    Dimensions,
    Alert,
    PermissionsAndroid
} from 'react-native';
import Icon from 'react-native-vector-icons/dist/Feather';
import LinearGradient from 'react-native-linear-gradient';
import { WaveIndicator } from 'react-native-indicators';
import DATA_API from "./../api/data";
const Width = Dimensions.get('window').width;

const Layanantambah = ({ navigation, route }) => {



    // Ambil galeri camera
    const ImagePicker = require('react-native-image-picker');

    // loading 
    const [loading, setloading] = useState(false)

    // Setup inputan
    const [id_laundri, setid_laundri] = useState(route.params.laundri.id)
    const [nama_kategori, setnama_kategori] = useState('')
    const [nama_layanan, setnama_layanan] = useState('')
    const [gambar_layanan, setgambar_layanan] = useState('')
    const [satuan_harga, setsatuan_harga] = useState('')
    const [harga_layanan, setharga_layanan] = useState('')
    const [deskripsi_layanan, setdeskripsi_layanan] = useState('')
    // Setup inputan focus
 
    const [nama_kategorifocus, setnama_kategorifocus] = useState(false)
    const [nama_layananfocus, setnama_layananfocus] = useState(false)
    const [gambar_layananfocus, setgambar_layananfocus] = useState(false)
    const [satuan_hargafocus, setsatuan_hargafocus] = useState(false)
    const [harga_layananfocus, setharga_layananfocus] = useState(false)
    const [deskripsi_layananfocus, setdeskripsi_layananfocus] = useState(false)

    // Setup modal camera atau galeri
    const [modalVisible, setModalVisible] = useState(false);

    // Hasil ambil data gambar
    const [filename, setfilename] = useState('')
    const [filetype, setfiletype] = useState('')
    const [fileuri, setfileuri] = useState('')



    // Ambil gambar pada galeri
    async function gunakanGaleri() {
        try {
            const granted = await PermissionsAndroid.request(
                PermissionsAndroid.PERMISSIONS.CAMERA,{
                title: 'Cool Photo App Camera Permission',
                message:
                  'Cool Photo App needs access to your camera ' +
                  'so you can take awesome pictures.',
                buttonNeutral: 'Ask Me Later',
                buttonNegative: 'Cancel',
                buttonPositive: 'OK',
              });
            if (granted === PermissionsAndroid.RESULTS.GRANTED) {
                var options = {
                    title: 'Pilih gambar',
                    customButtons: [
                        {
                            name: 'customOptionKey',
                            title: 'Choose file from Custom Option'
                        },
                    ],
                    storageOptions: {
                        skipBackup: true,
                        path: 'images',
                    },
                };
                ImagePicker.launchImageLibrary(options, res => {
        
                    if (res.didCancel) {
                        console.log('User cancelled image picker');
                    } else if (res.error) {
                        console.log('ImagePicker Error: ', res.error);
                    } else if (res.customButton) {
                        console.log('User tapped custom button: ', res.customButton);
                      
                    } else {
                        let source = res.assets[0];
                        setModalVisible(false)
                        setfilename(source.fileName)
                        setfiletype(source.type)
                        setfileuri(source.uri)
                        setgambar_layanan(source.fileName)
                        setgambar_layananfocus(true)
                    }
                });
            } else {
              console.log('Camera permission denied');
            }
          } catch (err) {
            console.warn(err);
          }
        

    }
    // Ambil gambar pada kamera
    async function gunakanKamera() {
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
                    setModalVisible(false)
                    setfilename(source.fileName)
                    setfiletype(source.type)
                    setfileuri(source.uri)
                    setgambar_layanan(source.fileName)
                    setgambar_layananfocus(true)
                });
            } else {
              console.log('Camera permission denied');
            }
          } catch (err) {
            console.warn(err);
          }
        
    }

   


    // Tombol simpan layanan
    async function simpanLayanan(){
        setloading(false)
        const formData = new FormData();
        formData.append("id_laundri", id_laundri);
        formData.append("nama_kategori", nama_kategori);
        formData.append("nama_layanan", nama_layanan);
        formData.append("satuan_harga", satuan_harga);
        formData.append("harga_layanan", harga_layanan);
        formData.append("deskripsi_layanan", deskripsi_layanan);
        formData.append("gambar_layanan", {
            uri : fileuri,
            name: filename,
            type: filetype,
        });

       
        await fetch(`${DATA_API}/layanan/tambah`, {
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
             
                Alert.alert(`${data.code}`, `${data.message}`, [
                    {
                        text: 'OK',
                        onPress: () => {navigation.replace("Layanan")}
                    },
                ])
             

            } else {
                setloading(false)
                Alert.alert(`${error.message}`, `${error.message}`, [
                    {
                        text: 'OK',
                    },
                ])
            }

        })
        .catch((error) => {
            setloading(false)
            Alert.alert(`${error.message}`, `Periksa koneksi jaringan anda, atau server API anda !`, [
                {
                    text: 'OK',
                },
            ])
        });
    }


    return (
        <View>
            
            <StatusBar barStyle={'light-content'} backgroundColor={'transparent'} translucent />
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
                className="flex flex-row items-center justify-between pt-8 pb-2 absolute w-full z-10"
                start={{ x: 0, y: 2 }} end={{ x: 2, y: 0 }}

            >
                <View className="flex flex-row items-center">
                    <View className="flex flex-row items-center">
                        <TouchableOpacity
                            onPress={() => navigation.navigate("Layanan")}
                            className="w-[57px] h-[57px] items-center justify-center"
                        >
                            <Icon name="arrow-left" size={24} color="white" />
                        </TouchableOpacity>
                        <Text className="mx-4 text-xl font-medium text-white">TAMBAH LAYANAN</Text>
                    </View>

                </View>
            </LinearGradient>
            <ScrollView className="p-6 mt-24">
                <View className="mb-3">
                    <Text className="text-base font-medium text-slate-500 mb-1">Layanan</Text>
                    <TextInput
                        className={`rounded-md bg-slate-200 text-base font-medium text-slate-500 px-6 py-4 ${nama_layananfocus ? ('border-2 border-purple-600') : ('border-2 border-slate-200')}`}
                        placeholder='Layanan ...'
                        placeholderTextColor={{
                            color: 'grey'
                        }}
                        onChangeText={(val) => setnama_layanan(val)}
                        onFocus={() => setnama_layananfocus(true)}
                        onBlur={() => setnama_layananfocus(false)}
                    />
                </View>
                <View className="mb-3">
                    <Text className="text-base font-medium text-slate-500 mb-1">Kategori</Text>
                    <TextInput
                        className={`rounded-md bg-slate-200 text-base font-medium text-slate-500 px-6 py-4 ${nama_kategorifocus ? ('border-2 border-purple-600') : ('border-2 border-slate-200')}`}
                        placeholder='Kategori ...'
                        placeholderTextColor={{
                            color: 'grey'
                        }}
                        onChangeText={(val) => setnama_kategori(val)}
                        onFocus={() => setnama_kategorifocus(true)}
                        onBlur={() => setnama_kategorifocus(false)}
                    />
                </View>
                <View className="mb-3">
                    <Text className="text-base font-medium text-slate-500 mb-1">Gambar</Text>
                    <TouchableOpacity onPress={() => setModalVisible(true)} className={`rounded-md bg-slate-200 text-base font-medium text-slate-500 px-6 py-5 ${gambar_layananfocus ? ('border-2 border-purple-600') : ('border-2 border-slate-200')}`}>
                        <Text className="text-base font-medium text-slate-400">{gambar_layanan == '' ? ('Gambar layanan') : gambar_layanan}</Text>
                    </TouchableOpacity>
                </View>
                <View className="mb-3">
                    <Text className="text-base font-medium text-slate-500 mb-1">Harga</Text>
                    <TextInput
                        className={`rounded-md bg-slate-200 text-base font-medium text-slate-500 px-6 py-4 ${harga_layananfocus ? ('border-2 border-purple-600') : ('border-2 border-slate-200')}`}
                        placeholder='Harga ...'
                        placeholderTextColor={{
                            color: 'grey'
                        }}
                        onChangeText={(val) => setharga_layanan(val)}
                        onFocus={() => setharga_layananfocus(true)}
                        onBlur={() => setharga_layananfocus(false)}
                    />
                </View>
                <View className="mb-3">
                    <Text className="text-base font-medium text-slate-500 mb-1">Satuan</Text>
                    <TextInput
                        className={`rounded-md bg-slate-200 text-base font-medium text-slate-500 px-6 py-4 ${satuan_hargafocus ? ('border-2 border-purple-600') : ('border-2 border-slate-200')}`}
                        placeholder='Satuan ...'
                        placeholderTextColor={{
                            color: 'grey'
                        }}
                        onChangeText={(val) => setsatuan_harga(val)}
                        onFocus={() => setsatuan_hargafocus(true)}
                        onBlur={() => setsatuan_hargafocus(false)}
                    />
                </View>
                <View className="mb-3">
                    <Text className="text-base font-medium text-slate-500 mb-1">Deskripsi</Text>
                    <TextInput
                        className={`rounded-md bg-slate-200 text-base font-medium text-slate-500 px-6 py-4 ${deskripsi_layananfocus ? ('border-2 border-purple-600') : ('border-2 border-slate-200')}`}
                        placeholder='Deskripsi ...'
                        placeholderTextColor={{
                            color: 'grey'
                        }}
                        onChangeText={(val) => setdeskripsi_layanan(val)}
                        onFocus={() => setdeskripsi_layananfocus(true)}
                        onBlur={() => setdeskripsi_layananfocus(false)}
                    />
                </View>
                <View className="mt-6 mb-[50px]">
                    <TouchableOpacity 
                        onPress={simpanLayanan} 
                        className="flex items-center justify-center px-6 py-4 bg-purple-600"
                    >
                        <Text className="text-base font-medium text-white">SIMPAN</Text>
                    </TouchableOpacity>
                </View>
            </ScrollView>


            <Modal
                animationType="fade"
                transparent={true}
                visible={modalVisible}
            >
                <View className="flex-1 w-screen h-full justify-end relative">
                    <TouchableOpacity
                        onPress={() => setModalVisible(false)}
                        className="absolute bottom-[25%] left-0 w-full h-[57px] items-center justify-center"
                    >
                        <View className="w-[50px] h-[3px] bg-slate-500 block rounded-md"></View>
                    </TouchableOpacity>
                    <View className="bg-white p-6 w-screen flex flex-row items-center justify-center">
                        <TouchableOpacity
                            onPress={gunakanKamera}
                            className="flex items-center justify-center bg-slate-200 p-6 rounded-md"
                            style={{
                                width: Width / 2.3
                            }}
                        >
                            <Icon name="camera" size={50} color="#94a3b8" />
                            <Text className="text-slate-500 font-medium text-base mt-2">KAMERA</Text>
                        </TouchableOpacity>
                        <TouchableOpacity
                            onPress={gunakanGaleri}
                            className="flex items-center justify-center bg-slate-200 p-6 rounded-md ml-3"
                            style={{
                                width: Width / 2.3
                            }}
                        >
                            <Icon name="image" size={50} color="#94a3b8" />
                            <Text className="text-slate-500 font-medium text-base mt-2">GALERI</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </Modal>
        </View>
    )
}

export default Layanantambah