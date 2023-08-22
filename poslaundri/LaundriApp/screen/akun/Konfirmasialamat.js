import React, { useState, useEffect } from 'react';
import { View, Text, TouchableOpacity, StatusBar } from 'react-native';
import MapView, { Marker } from 'react-native-maps';
import { GooglePlacesAutocomplete } from 'react-native-google-places-autocomplete';

const Konfirmasialamat = ({ navigation }) => {
    const [location, setLocation] = useState(null);
    const [lat, setLatitude] = useState(null);
    const [lng, setLongitude] = useState(null);
    const [alamat, setAlamat] = useState(null);

    const handleMarkerDrag = (e) => {
        setLocation({
            latitude: e.nativeEvent.coordinate.latitude,
            longitude: e.nativeEvent.coordinate.longitude,
        });
        setLatitude(e.nativeEvent.coordinate.latitude.toFixed(7))
        setLongitude(e.nativeEvent.coordinate.longitude.toFixed(7))
    };

    const handleMapClick = (e) => {
        setLocation({
            latitude: e.nativeEvent.coordinate.latitude,
            longitude: e.nativeEvent.coordinate.longitude,
        });

        setLatitude(e.nativeEvent.coordinate.latitude.toFixed(7))
        setLongitude(e.nativeEvent.coordinate.longitude.toFixed(7))
    };

    useEffect(() => {
        const ambilAlamat = async () => {
            if (lat != null && lng != null) {

                const response = await fetch(
                    'https://maps.googleapis.com/maps/api/geocode/json?address=' + lat + ',' + lng + '&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k',
                );
                const json = await response.json();
                setAlamat(json.results[0].formatted_address)
            } else {
                setAlamat(null)
            }
        }
        ambilAlamat()
    },)




    return (
        <View className="flex-1 relative">
            <StatusBar translucent backgroundColor="transparent" barStyle="dark-content" />
            <MapView
                className="w-full h-full z-10"
                initialRegion={{
                    latitude: -1.8468048,
                    longitude: 109.9943111,
                    latitudeDelta: 0.0922,
                    longitudeDelta: 0.0421,
                }}
                onPress={handleMapClick}
            >
                {location && (
                    <Marker
                        draggable
                        coordinate={{
                            latitude: location.latitude,
                            longitude: location.longitude,
                        }}
                        onDragEnd={handleMarkerDrag}
                        description={alamat}
                    />
                )}
            </MapView>
            {location && (
                <>
                    <View className="bg-white bg-opacity-30 w-screen absolute z-50 top-0 p-4">
                        <Text className="text-base text-slate-500 font-medium mb-3"> Alamat </Text>
                        <Text className="text-sm text-slate-400 font-medium"> {alamat} </Text>
                    </View>
                    <View className="bg-transparent bg-opacity-30 w-screen absolute z-50 bottom-0 p-4">
                        <TouchableOpacity
                            className="bg-blue-600 flex items-center justify-center h-14 rounded"
                            onPress={() => {
                                navigation.replace('Akunupdate', {
                                    lat: lat,
                                    lng: lng,
                                    alamat: alamat
                                });
                            }}
                        >
                            <Text className="text-base font-medium text-white">KONFIRMASI ALAMAT</Text>
                        </TouchableOpacity>
                    </View>
                </>
            )}

        </View>
    );
};


export default Konfirmasialamat;