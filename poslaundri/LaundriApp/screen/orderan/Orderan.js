import React, {
    useEffect, 
    useState
} from 'react';
import { 
    View, 
    Text,
    FlatList,
    StatusBar,
    TouchableOpacity,
    Image,
    Alert,
} from 'react-native';
import Icon from 'react-native-vector-icons/dist/Feather';
import LinearGradient from 'react-native-linear-gradient';
import { WaveIndicator } from 'react-native-indicators';
import AsyncStorage from '@react-native-async-storage/async-storage';
import DATA_API from "./../api/data";
import IMAGE_API from "./../api/images";

const Orderan = ({navigation}) => {

    const [loading, setloading] = useState(true);
    const [orderan, setorderan] = useState('');
    

    useEffect(() => {
        ambilOrderan()
    }, [])

    // Ambil data layanan
    async function ambilOrderan() {
        const value = await AsyncStorage.getItem('siOwner');
        if (value !== null) {
            fetch(`${DATA_API}/orderan/semua/${value}`)
                .then(response => response.json())
                .then(async function (data) {
                    setloading(false)
                    if (data.code === 200) {
                        setorderan(data.data)
                    }
                })
                .catch((error) => {
                    setloading(false)
                    console.log(error.message)
                });
        }
    }


    
   
   

    function listHeader(){
        return(
            <LinearGradient colors={
                ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
            }
                className="flex flex-row items-center justify-between pt-8 pb-2"
                start={{ x: 0, y: 2 }} end={{ x: 2, y: 0 }}
                
            >
                <View className="flex flex-row items-center justify-between">
                    <View className="flex flex-row items-center">
                        <TouchableOpacity
                            onPress={() => navigation.navigate("Home")}
                            className="w-[57px] h-[57px] items-center justify-center"
                        >
                            <Icon name="arrow-left" size={24} color="white" />
                        </TouchableOpacity>
                        <Text className="mx-4 text-xl font-medium text-white">DATA ORDERAN</Text>
                    </View>
                    
                </View> 
                <TouchableOpacity
                        onPress={() => navigation.navigate("Orderantambah")}
                        className="w-[57px] h-[57px] items-center justify-center"
                    >
                        <Icon name="plus" size={24} color="white" />
                </TouchableOpacity>
            </LinearGradient>
        )
    }

    

    function renderItem({item}){

        
        return(
            <TouchableOpacity onPress={() => navigation.navigate("Orderandetail", {item})} className="flex flex-row justify-between py-6 pl-6 bg-white mb-[1.6px]">
                <View className="flex flex-row">
                    <Image source={{ uri: `${IMAGE_API}/${item.gambar_order}` }} className="w-[60px] h-[60px] rounded-md" />
                    <View className="ml-4">
                        <Text className="text-base font-normal text-slate-600">{item.nama}</Text>
                        <View className="flex flex-row items-center">
                            <Text className="text-base text-slate-500">Berat</Text>
                            <Text className="text-base text-slate-500 mx-2">{item.berat + ' / ' + item.layanan.satuan_harga}</Text>
                        </View>
                        <View className="flex flex-row items-center">
                            <Text className="text-base text-slate-500">Total</Text>
                            <Text className="text-base text-slate-500 mx-2">{item.total}</Text>
                        </View>
                        <View className="flex flex-row items-center">
                            <Icon name="calendar" size={11} color="#010101" />
                            <Text className="text-[11px] text-slate-500 mx-2">{item.created_at}</Text>
                        </View>
                    </View>
                    
                </View>
                <View className="flex flex-row items-center w-1/3 justify-center">
                    {   
                        item.status_order == 'Baru' ? (<Text className="text-base font-medium text-yellow-500">Baru</Text>) : 
                        (  
                            item.status_order == 'Proses' ? (<Text className="text-base font-medium text-sky-500">Proses</Text>) : 
                            (
                                item.status_order == 'Selesai' ? (<Text className="text-base font-medium text-purple-500">Selesai</Text>) : 
                                (
                                    item.status_order == 'Batal' ? (<Text className="text-base font-medium text-red-500">Batal</Text>) : 
                                    (
                                        item.status_order == 'Diterima' ? (<Text className="text-base font-medium text-green-500">Diterima</Text>) : null
                                    ) 
                                ) 
                            ) 
                        )
                    }
                </View>
            </TouchableOpacity>
        )
    }
    return (
        <>
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
            <FlatList
                data={orderan}
                renderItem={renderItem}
                ListHeaderComponent={listHeader}
            />
        </>
    )
}

export default Orderan