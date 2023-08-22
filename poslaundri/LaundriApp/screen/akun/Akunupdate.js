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

function Akunupdate({ navigation, route }) {

    
    const [laundri, setlaundri] = useState('');

    const par = route.params;

    useEffect(() => {
        ambilLaundri()
    }, [])
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



    const [nama, setnama] = useState(laundri)
    const [tlp, settlp] = useState(laundri)
    const [alamat, setalamat] = useState(par != undefined ? par.alamat : laundri.alamat)
    const [lat, setlat] = useState(par != undefined ? par.lat : laundri.lat)
    const [lng, setlng] = useState(par != undefined ? par.lng : laundri.lng)
    const [deskripsi, setdeskripsi] = useState(laundri.deskripsi)

    const [email, setemail] = useState(laundri.email)
    const [password, setpassword] = useState('')


    const [loading, setloading] = useState(false)
   

   

    const [passtype, setpasstype] = useState(true)
    const [icon, setIcon] = useState('eye-off');


    

    function heandleShow() {
        setpasstype(!passtype);
        setIcon(passtype ? 'eye' : 'eye-off');
    }

    
    function AksiEditAkun() {
        // setloading(true)

        const formData = new FormData();
        formData.append("id", laundri.id);
        formData.append("nama", nama == '' ? laundri.nama : nama);
        formData.append("tlp", tlp == '' ? laundri.tlp : tlp);
        formData.append("alamat", alamat == undefined ? laundri.alamat : alamat);
        formData.append("lat", lat == undefined ? laundri.lat : lat);
        formData.append("lng", lng == undefined ? laundri.lng : lng);
        formData.append("deskripsi", deskripsi == undefined ? laundri.deskripsi : deskripsi);
        formData.append("email", email == undefined ? laundri.email : email);
        formData.append("password", password);

       
        
    
        fetch(`${DATA_API}/data/updateProfil`, {
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
                    navigation.replace("Akun");

                } else {
                    setloading(false)
                    Alert.alert(`${data.code}`, `${data.message}`, [
                        { text: 'OK', onPress: () => navigation.navigate('Akun'),},
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
                    <Appbar.BackAction onPress={() => navigation.replace("Akun")} />
                    <Appbar.Content title="EDIT AKUN" />
                </Appbar.Header>
                <View className="p-6">
                    <TextInput
                        label="Alamat"
                        value={alamat}
                        mode="outlined"
                        left={<TextInput.Icon icon="google-maps" />}
                        right={<TextInput.Icon icon="google-maps" onPress={() => navigation.navigate("Konfirmasialamat")} />}
                        onChangeText={text => setalamat(text)}
                        disabled={true}
                        className="bg-slate-50 mb-6"
                    />
                    <TextInput
                        label={laundri.nama}
                        value={nama}
                        mode="outlined"
                        left={<TextInput.Icon icon="lock" />}
                        onChangeText={text => setnama(text)}
                        className="bg-slate-50 mb-6"
                    />
                    <TextInput
                        label={laundri.tlp}
                        value={tlp}
                        mode="outlined"
                        left={<TextInput.Icon icon="phone" />}
                        onChangeText={text => settlp(text)}
                        className="bg-slate-50 mb-6"
                    />
                   
                    <TextInput
                        label={laundri.deskripsi}
                        value={deskripsi}
                        mode="outlined"
                        left={<TextInput.Icon icon="grease-pencil" />}
                        onChangeText={text => setdeskripsi(text)}
                        className="bg-slate-50 mb-6"
                    />
                    

                    <TextInput
                        label={laundri.email}
                        value={email}
                        mode="outlined"
                        left={<TextInput.Icon icon="email-edit" />}
                        onChangeText={text => setemail(text)}
                        className="bg-slate-50 mb-6"
                    />
                    <TextInput
                        label="Password"
                        mode="outlined"
                        left={<TextInput.Icon icon="lock" />}
                        right={<TextInput.Icon icon={icon} onPress={heandleShow} />}
                        onChangeText={text => setpassword(text)}
                        secureTextEntry={passtype}
                        className="bg-slate-50 mb-6"
                    />
                    <TouchableOpacity
                        onPress={AksiEditAkun}
                    >
                        <LinearGradient colors={
                            ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
                        }
                            className="flex items-center justify-center px-6 py-4 bg-sky-600 rounded-md"
                            start={{ x: 0, y: 3 }} end={{ x: 2, y: 0 }}
                        >
                            <Text className="text-white text-base font-medium">EDIT</Text>
                        </LinearGradient>
                    </TouchableOpacity>
                </View>



            </ScrollView>
   
        </>
    )
}

export default Akunupdate