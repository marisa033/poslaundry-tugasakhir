import React, {useEffect, useState} from 'react';
import { 
    View, 
    Text,
    StatusBar,
    ScrollView,
    TouchableOpacity,
    Image,
    useWindowDimensions,
    Modal,
    Dimensions,
    Alert,
    PermissionsAndroid
} from 'react-native';
import { 
    Appbar,
    List, 
    MD3Colors,
    Button 
} from 'react-native-paper';

import AsyncStorage from '@react-native-async-storage/async-storage';
import { WaveIndicator } from 'react-native-indicators';
import Icon from 'react-native-vector-icons/dist/Feather';
import RenderHtml from 'react-native-render-html';

import DATA_API from "./../api/data";
import IMAGE_API from "./../api/images";

const Width = Dimensions.get('window').width;

const Akun = ({navigation}) => {
    useEffect(() => {
        ambilLaundri()
    }, [])
     // Ambil galeri camera
     const ImagePicker = require('react-native-image-picker');
    const [laundri, setlaundri] = useState('');
    const [loading, setloading] = useState(true);
    const [urlimage, seturlimage] = useState(`${IMAGE_API}`);

    

   

    // Ambil data profil
    async function ambilLaundri() {
        const value = await AsyncStorage.getItem('siOwner');
    
        if (value !== null) {
            fetch(`${DATA_API}/data/${value}`)
            .then(response => response.json())
            .then(async function (data) {
                setloading(false)
                if (data.code === 200) {
                    setlaundri(data.data[0])
                }
            })
            .catch((error) => {
                setloading(false)
                console.log(error.message)
            });
        }
    }

    const { width } = useWindowDimensions();
    const source = {
        html: `<p style='font-size: 14px'>${laundri.deskripsi}</p>`
    };

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
                        setloading(true)
                        let source = res.assets[0];


                        const formData = new FormData();
                        formData.append('id', laundri.id)
                        formData.append("gambar", {
                            uri: source.uri,
                            name: source.fileName,
                            type: source.type,
                        });


                        fetch(`${DATA_API}/data/updateFotoProfil`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'multipart/form-data',
                            },
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(async function (data) {
                            setloading(false)
                            setModalVisible(false)

                            if (data.code === 200) {
                                setloading(false)
                                navigation.replace("Akun");

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
                                    onPress: () => navigation.navigate('Akun'),
                                },
                            ])
                        });
                    }
                });
            } else {
              console.log('Camera permission denied');
            }
          } catch (err) {
            console.warn(err);
          }
        

    }


    async function aksiLogout(){
        setloading(true)
        try {
            await AsyncStorage.removeItem('siOwner')
            navigation.navigate("Login");
          } catch(e) {
            // remove error
          }
        
        
       
    }

   
    return (
        <ScrollView>
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
            <Appbar.Header className="bg-slate-50">
                <Appbar.BackAction onPress={()=> navigation.navigate("Home")} />
                <Appbar.Content title="PROFILE" />
            </Appbar.Header>
            <View className="flex items-center justify-center bg-slate-50 relative">
                <View
                    className="flex items-center justify-center w-full p-6 relative"
                >
                    <Image source={{ uri: `${urlimage}/${laundri.gambar}` }} className="w-[120px] h-[120px] rounded-full elevated={4}" />
                    <TouchableOpacity
                        onPress={gunakanGaleri}
                        className="absolute w-[120px] h-[120px] flex items-end justify-end"
                    >
                        <View className="flex items-center justify-center p-3 rounded-full border-2 border-purple-600" style={{ backgroundColor: 'rgba(0,0,0,0.3)' }}>
                            <Icon name={'camera'} size={20} color={'white'} />
                        </View>
                    </TouchableOpacity>
                </View>
            </View>
            <View className="p-6">
                <List.Section>
                    <List.Item 
                        title="Nama" 
                        left={() => <List.Icon icon="account" />} 
                        right={() => <Text className="text-base text-slate-500 font-medium">{laundri.nama}</Text>} 
                    />
                    <List.Item 
                        title="Telepon" 
                        left={() => <List.Icon icon="cellphone" />} 
                        right={() => <Text className="text-base text-slate-500 font-medium">{laundri.tlp}</Text>} 
                    />
                    <List.Item 
                        title="Alamat" 
                        left={() => <List.Icon icon="map" />} 
                        
                    />
                    <List.Item title={() => <Text className="text-base text-slate-500 font-medium top-[-20px]">{laundri.alamat}</Text>}/>
                    <List.Item 
                        title="Deskripsi" 
                        left={() => <List.Icon icon="pen" />} 
                        
                    />
                 
                    <List.Item title={() => <Text className="text-base text-slate-500 font-medium top-[-20px]">{laundri.deskripsi}</Text>}/>
                    
                </List.Section>
                <View>
                    <TouchableOpacity
                        onPress={()=> navigation.navigate("Akunupdate")}
                        className="flex items-center justify-center px-6 py-4 bg-purple-600 rounded-md mb-3"
                    >
                        <Text className="text-base font-medium text-white uppercase">Update Profile</Text>
                    </TouchableOpacity>
                    <TouchableOpacity
                        onPress={aksiLogout}
                        className="flex items-center justify-center px-6 py-4 bg-red-500 rounded-md mb-3"
                    >
                        <Text className="text-base font-medium text-white uppercase">LOGOUT</Text>
                    </TouchableOpacity>
                </View>
            </View>
           
        </ScrollView>
    )
}

export default Akun