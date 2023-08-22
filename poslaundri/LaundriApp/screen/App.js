
import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';

import {
    LoginScreen,
    RegisterScreen,
    KonfirmasilokasiScreen,
    HomeScreen,
    LayananScreen,
    LayanandetailScreen,
    LayananeditScreen,
    LayanantambahScreen,
    OrderanScreen,
    OrderantambahScreen,
    OrderandetailScreen,
    StokScreen,
    AkunScreen,
    AkunupdateScreen,
    KonfirmasialamatScreen,
    LaporanScreen,
} from "./";

const Stack = createNativeStackNavigator();

function App() {
    return(
        <NavigationContainer>
            <Stack.Navigator
                screenOptions={{ headerShown: false, }}
            >
                <Stack.Screen name="Login" component={LoginScreen} />
                <Stack.Screen name="Register" component={RegisterScreen} />
                <Stack.Screen name="Konfirmasilokasi" component={KonfirmasilokasiScreen} />
                <Stack.Screen name="Home" component={HomeScreen} />
                <Stack.Screen name="Layanan" component={LayananScreen} />
                <Stack.Screen name="Layanandetail" component={LayanandetailScreen} />
                <Stack.Screen name="Layananedit" component={LayananeditScreen} />
                <Stack.Screen name="Layanantambah" component={LayanantambahScreen} />
                <Stack.Screen name="Orderan" component={OrderanScreen} />
                <Stack.Screen name="Orderantambah" component={OrderantambahScreen} />
                <Stack.Screen name="Orderandetail" component={OrderandetailScreen} />
                <Stack.Screen name="Stok" component={StokScreen} />
                <Stack.Screen name="Akun" component={AkunScreen} />
                <Stack.Screen name="Akunupdate" component={AkunupdateScreen} />
                <Stack.Screen name="Konfirmasialamat" component={KonfirmasialamatScreen} />
                <Stack.Screen name="Laporan" component={LaporanScreen} />
            </Stack.Navigator>
        </NavigationContainer>
    )
}

export default App;