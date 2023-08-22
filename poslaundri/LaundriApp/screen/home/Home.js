import React, {
    useEffect,
    useState
} from 'react';
import {
    View,
    Text,
    Image,
    StatusBar,
    TouchableOpacity,
    Dimensions,
    FlatList,
    ScrollView,
} from 'react-native';
import Icon from 'react-native-vector-icons/dist/Feather';
import LinearGradient from 'react-native-linear-gradient';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { WaveIndicator } from 'react-native-indicators';
import DATA_API from "./../api/data";
import IMAGE_API from "./../api/images";
const Width = Dimensions.get('window').width;

const Home = ({ navigation }) => {

    useEffect(() => {
        ambilLaundri()
        ambilStok()
    }, [])

    const [laundri, setlaundri] = useState('');
    const [loading, setloading] = useState(true);
    const [urlimage, seturlimage] = useState(`${IMAGE_API}`);

    const [pendapatan, setpendapatan] = useState(0);

    const [layanan, setlayanan] = useState(0);

    const [datastok, setdatastok] = useState([]);
    const [orderhariini, setorderhariini] = useState([]);



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
                        setpendapatan(data.data.totalpendapatan)
                        setlayanan(data.data.totallayanan)
                        setorderhariini(data.data.orderHariini)
                    }
                })
                .catch((error) => {
                    setloading(false)
                    console.log(error.message)
                });
        }
    }

    // Ambil data stok
    async function ambilStok() {
        const value = await AsyncStorage.getItem('siOwner');
        if (value !== null) {
            fetch(`${DATA_API}/stok/${value}`)
                .then(response => response.json())
                .then(async function (data) {
                    setloading(false)
                    if (data.code === 200) {
                        setdatastok(data.data)
                    }

                })
                .catch((error) => {
                    setloading(false)
                    console.log(error.message)
                });
        }
    }

    function formatRupiah(number) {
        if (typeof number !== 'number') {
            return "Invalid input";
        }
        
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(number);
    }

    let dataCounter = [
        {
            'id': 1,
            'icon': 'dollar-sign',
            'title': 'Total Pendapatan',
            'subtitle': `Rp. ${formatRupiah(pendapatan)}`,
            'background': 'bg-green-600',
        },
        {
            'id': 2,
            'icon': 'shopping-cart',
            'title': 'Orderan Hari ini',
            'subtitle': `${orderhariini}`,
            'background': 'bg-sky-600',
        },
        {
            'id': 3,
            'icon': 'clipboard',
            'title': 'Total Layanan',
            'subtitle': `${layanan}`,
            'background': 'bg-purple-600',
        },
    ];

    

    if (loading) {
        return (
            <View className="flex-1 flex items-center justify-center w-full h-full z-50" style={{ backgroundColor: 'rgba(255,255,255,0.8)' }}>
                <StatusBar barStyle={'dark-content'} backgroundColor={'transparent'} translucent />
                <WaveIndicator color='#AB38E3' animationDuration={2000} size={70} />
                <Text className="text-center font-medium text-sm text-[#AB38E3] absolute top-[57%]">Sedang memuat data ...</Text>
            </View>
        )
    }

    function renderItem({ item }) {
        return (
            <View className={`${item.background} flex flex-row rounded-md p-3 m-3`}>
                <View className="flex items-center justify-center p-6">
                    <Icon name={`${item.icon}`} size={40} color="#FFFFFF" />
                </View>
                <View className="p-4">
                    <Text className="text-3xl font-bold text-white mb-3">{item.subtitle}</Text>
                    <Text className="text-xl font-bold text-white uppercase">{item.title}</Text>
                </View>
            </View>
        )
    }

    function listHeader() {
        return (
            <>
                <View className="flex flex-row items-center justify-between p-6 m-3 rounded-lg bg-blue-400">
                    <View className="flex flex-row">
                        <View>
                            <Text className="text-base font-bold text-white">Selamat Datang</Text>
                            <Text className="text-xl font-bold text-white mb-3">{laundri.nama}</Text>
                            <Text className="text-slate-100">Silahkan olah data laundry anda, dan dapatkan banyak pelanggan karena keunggulan fitur layanan pada laundry anda</Text>
                        </View>
                    </View>
                </View>
                {
                    datastok != undefined || datastok != '' ? (
                        <ScrollView>
                            <View className="px-6">
                                {datastok.map((item) => (
                                    item.jumlah <= 10 ? (
                                        <TouchableOpacity
                                            key={item.id}
                                            onPress={() => navigation.replace("Stok")}
                                            className="p-6 bg-red-500 rounded-md mb-3"
                                        >
                                            <Text className="text-base font-bold text-white">Stok {item.nama_stok} Tinggal {item.jumlah}</Text>
                                            <Text className="text-base font-bold text-white">Silahkan update stok !</Text>
                                        </TouchableOpacity>
                                    ) : null

                                ))}
                            </View>
                        </ScrollView>
                    ) : null
                }

            </>
        )
    }

    return (
        <View className="flex-1 bg-white">
            <StatusBar barStyle={'light-content'} backgroundColor={'transparent'} translucent />
            <LinearGradient colors={
                ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
            }
                className="flex flex-row items-center justify-between px-6 bg-sky-600 pt-12 pb-4"
                start={{ x: 0, y: 2 }} end={{ x: 2, y: 0 }}
            >
                <View className="flex flex-row">
                    <Image source={{ uri: `${urlimage}/${laundri.gambar}` }} className="w-[38px] h-[38px] rounded-full" />
                    <View className="mx-4">
                        <Text className="text-base font-medium text-white">{laundri.nama}</Text>
                        <Text className="text-sm text-white">{laundri.email}</Text>
                    </View>
                </View>
                <TouchableOpacity onPress={() => navigation.replace("Laporan")}>
                    <Icon name="archive" size={24} color="#ffffff" />
                </TouchableOpacity>
            </LinearGradient>

            <FlatList
                data={dataCounter}
                renderItem={renderItem}
                ListHeaderComponent={listHeader}
                style={{
                    marginBottom: 87
                }}
            />
            <View className="absolute bottom-0 flex flex-row w-full">
                <TouchableOpacity
                    onPress={() => navigation.navigate("Home")}
                    className="flex items-center justify-center py-4" style={{ width: Width / 5 }}
                >
                    <Icon name="home" size={20} color="#6d28d9" />
                    <Text className="font-medium text-xs text-purple-700 mt-2">HOME</Text>
                </TouchableOpacity>
                <TouchableOpacity
                    onPress={() => navigation.navigate("Layanan")}
                    className="flex items-center justify-center py-4" style={{ width: Width / 5 }}
                >
                    <Icon name="layers" size={20} color="#94a3b8" />
                    <Text className="font-medium text-xs text-slate-400 mt-2">LAYANAN</Text>
                </TouchableOpacity>
                <TouchableOpacity
                    onPress={() => navigation.navigate("Orderan")}
                    className="flex items-center justify-center py-4" style={{ width: Width / 5 }}
                >
                    <Icon name="shopping-cart" size={20} color="#94a3b8" />
                    <Text className="font-medium text-xs text-slate-400 mt-2">ORDERAN</Text>
                </TouchableOpacity>
                <TouchableOpacity
                    onPress={() => navigation.navigate("Stok")}
                    className="flex items-center justify-center py-4" style={{ width: Width / 5 }}
                >
                    <Icon name="list" size={20} color="#94a3b8" />
                    <Text className="font-medium text-xs text-slate-400 mt-2">STOK</Text>
                </TouchableOpacity>
                <TouchableOpacity
                    onPress={() => navigation.navigate("Akun")}
                    className="flex items-center justify-center py-4" style={{ width: Width / 5 }}
                >
                    <Icon name="users" size={20} color="#94a3b8" />
                    <Text className="font-medium text-xs text-slate-400 mt-2">AKUN</Text>
                </TouchableOpacity>
            </View>
        </View>
    )
}

export default Home