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
    Dimensions
} from 'react-native';
import Icon from 'react-native-vector-icons/dist/Feather';
import LinearGradient from 'react-native-linear-gradient';
import { WaveIndicator } from 'react-native-indicators';
import { Dropdown } from 'react-native-element-dropdown';
import AsyncStorage from '@react-native-async-storage/async-storage';
import DATA_API from "./../api/data";
import IMAGE_API from "./../api/images";

const windowWidth = Dimensions.get('window').width;

const Layanan = ({navigation}) => {

    const [loading, setloading] = useState(true);
    const [layanan, setlayanan] = useState('');
    const [laundri, setlaundri] = useState('');

    useEffect(() => {
        ambilLayanan()
        ambilLaundri()
    }, [])

    // Ambil data layanan
    async function ambilLayanan() {
        const value = await AsyncStorage.getItem('siOwner');
        if (value !== null) {
            fetch(`${DATA_API}/layanan/${value}`)
                .then(response => response.json())
                .then(async function (data) {
                    setloading(false)
                    if (data.code === 200) {
                        setlayanan(data.data)
                    }
                })
                .catch((error) => {
                    setloading(false)
                    console.log(error.message)
                });
        }
    }

    // Ambil data laundri
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
    
    async function hapusLayanan(data){
        const id = data.id;
        await fetch(`${DATA_API}/layanan/hapus/${id}`)
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

   

    function listHeader(){
        return(
            <LinearGradient colors={
                ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
            }
                className="flex flex-row items-center justify-between pt-8 pb-2"
                start={{ x: 0, y: 2 }} end={{ x: 2, y: 0 }}
                
            >
                <View className="flex flex-row items-center">
                    <View className="flex flex-row items-center">
                        <TouchableOpacity
                            onPress={() => navigation.replace("Home")}
                            className="w-[57px] h-[57px] items-center justify-center"
                        >
                            <Icon name="arrow-left" size={24} color="white" />
                        </TouchableOpacity>
                        <Text className="mx-4 text-xl font-medium text-white">DATA LAYANAN</Text>
                    </View>
                   
                </View> 
                <TouchableOpacity
                    onPress={() => navigation.navigate("Layanantambah", {laundri})}
                    className="w-[57px] h-[57px] items-center justify-center"
                >
                    <Icon name="plus" size={24} color="white" />
                </TouchableOpacity>
            </LinearGradient>
        )
    }

    function renderItem({item}){
        const data = [
            { label: 'DETAIL', value: item, background: 'bg-purple-600' },
            { label: 'EDIT', value: item, background: 'bg-blue-600' },
            { label: 'HAPUS', value: item, background: 'bg-red-600' },
          ];

        const itemDropdown = item => {
            return (
                <View className={`px-6 py-3 items-center justify-center ${item.background}`}>
                    <Text className="text-white font-medium text-base">{item.label}</Text>
                </View>
            );
        };
        return(
            <View className="flex flex-row justify-between py-6 pl-6 bg-white">
                <View className="flex flex-row w-[calc(100vw_-_110px)]">
                    <Image source={{ uri: `${IMAGE_API}/${item.gambar_layanan}` }} className="w-[60px] h-[60px] rounded-md" />
                    <View 
                        className="ml-4"
                        style={{ 
                            width: windowWidth / 2.3,
                        }}
                    >
                        <Text className="text-base font-normal text-slate-600">{item.nama_layanan}</Text>
                        <Text className="text-sm font-normal text-slate-600 mb-3">{item.nama_kategori}</Text>
                        <Text className="text-base font-bold text-purple-600">{item.harga_layanan + '/' + item.satuan_harga }</Text>
                    </View>
                </View>
                <Dropdown
                    data={data} 
                    onChange={item => {
                        const labels = item.label;
                        const values = item.value;
                        if (labels === 'DETAIL') {
                            navigation.navigate("Layanandetail", values)
                        }else if(labels === 'EDIT') {
                            navigation.navigate("Layananedit", values)
                        }else if(labels === 'HAPUS') { hapusLayanan(values) }
                    }}
                    renderRightIcon={() => (
                        <View className="absolute w-full h-full flex items-center justify-center">
                            <Icon color="black" name="more-vertical" size={20} />
                        </View>
                    )}
                    dropdownPosition="top"
                    renderItem={itemDropdown}
                    className="rounded-md  flex items-center justify-center"
                    style={{ 
                        width: windowWidth / 3.5,
                    }}
                    
                />
                
            </View>
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
                data={layanan}
                renderItem={renderItem}
                ListHeaderComponent={listHeader}
            />
        </>
    )
}

export default Layanan