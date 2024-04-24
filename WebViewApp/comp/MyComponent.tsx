import React, {useState} from 'react';
import { View, Text, Button, ActivityIndicator, StyleSheet } from 'react-native';
import { WebView } from 'react-native-webview';
import NetInfo from "@react-native-community/netinfo";

// @ts-ignore
const MyComponent = ({ isConnected }) => {
    const handleTryAgain = () => {
        // Logic to handle retry
        console.log('Trying to reconnect...');

        // const unsubscribe = NetInfo.addEventListener(state => {
        //     setConnected(state.isConnected);
        //     console.log('Connection type', state.type);
        //     console.log('Is connected?', state.isConnected);
        // });

        // unsubscribe();

        // NetInfo.fetch().then((state) => {
        //     // @ts-ignore
        //     setIsConnected(state.isConnected);
        //     // setIsConnected(true);
            console.log(isConnected);
        //     console.log('Is connected?', state.isConnected);
        //     // setCount(count + 1);
        // });

        // You might want to update isConnected here or call a function that checks the connection again
    };

    return (
        // <View >

                <WebView
                    source={{ uri: 'https://www.example.com' }}

                    startInLoadingState={true}
                    renderLoading={() => (
                        <ActivityIndicator
                            color="#0000ff"
                            size="large"
                            style={styles.flexContainer}
                        />
                    )}
                />



        // </View>
    );
};
 export default MyComponent;
const styles = StyleSheet.create({
    container: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center'
    },
    noConnectionView: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        padding: 20
    },
    noConnectionText: {
        fontSize: 18,
        marginBottom: 20,
    },
    flexContainer: {
        flex: 1,
        justifyContent: 'center'
    },
});

