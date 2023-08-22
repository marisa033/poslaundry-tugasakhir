import React, {
    useState,
    useEffect
}
    from 'react';
import {
    View,
    Text,
    StatusBar,
    TouchableOpacity,
    TextInput,
    Image,
    Alert,
    ScrollView,
} from 'react-native';
import Icon from 'react-native-vector-icons/dist/Feather';
import LinearGradient from 'react-native-linear-gradient';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { WaveIndicator } from 'react-native-indicators';
import DATA_API from "./../api/data";
const logo = require('./../../assets/image/laundry.png');


function Login({ navigation }) {

    const [email, setemail] = useState('')
    const [emailfocus, setemailfocus] = useState(false)
    const [password, setpassword] = useState('')
    const [passwordfocus, setpasswordfocus] = useState(false)
    const [loading, setloading] = useState(true)
    const [passtype, setpasstype] = useState(true)
    const [icon, setIcon] = useState('eye-off');
    const [cekkoneksi, setcekkoneksi] = useState(false);

    useEffect(() => {
        async function cekLogin() {
            const cek = await AsyncStorage.getItem('siOwner');
                
                if (cek != null) {
                    
                    fetch(`${DATA_API}/data/${cek}`)
                    .then(response => response.json())
                    .then(function (data) {
                        setloading(false)
                        if (data.code === 200) {
                            navigation.replace('Home');
                        }
                    })
                    .catch((error) => {
                        setloading(false)
                        setcekkoneksi(true)
                    });
                    
                }else if(cek != undefined){
                    fetch(`${DATA_API}/data/${cek}`)
                    .then(response => response.json())
                    .then(function (data) {
                        setloading(false)
                        if (data.code === 200) {
                            navigation.replace('Home');
                        }
                    })
                    .catch((error) => {
                        setloading(false)
                        setcekkoneksi(true)
                    });
                }else{
                    setloading(false)
                }
        }
        cekLogin()
   
    }, [])
    

    


    function heandleShow() {
        setpasstype(!passtype);
        setIcon(passtype ? 'eye' : 'eye-off');
      }

    function Aksilogin() {
        setloading(true)
        const form  = JSON.stringify({
            email: email,
            password: password,
        });
       
        fetch(`${DATA_API}/login`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: form,
        })

        .then(response => response.json())
        .then(async function (data) {
            setloading(false)

            if (data.code === 200) {
                setloading(false)
                const id = JSON.stringify(data.data.id)
                await AsyncStorage.setItem('siOwner', id);
                navigation.navigate("Home");

            } else {
                setloading(false)
                Alert.alert(`${data.code}`, `${data.message}`, [
                    { text: 'OK' },
                ])
                setemail('')
                setpassword('')
            }

        })
        .catch((error) => {
            setloading(false)
            Alert.alert('404', `${error.message}`, [
                {
                    text: 'Muat Ulang',
                    onPress: () => navigation.navigate('Login'),
                },
            ])
        });
    }




    return (
        <ScrollView className="bg-white flex-1 relative">
            {
                loading ? (
                    <View className="flex-1 flex items-center justify-center absolute w-full h-full z-50" style={{ backgroundColor: 'rgba(255,255,255,0.8)' }}>
                        <StatusBar barStyle={'dark-content'} backgroundColor={'transparent'} translucent />
                        <WaveIndicator color='#AB38E3' animationDuration={2000} size={70} />
                        <Text className="text-center font-medium text-sm text-[#AB38E3] absolute top-[57%]">Sedang memuat data ...</Text>
                    </View>
                ) : (
                    cekkoneksi ? (
                        <View className="flex flex-row items-center justify-center px-6 pt-10 pb-4 bg-red-600 absolute w-full z-10">
                            <Text className="text-center font-medium text-white text-sm">Koneksi ke server gagal, coba periksa koneksi anda !</Text>
                        </View>
                    ) : null
                )
            }
            <StatusBar barStyle={'dark-content'} backgroundColor={'transparent'} translucent />

           
            <View className="flex justify-center pt-16">
                <View className="flex items-center justify-center p-6">
                    <Image source={logo} className="w-[120px] h-[120px]" />
                </View>
                <View className="p-6">
                    <Text className="text-3xl text-purple-600 mb-2 text-center font-bold">MITRA LOGIN</Text>
                    <Text className="text-base text-slate-600 text-center">Silahkan login menggunakan akun anda, dan dapatkan pelanggan anda !</Text>
                </View>
            </View>
            <View className="p-6">
                <View className="relative">
                    <Text>Email</Text>
                    <View className={`${emailfocus == true && email.length != 0 ? ('border-b-2 border-sky-600') : ('border-b-2 border-slate-300')} relative mb-3`}>
                        <View className="flex items-center justify-center w-[57px] h-[57px] absolute z-10">
                            <Icon name="mail" size={20} color="#94a3b8" />
                        </View>
                        <TextInput
                            className={` h-[57px] pl-[57px] text-base text-slate-600 font-medium`}
                            placeholder='Email ...'
                            placeholderTextColor={'#94a3b8'}
                            onChangeText={(val) => setemail(val)}
                            onFocus={() => setemailfocus(true)}
                            onBlur={() => setemailfocus(false)}
                        />
                    </View>
                    <View className={`${passwordfocus == true && password.length != 0 ? ('border-b-2 border-sky-600') : ('border-b-2 border-slate-300')} relative`}>

                        <View className="flex items-center justify-center w-[57px] h-[57px] absolute z-10">
                            <Icon name="key" size={20} color="#94a3b8" />
                        </View>
                        <TextInput
                            className={` h-[57px] pl-[57px] text-base text-slate-600 font-medium`}
                            placeholder='Password ...'
                            placeholderTextColor={'#94a3b8'}
                            onChangeText={(val) => setpassword(val)}
                            onFocus={() => setpasswordfocus(true)}
                            onBlur={() => setpasswordfocus(false)}
                            secureTextEntry={passtype}
                        />
                        <TouchableOpacity  onPress={heandleShow} className="flex items-center justify-center w-[57px] h-[57px] absolute z-10 right-0">
                            <Icon name={icon} size={20} color="#94a3b8" />
                        </TouchableOpacity>
                    </View>
                </View>
                <View className="mt-12 mb-6">
                    <TouchableOpacity
                        onPress={Aksilogin}
                    >
                        <LinearGradient colors={
                            ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
                        }
                            className="flex items-center justify-center px-6 py-4 bg-sky-600 rounded-md"
                            start={{ x: 0, y: 3 }} end={{ x: 2, y: 0 }}
                        >
                            <Text className="text-white text-base font-medium">SIGN-IN</Text>
                        </LinearGradient>
                    </TouchableOpacity>
                </View>
                <View className="flex items-center justify-center">
                    <TouchableOpacity
                        onPress={() => navigation.navigate("Register")}
                        className="flex flex-row items-center justify-center"
                    >
                        <Text className="text-base font-medium text-slate-600">Belum punya akun ?!,</Text>
                        <Text className="text-base font-medium text-purple-600 mx-3 underline underline-offset-2">Daftar disini !</Text>
                    </TouchableOpacity>
                </View>
            </View>
        </ScrollView>
    )
}

export default Login