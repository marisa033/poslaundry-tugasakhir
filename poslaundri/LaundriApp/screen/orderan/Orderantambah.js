import React, {
     useEffect,
     useState
} from 'react';
import {
     View,
     StatusBar,
     TouchableOpacity,
     Alert,
     ScrollView,
     Modal,
     Dimensions,
     PermissionsAndroid,
     FlatList,
     Image,
} from 'react-native';
import {
     Appbar,
     TextInput,
     Text,
 } from 'react-native-paper';
import Icon from 'react-native-vector-icons/dist/Feather';
import LinearGradient from 'react-native-linear-gradient';
import { WaveIndicator } from 'react-native-indicators';
import AsyncStorage from '@react-native-async-storage/async-storage';
import DATA_API from "./../api/data";
import IMAGE_API from "./../api/images";
const Width = Dimensions.get('window').width;

const Orderantambah = ({ navigation }) => {

     const ImagePicker = require('react-native-image-picker');

     const [loading, setloading] = useState(false);
     const [modalVisible, setModalVisible] = useState(false);


     const [layanan, setlayanan] = useState('');

     const [nama, setnama] = useState('')
     const [tlp, settlp] = useState('')
     
     const [id_layanan, setid_layanan] = useState('')
     const [id_laundri, setid_laundri] = useState('')
     const [berat, setberat] = useState('1')
     const [status_order, setstatus_order] = useState('Baru')
     
     // Hasil ambil data gambar
     const [filename, setfilename] = useState('')
     const [filetype, setfiletype] = useState('')
     const [fileuri, setfileuri] = useState('')
     
     // set hasil pilihan layanan
     const [namaLayanan, setnamaLayanan] = useState('')
     const [satuanLayanan, setSatuanLayanan] = useState('')
     const [hargaSatuan, setHargaSatuan] = useState(0)
     const [total, settotal] = useState(berat * hargaSatuan)
     
     useEffect(() => {
          ambilLayanan()
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

     // Hasil pilih layanan
     function layananDipilih(datas){
        
          setModalVisible(false)
          setid_layanan(datas.id)
          setid_laundri(datas.id_laundri)
          setnamaLayanan(datas.nama_layanan);
          setSatuanLayanan(datas.satuan_harga);
          setHargaSatuan(datas.harga_layanan);
          settotal(datas.harga_layanan * berat)
     }

     function renderItem({item}){
          return(
               <TouchableOpacity
                    onPress={() => layananDipilih(item)} 
                    className="flex flex-row justify-between py-6 pl-6 bg-white"
               >
                   <View className="flex flex-row w-[calc(100vw_-_110px)]">
                       <Image source={{ uri: `${IMAGE_API}/${item.gambar_layanan}` }} className="w-[60px] h-[60px] rounded-md" />
                       <View 
                           className="ml-4"
                           style={{ 
                               width: Width / 1.5
                           }}
                       >
                           <Text className="text-base font-normal text-slate-600">{item.nama_layanan}</Text>
                           <Text className="text-sm font-normal text-slate-600 mb-3">{item.nama_kategori}</Text>
                           <Text className="text-base font-bold text-purple-600">{item.harga_layanan + '/' + item.satuan_harga }</Text>
                       </View>
                   </View>
                   
                   
               </TouchableOpacity>
           )
     }

     function renderListHeader(){
          return(
               <TouchableOpacity
                    onPress={() => setModalVisible(false)}
                    className="flex items-center justify-center p-6"
               >
                    <View className="w-[50px] h-1 rounded-lg bg-slate-600"></View>
               </TouchableOpacity>
          )
     }


     // ambilGambar
     async function ambilGambar(){
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
                          
                           setfilename(source.fileName)
                           setfiletype(source.type)
                           setfileuri(source.uri)
                           
                       }
                   });
               } else {
                 console.log('Camera permission denied');
               }
             } catch (err) {
               console.warn(err);
             }
     }


     // Proses simpan orderan
     async function simpanOrderan(){
          const formData = new FormData();
          formData.append("id_layanan", id_layanan);
          formData.append("nama", nama);
          formData.append("tlp", tlp);
          formData.append("id_laundri", id_laundri);
          formData.append("berat", berat);
          formData.append("total", hargaSatuan * berat);
          formData.append("status_order", "Proses");
          formData.append("gambar_order", {
               uri: fileuri,
               name: filename,
               type: filetype,
          });
          // console.log(formData._parts)
          fetch(`${DATA_API}/orderan/simpanOrderan`, {
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
                    Alert.alert(`${data.code}`, `${data.message}`, [
                         {
                              text: 'OK',
                              onPress: () => navigation.replace('Orderan'),
                         },
                    ])

               } else {
                    setloading(false)
                    Alert.alert(`${data.code}`, `${data.message}`, [
                         {
                              text: 'Muat Ulang',
                              onPress: () => navigation.navigate('Orderan'),
                         },
                    ])
               
               }
          })
          .catch((error) => {
               setloading(false)
               Alert.alert(`405`, `${error.message}`, [
                    {
                         text: 'Muat Ulang',
                         onPress: () => navigation.navigate('Orderantambah'),
                    },
               ])
          });
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
               <LinearGradient colors={
                    ['#6865CD', '#AB38E3', '#F109FA', '#FF4C42', '#FF620A']
               }
                    className="flex flex-row items-center justify-between pt-8 pb-2"
                    start={{ x: 0, y: 2 }} end={{ x: 2, y: 0 }}

               >
                    <View className="flex flex-row items-center justify-between">
                         <View className="flex flex-row items-center">
                              <TouchableOpacity
                                   onPress={() => navigation.navigate("Orderan")}
                                   className="w-[57px] h-[57px] items-center justify-center"
                              >
                                   <Icon name="arrow-left" size={24} color="white" />
                              </TouchableOpacity>
                              <Text className="mx-4 text-xl font-medium text-white">TAMBAH ORDERAN</Text>
                         </View>
                    </View>

               </LinearGradient>

               <ScrollView className="p-6 flex-1">
                    <TextInput
                        label="Nama"
                        value={nama}
                        mode="outlined"
                        left={<TextInput.Icon icon="bag-personal" />}
                        onChangeText={text => setnama(text)}
                        className="bg-slate-50 mb-6"
                    />
                    <TextInput
                        label="Telepon"
                        value={tlp}
                        mode="outlined"
                        left={<TextInput.Icon icon="cellphone" />}
                        onChangeText={text => settlp(text)}
                        className="bg-slate-50 mb-6"
                    />
                     <TextInput
                        label="Layanan"
                        value={namaLayanan}
                        mode="outlined"
                        left={<TextInput.Icon icon="bag-personal" />}
                        right={<TextInput.Icon icon="bag-personal" onPress={() => setModalVisible(true)} />}
                        disabled
                        className="bg-slate-50 mb-6"
                    />
                    
                    <TextInput
                        label="Berat"
                        value={berat}
                        mode="outlined"
                        left={<TextInput.Icon icon="approximately-equal" />}
                        right={<Text className="text-base font-medium ">Kg</Text>}
                        onChangeText={text => setberat(text)}
                        className="bg-slate-50 mb-6"
                    />
                     <TextInput
                        label="Gambar Cucian"
                        value={filename}
                        mode="outlined"
                        left={<TextInput.Icon icon="camera-image" />}
                        right={<TextInput.Icon icon="camera" onPress={ambilGambar} />}
                        onChangeText={text => setgambar(text)}
                        disabled={true}
                        className="bg-slate-50 mb-6"
                    />
                    
               </ScrollView>
               <View className="absolute bottom-0 w-full p-4 bg-white flex flex-row items-center justify-between z-30">
                    <View>
                         <Text>TOTAL</Text>
                         <Text className="text-xl font-medium ">{berat * hargaSatuan}</Text>
                    </View>
                    <TouchableOpacity
                         onPress={simpanOrderan}
                         className="px-6 py-4 bg-purple-600 rounded-md"
                    >
                         <Text className="text-base font-medium text-white">SIMPAN ORDERAN</Text>
                    </TouchableOpacity>
               </View>
               <Modal
                    animationType="fade"
                    transparent={true}
                    visible={modalVisible}
               >
                    <StatusBar barStyle={'dark-content'} backgroundColor={'transparent'} translucent />
                    <View className="flex-1 items-end justify-end " style={{ backgroundColor: 'rgba(0,0,0,0.3)' }}>
                         <View className=" bg-white w-full rounded-t-[40px]">
                              <FlatList
                                   data={layanan}
                                   renderItem={renderItem}
                                   ListHeaderComponent={renderListHeader}
                              />
                         </View>
                    </View>
               </Modal>
          </>
     )
}

export default Orderantambah