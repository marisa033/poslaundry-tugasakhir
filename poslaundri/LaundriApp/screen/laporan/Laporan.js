import React, {
     useEffect, 
     useState
 } from 'react';
 import { 
     View,
     StatusBar,
     TouchableOpacity,
     ScrollView,
     Dimensions
 } from 'react-native';
 import {
    TextInput,
    Text,
} from 'react-native-paper';
 import { DataTable } from 'react-native-paper';
 import Icon from 'react-native-vector-icons/dist/Feather';
 import LinearGradient from 'react-native-linear-gradient';
 import { WaveIndicator } from 'react-native-indicators';
 import AsyncStorage from '@react-native-async-storage/async-storage';
 import DATA_API from "./../api/data";
 import IMAGE_API from "./../api/images";
 const Width = Dimensions.get('window').width;
 
 const Laporan = ({navigation}) => {
 
     const [loading, setloading] = useState(true);
     const [orderan, setorderan] = useState([]);
     const [cari, setcari] = useState('')
     
     useEffect(() => {
         ambilOrderan()

       
     }, [])

     function formatRupiah(number) {
        if (typeof number !== 'number') {
            return "Invalid input";
        }
        
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(number);
    }
 
     // Ambil data layanan
     async function ambilOrderan() {
     
         const value = await AsyncStorage.getItem('siOwner');
         if (value !== null) {
             fetch(`${DATA_API}/orderan/semuaDataLaporan/${value}`)
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

    //  if (cari.length != 0) {
    //     const filteredData = orderan.filter((hasil) => {
    //         return hasil.layanan.nama_layanan.toUpperCase().includes(cari.toUpperCase());
    //     });
    //     console.log(filteredData)
    //  }

     
 
 
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
             <LinearGradient colors={
                 ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
             }
                 className="flex flex-row items-center justify-between pt-8 pb-2"
                 start={{ x: 0, y: 2 }} end={{ x: 2, y: 0 }}
                 
             >
                 <View className="flex flex-row items-center">
                     <View className="flex flex-row items-center">
                         <TouchableOpacity
                             onPress={() => navigation.navigate("Home")}
                             className="w-[57px] h-[57px] items-center justify-center"
                         >
                             <Icon name="arrow-left" size={24} color="white" />
                         </TouchableOpacity>
                         <Text className="mx-4 text-xl font-medium text-white">DATA LAPORAN ORDERAN</Text>
                     </View>
                    
                 </View> 
                
             </LinearGradient>
             <ScrollView>
                <ScrollView horizontal={true}>
                    <View className="p-6 bg-white">
                        {/* <View className="pr-6">
                            <TextInput
                                label="Cari data"
                                value={cari}
                                mode="outlined"
                                onChangeText={text => setcari(text)}
                                className="bg-slate-50 mb-6" style={{ width: Width / 1.14}}
                            />
                        </View> */}
                    <DataTable>
                        <DataTable.Header className="p-0">
                                <DataTable.Title className="items-center justify-center w-[150px]">
                                    <Text className="font-medium text-base text-slate-600 uppercase">TANGGAL</Text>
                                </DataTable.Title>
                                <DataTable.Title className="items-center justify-center w-[150px]">
                                    <Text className="font-medium text-base text-slate-600 uppercase">BANYAK ORDERAN</Text>
                                </DataTable.Title>
                                <DataTable.Title className="items-center justify-center w-[150px]">
                                    <Text className="font-medium text-base text-slate-600 uppercase">TOTAL PENDAPAT</Text>
                                </DataTable.Title>
                                
                        </DataTable.Header>
                        {orderan.map((item, index) => (
                            

                                <DataTable.Row key={index} className="text-center p-0">
                                    <DataTable.Cell className="items-center justify-center w-[150px]">{item.tanggal}</DataTable.Cell>
                                    <DataTable.Cell className="items-center justify-center w-[150px]">{item.total_order}</DataTable.Cell>
                                    <DataTable.Cell className="items-center justify-center w-[150px]">{formatRupiah(item.total_harga)}</DataTable.Cell>
                                </DataTable.Row>
                        ))}
                        
                        </DataTable>
                    </View>
                </ScrollView>
             </ScrollView>
             
         </>
     )
 }
 
 export default Laporan