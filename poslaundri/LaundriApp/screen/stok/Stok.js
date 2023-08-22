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
    Alert,
    Modal,
    TextInput,
    Dimensions
} from 'react-native';
import Icon from 'react-native-vector-icons/dist/Feather';
import LinearGradient from 'react-native-linear-gradient';
import { WaveIndicator } from 'react-native-indicators';
import { Dropdown } from 'react-native-element-dropdown';
import AsyncStorage from '@react-native-async-storage/async-storage';
import DATA_API from "./../api/data";

const windowWidth = Dimensions.get('window').width;


const Stok = ({navigation}) => {

    const [datastok, setdatastok] = useState('');
    const [modaledit, setmodaledit] = useState(false);
    const [modaltambah, setmodaltambah] = useState(false);
    const [loading, setloading] = useState(true);
  

    // Input update
    const [idUpdate, setidUpdate] = useState('');
    const [namaUpdate, setnamaUpdate] = useState('');
    const [jumlahUpdate, setjumlahUpdate] = useState('');

    // Input tambah
    const [idlaundri, setidlaundri] = useState('');
    const [namastok, setnamastok] = useState('');
    const [jumlahstok, setjumlahstok] = useState('');

    useEffect(() => {
        ambilStok()
    }, [])


    // Ambil data stok
    async function ambilStok() {
        const value = await AsyncStorage.getItem('siOwner');
        if (value !== null) {
            fetch(`${DATA_API}/stok/${value}`)
                .then(response => response.json())
                .then(async function (data) {
                    setloading(false)
                    if (data.code === 200 ) {
                       
                        setdatastok(data.data)

                    }
                    
                })
                .catch((error) => {
                    setloading(false)
                    console.log(error.message)
                });
        }
    }
    

    // Aksi tampil modal update stok
    async function editStok(item){
        // {console.log(item)}
        setmodaledit(true)
        setidUpdate(item.id)
        setnamaUpdate(item.nama_stok)
        setjumlahUpdate(item.jumlah)
    }
    // Aksi update stok
    async function kirimeditStok(){
        
        setmodaledit(false)
        setloading(true)
        const formData = new FormData();
        formData.append("nama_stok", namaUpdate);
        formData.append("jumlah", jumlahUpdate);

        await fetch(`${DATA_API}/stok/update/${idUpdate}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            body: formData,
        })
        .then(response => response.json())
        .then(function (data) {
            setloading(false)
  
            if (data.code === 200) {
                setloading(false)
             
                Alert.alert(`${data.code}`, `${data.message}`, [
                    {
                        text: 'OK',
                        onPress: () => {navigation.replace("Stok")}
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
            console.log('ok')
        });
    }

    async function hapusStok(item){
        setloading(true)
        
        console.log(`${DATA_API}/stok/hapus/${item.id}`)
        
        await fetch(`${DATA_API}/stok/hapus/${item.id}`)
        .then(response => response.json())
        .then(function (data) {
            setloading(false)

            if (data.code === 200) {
                
                Alert.alert(`${data.code}`, `${data.message}`, [
                    {
                        text: 'OK',
                        onPress: () => {navigation.replace("Stok")}
                    },
                ])

            } else {
                
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

    async function kirimtambahStok(){

        const id = await AsyncStorage.getItem('siOwner');

        if (namastok === '' && jumlahstok === '') {
            Alert.alert(`Input Kosong`, `Pastikan inputan anda tidak boleh ada yang kosong !`, [
                {
                    text: 'OK',
                },
            ])
        }else{
            setmodaltambah(false)
            setloading(true)
            const formData = new FormData();
            formData.append("id_laundri", id);
            formData.append("nama_stok", namastok);
            formData.append("jumlah", jumlahstok);

            console.log(formData)

            await fetch(`${DATA_API}/stok/tambah`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                body: formData,
            })
    
            .then(response => response.json())
            .then(function (data) {
                console.log(data)
                setloading(false)
    
                if (data.code === 200) {
                    setloading(false)
                
                    Alert.alert(`${data.code}`, `${data.message}`, [
                        {
                            text: 'OK',
                            onPress: () => {navigation.replace("Stok")}
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
                console.log('ok')
            });
        }
        
    }

   


    


    function renderItem({item}){
        const data = [
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
            <View className="flex flex-row justify-between py-6 pl-6 bg-white mb-[1.6px]">
                <View 
                    className="flex" 
                    style={{ 
                        width: windowWidth - 130,
                    }}
                >
                    <View className="ml-4">
                        <Text className="text-xl font-normal text-slate-600 uppercase">{item.nama_stok}</Text>
                        <Text className="text-base font-normal text-slate-600 mb-3">Stok: {item.jumlah}</Text>
                        
                        
                    </View>
                    {
                        item.jumlah <= 10 ? (
                            <Text className="text-sm font-normal text-yellow-600 mb-3 w-[220px] ml-4">
                                Stok {item.nama_stok}  anda sudah hampir habis silahkan update Stok {item.nama_stok} anda ! 
                            </Text>
                        ) : null
                    }
                </View>
                
                <Dropdown
                    data={data} 
                    onChange={item => {
                        const labels = item.label;
                        const values = item.value;
                        if (labels === 'EDIT') {
                            editStok(values)
                        }else if(labels === 'HAPUS') { 
                            Alert.alert(`HAPUS !`, `Yakin ingin menghapus data stok ini ?!`, [
                                {
                                    text: 'YAKIN',
                                    onPress: () => { hapusStok(values) }
                                },
                                {
                                    text: 'BATAL',
                                    style: 'cancel'
                                },
                            ])
                            
                        }
                    }}
                    renderRightIcon={() => (
                        <View className="absolute w-full h-full flex items-center justify-center">
                            <Icon color="black" name="more-vertical" size={20} />
                        </View>
                    )}
                    dropdownPosition="left"
                    renderItem={itemDropdown}
                    className="rounded-md  flex items-center justify-center"
                    style={{ 
                        width: windowWidth / 3.5,
                    }}
                    
                />
            </View>
        )
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
                        <Text className="mx-4 text-xl font-medium text-white">DATA STOK</Text>
                    </View>
                   
                </View> 
                <TouchableOpacity
                    onPress={() => setmodaltambah(!modaltambah)}
                    className="w-[57px] h-[57px] items-center justify-center"
                >
                    <Icon name="plus" size={24} color="white" />
                </TouchableOpacity>
            </LinearGradient>
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
                data={datastok}
                renderItem={renderItem}
                ListHeaderComponent={listHeader}
            />

            <Modal
                animationType="fade"
                transparent={true}
                visible={modaltambah}
            >
                <View className="flex-1 px-6 py-12 items-center justify-center " style={{ backgroundColor: 'rgba(0,0,0,0.5)' }}>
                    <View className=" bg-white items-center justify-center p-6 w-full rounded-lg">
                        <Text className="font-medium text-xl text-slate-500 mb-6">TAMBAH STOK</Text>
                        <View className="w-full mb-3">
                            <Text className="text-base font-medium text-slate-400 mb-1">Nama</Text>
                            <TextInput
                                className="px-6 py-3 border-2 border-slate-300 font-medium text-base bg-slate-200 text-slate-400"
                                placeholder='Nama ...'
                                placeholderTextColor={'#94a3b8'}
                                onChangeText={(val) => setnamastok(val)}
                               
                            />
                        </View>
                        <View className="w-full mb-3">
                            <Text className="text-base font-medium text-slate-400 mb-1">Jumlah</Text>
                            <TextInput
                                className="px-6 py-3 border-2 border-slate-300 font-medium text-base bg-slate-200 text-slate-400"
                                onChangeText={(val) => setjumlahstok(val)}
                                placeholder='Jumlah ...'
                                placeholderTextColor={'#94a3b8'}
                            />
                        </View>
                        <View className="flex flex-row gap-3 mt-6">
                            <TouchableOpacity
                                onPress={() => setmodaltambah(!modaltambah)}
                                className="flex items-center justify-center px-6 py-4 bg-slate-500 rounded-md"
                            >
                                <Text className="text-base font-medium text-white">BATAL</Text>
                            </TouchableOpacity>
                            <TouchableOpacity
                                onPress={kirimtambahStok}
                                className="flex items-center justify-center px-6 py-4 bg-green-500 rounded-md"
                            >
                                <Text className="text-base font-medium text-white">SIMPAN</Text>
                            </TouchableOpacity>
                        </View>
                    </View>
                </View>
            </Modal>
            <Modal
                animationType="fade"
                transparent={true}
                visible={modaledit}
            >
                <View className="flex-1 px-6 py-12 items-center justify-center " style={{ backgroundColor: 'rgba(0,0,0,0.5)' }}>
                    <View className=" bg-white items-center justify-center p-6 w-full rounded-lg">
                        <Text className="font-medium text-xl text-slate-500 mb-6">UPDATE STOK</Text>
                        <View className="w-full mb-3">
                            <Text className="text-base font-medium text-slate-400 mb-1">Nama</Text>
                            <TextInput
                                className="px-6 py-3 border-2 border-slate-300 font-medium text-base bg-slate-200 text-slate-400"
                              
                                onChangeText={(val) => setnamaUpdate(val)}
                                value={namaUpdate}
                                placeholderTextColor={'#94a3b8'}
                            />
                        </View>
                        <View className="w-full mb-3">
                            <Text className="text-base font-medium text-slate-400 mb-1">Jumlah</Text>
                            <TextInput
                                className="px-6 py-3 border-2 border-slate-300 font-medium text-base bg-slate-200 text-slate-400"
                                onChangeText={(val) => setjumlahUpdate(val)}
                                value={`${jumlahUpdate}`}
                                placeholderTextColor={'#94a3b8'}
                            />
                        </View>
                        <View className="flex flex-row gap-3 mt-6">
                            <TouchableOpacity
                                onPress={() => setmodaledit(!modaledit)}
                                className="flex items-center justify-center px-6 py-4 bg-slate-500 rounded-md"
                            >
                                <Text className="text-base font-medium text-white">BATAL</Text>
                            </TouchableOpacity>
                            <TouchableOpacity
                                onPress={kirimeditStok}
                                className="flex items-center justify-center px-6 py-4 bg-purple-500 rounded-md"
                            >
                                <Text className="text-base font-medium text-white">UPDATE</Text>
                            </TouchableOpacity>
                        </View>
                    </View>
                </View>
            </Modal>
        </>
    )
}

export default Stok