import React, {
    useState,
    useEffect
}
    from 'react';
import {
    View,
    StatusBar,
    TouchableOpacity,
    Alert,
    ScrollView,
    Modal,
    Dimensions,
    PermissionsAndroid
} from 'react-native';
import {
    Appbar,
    TextInput,
    Text,
} from 'react-native-paper';
import LinearGradient from 'react-native-linear-gradient';
import AsyncStorage from '@react-native-async-storage/async-storage';
import Icon from "react-native-vector-icons/Feather";
import MapView, { Marker } from 'react-native-maps';
import { WaveIndicator } from 'react-native-indicators';
import DATA_API from "./../api/data";
const logo = require('./../../assets/image/laundry.png');
const Width = Dimensions.get('window').width;

function Register({ navigation, route }) {

 
    const par = route.params;

    const ImagePicker = require('react-native-image-picker');

    const [nama, setnama] = useState('')
    const [tlp, settlp] = useState('')
    const [alamat, setalamat] = useState(par != undefined ? par.alamat : '')
    const [lat, setlat] = useState(par != undefined ? par.lat : '')
    const [lng, setlng] = useState(par != undefined ? par.lat : '')
    const [deskripsi, setdeskripsi] = useState('')
    const [gambar, setgambar] = useState('')
    const [email, setemail] = useState('')
    const [password, setpassword] = useState('')


    const [loading, setloading] = useState(false)
    const [modalVisible, setModalVisible] = useState(false);

    
    // Hasil ambil data gambar
    const [filename, setfilename] = useState('')
    const [filetype, setfiletype] = useState('')
    const [fileuri, setfileuri] = useState('')

   

    const [passtype, setpasstype] = useState(true)
    const [icon, setIcon] = useState('eye-off');

    function heandleShow() {
        setpasstype(!passtype);
        setIcon(passtype ? 'eye' : 'eye-off');
    }


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
                        setgambar(source.fileName)
                        
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
                    setgambar(source.fileName)
                });
            } else {
              console.log('Camera permission denied');
            }
          } catch (err) {
            console.warn(err);
          }
        
    }

    function AksiRegistrasi() {
        setloading(true)

        const formData = new FormData();
        formData.append("nama", nama);
        formData.append("tlp", tlp);
        formData.append("alamat", alamat);
        formData.append("lat", lat);
        formData.append("lng", lng);
        formData.append("deskripsi", deskripsi);
        formData.append("email", email);
        formData.append("password", password);
        formData.append("gambar", {
            uri: fileuri,
            name: filename,
            type: filetype,
        });

        fetch(`${DATA_API}/registrasi`, {
            method: 'POST',
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            body: formData,
        })

            .then(response => response.json())
            .then(async function (data) {
                setloading(false)

                if (data.code === 200) {
                    setloading(false)
                    const id = JSON.stringify(data.data.id)
                    await AsyncStorage.setItem('siOwner', id);
                    navigation.replace("Home");

                } else {
                    setloading(false)
                    Alert.alert(`${data.code}`, `${data.message}`, [
                        { text: 'OK' },
                    ])
                 
                }
            })
            .catch((error) => {
                setloading(false)
                Alert.alert('404', `${error.message}`, [
                    {
                        text: 'Muat Ulang',
                        onPress: () => navigation.navigate('Register'),
                    },
                ])
            });
    }




    return (
        <>
            <ScrollView className="bg-white flex-1 relative">

                {
                    loading ? (
                        <View className="flex-1 flex items-center justify-center absolute w-full h-full z-50" style={{ backgroundColor: 'rgba(255,255,255,0.8)' }}>
                            <StatusBar barStyle={'dark-content'} backgroundColor={'transparent'} translucent />
                            <WaveIndicator color='#AB38E3' animationDuration={2000} size={70} />
                            <Text className="text-center font-medium text-sm text-[#AB38E3] absolute top-[57%]">Sedang memuat data ...</Text>
                        </View>
                    ) : null
                }
                <StatusBar barStyle={'dark-content'} backgroundColor={'transparent'} translucent />


                <Appbar.Header>
                    <Appbar.BackAction onPress={() => navigation.navigate("Login")} />
                    <Appbar.Content title="REGISTRASI AKUN" />
                </Appbar.Header>
                <View className="p-6">
                    <TextInput
                        label="Alamat"
                        value={alamat}
                        mode="outlined"
                        left={<TextInput.Icon icon="google-maps" />}
                        right={<TextInput.Icon icon="google-maps" onPress={() => navigation.navigate("Konfirmasilokasi")} />}
                        onChangeText={text => setalamat(text)}
                        disabled={true}
                        className="bg-slate-50 mb-6"
                    />
                    <TextInput
                        label="Nama"
                        value={nama}
                        mode="outlined"
                        left={<TextInput.Icon icon="lock" />}
                        onChangeText={text => setnama(text)}
                        className="bg-slate-50 mb-6"
                    />
                    <TextInput
                        label="Telepon"
                        value={tlp}
                        mode="outlined"
                        left={<TextInput.Icon icon="phone" />}
                        onChangeText={text => settlp(text)}
                        className="bg-slate-50 mb-6"
                    />
                   
                    <TextInput
                        label="Deskripsi"
                        value={deskripsi}
                        mode="outlined"
                        left={<TextInput.Icon icon="grease-pencil" />}
                        onChangeText={text => setdeskripsi(text)}
                        className="bg-slate-50 mb-6"
                    />
                    <TextInput
                        label="Gambar"
                        value={gambar}
                        mode="outlined"
                        left={<TextInput.Icon icon="camera-image" />}
                        right={<TextInput.Icon icon="camera" onPress={() => setModalVisible(true)} />}
                        onChangeText={text => setgambar(text)}
                        disabled={true}
                        className="bg-slate-50 mb-6"
                    />

                    <TextInput
                        label="Email"
                        value={email}
                        mode="outlined"
                        left={<TextInput.Icon icon="email-edit" />}
                        onChangeText={text => setemail(text)}
                        className="bg-slate-50 mb-6"
                    />
                    <TextInput
                        label="Password"
                        value={password}
                        mode="outlined"
                        left={<TextInput.Icon icon="lock" />}
                        right={<TextInput.Icon icon={icon} onPress={heandleShow} />}
                        onChangeText={text => setpassword(text)}
                        secureTextEntry={passtype}
                        className="bg-slate-50 mb-6"
                    />
                    <TouchableOpacity
                        onPress={AksiRegistrasi}
                    >
                        <LinearGradient colors={
                            ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
                        }
                            className="flex items-center justify-center px-6 py-4 bg-sky-600 rounded-md"
                            start={{ x: 0, y: 3 }} end={{ x: 2, y: 0 }}
                        >
                            <Text className="text-white text-base font-medium">REGISTRASI</Text>
                        </LinearGradient>
                    </TouchableOpacity>
                </View>



            </ScrollView>
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
                        <View className="p-6 gap-3 flex flex-row">
                        <TouchableOpacity
                            onPress={gunakanKamera}
                            className="flex items-center justify-center bg-slate-200 p-6 rounded-md"
                            style={{
                                width: Width / 2.4
                            }}
                        >
                            <Icon name="camera" size={50} color="#94a3b8" />
                            <Text className="text-slate-500 font-bold text-base mt-2">KAMERA</Text>
                        </TouchableOpacity>
                        <TouchableOpacity
                            onPress={gunakanGaleri}
                            className="flex items-center justify-center bg-slate-200 p-6 rounded-md ml-3"
                            style={{
                                width: Width / 2.4
                            }}
                        >
                            <Icon name="image" size={50} color="#94a3b8" />
                            <Text className="text-slate-500 font-bold text-base mt-2">GALERI</Text>
                        </TouchableOpacity>
                        </View>
                    </View>
                </View>
            </Modal>
           
        </>
    )
}

export default Register