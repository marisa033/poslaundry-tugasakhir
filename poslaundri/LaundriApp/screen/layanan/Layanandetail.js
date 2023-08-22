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
    ScrollView
} from 'react-native';
import Icon from 'react-native-vector-icons/dist/Feather';
import LinearGradient from 'react-native-linear-gradient';
import { WaveIndicator } from 'react-native-indicators';
import { Dropdown } from 'react-native-element-dropdown';
import IMAGE_API from "./../api/images";

const Layanandetail = ({navigation, route}) => {

    const [layanan, setlayanan] = useState(route.params);

{console.log(layanan)}
    return (
        <View className="flex-1 bg-white">
            <LinearGradient colors={
                ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
            }
                className="flex flex-row items-center justify-between pt-8 pb-2"
                start={{ x: 0, y: 2 }} end={{ x: 2, y: 0 }}
                
            >
                <View className="flex flex-row items-center">
                    <TouchableOpacity
                        onPress={() => navigation.navigate("Layanan")}
                        className="w-[57px] h-[57px] items-center justify-center"
                    >
                        <Icon name="arrow-left" size={24} color="white" />
                    </TouchableOpacity>
                    <Text className="mx-4 text-xl font-medium text-white">DETAIL LAYANAN</Text>
                </View>
            </LinearGradient>
            <ScrollView className="p-6">
                <Image source={{ uri: `${IMAGE_API}/${layanan.gambar_layanan}` }} className="w-full h-[300px] rounded-md mb-3" />
                <View className="flex flex-row items-center justify-between mb-3">
                    <Text className="text-base text-slate-500">Layanan</Text>
                    <Text className="text-base text-slate-400">{layanan.nama_layanan}</Text>
                </View>
                <View className="flex flex-row items-center justify-between mb-3">
                    <Text className="text-base text-slate-500">Kategori</Text>
                    <Text className="text-base text-slate-400">{layanan.nama_kategori}</Text>
                </View>
                <View className="flex flex-row items-center justify-between mb-3">
                    <Text className="text-base text-slate-500">Harga / Satuan</Text>
                    <Text className="text-base text-slate-400">{layanan.harga_layanan + ' / ' + layanan.satuan_harga}</Text>
                </View>
                <View className="flex mb-3">
                    <Text className="text-base text-slate-500">Deskripsi</Text>
                    <Text className="text-base text-slate-400">{layanan.deskripsi_layanan}</Text>
                </View>
            </ScrollView>
        </View>
    )
}

export default Layanandetail