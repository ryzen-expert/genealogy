import React, { useState, useEffect } from 'react';
import { StyleSheet, Text, View, ActivityIndicator } from 'react-native';
import { WebView } from 'react-native-webview';
import { StatusBar } from 'expo-status-bar';

import NetInfo from '@react-native-community/netinfo';
import { useNetInfo } from "@react-native-community/netinfo";
export default function App() {
  const [isConnected, setIsConnected] = useState(true);
  const [count, setCount] = useState(0);

  useEffect(() => {
    tryAgain();
    // PushyListener();
    // doRegisterPushyApp();
  }, []);


  const tryAgain = () => {
    // const unsubscribe = NetInfo.addEventListener((state) => {
    //   setIsConnected(state.isConnected);
    //   console.log('Connection type', state.type);
    //   console.log('Is connected?', state.isConnected);
    // });
    NetInfo.fetch().then((state) => {
      // @ts-ignore
      setIsConnected(state.isConnected);
      // setIsConnected(true);
      console.log(  isConnected);
      console.log('Is connected?', state.isConnected);
      // setCount(count + 1);
    });
   };



  return (
      <View style={styles.container}>
        {isConnected ? (
            <WebView
                source={{ uri: 'https://www.example.com' }}
                style={{ flex: 1 }}
                startInLoadingState={true}
                renderLoading={() => (
                    <ActivityIndicator
                        color="#0000ff"
                        size="large"
                        style={styles.flexContainer}
                    />
                )}
            />
        ) : (
            <View style={styles.noConnectionView}>
              <Text style={styles.noConnectionText}>No internet connection</Text>
              <Button
                  title="Try Later"
                  onPress={handleTryAgain}
              />
            </View>
        )}
      </View>



      // <View style={styles.container}>
      //   {isConnected  ? (
      //       <WebView
      //           source={{ uri: 'https://www.example.com' }}
      //           onError={(syntheticEvent) => {
      //             const { nativeEvent } = syntheticEvent;
      //             console.error('WebView error: ', nativeEvent);
      //           }}
      //           onHttpError={(syntheticEvent) => {
      //             const { nativeEvent } = syntheticEvent;
      //             console.error('HTTP error: ', nativeEvent.statusCode);
      //           }}
      //           style={{ flex: 1 }}
      //           startInLoadingState={true}
      //           renderLoading={() => (
      //               <ActivityIndicator
      //                   color="#0000ff"
      //                   size="large"
      //                   style={styles.flexContainer}
      //               />
      //           )}
      //       />
      //   ) : (
      //       <Text style={styles.noConnection}>No internet connection</Text>
      //   )}
      // </View>
      // <View style={styles.container}>
      //   <Text>Open up App.tsx to start working on your app!</Text>

        // <WebView
        //               source={{ uri: 'https://tree.partstore.sa' }}
        //               style={{ flex: 1 }}
        //               startInLoadingState={true}
        //               renderLoading={() => (
        //                   <ActivityIndicator
        //                       color="#0000ff"
        //                       size="large"
        //                       style={styles.flexContainer}
        //                   />
        //               )}
        //           />


        // <StatusBar style="auto" />
      // </View>

      // <View style={styles.container}>
      //   {isConnected ? (
      //       <WebView
      //           source={{ uri: 'https://tree.partstore.sa' }}
      //           // style={{ flex: 1 }}
      //           startInLoadingState={true}
      //           renderLoading={() => (
      //               <ActivityIndicator
      //                   color="#0000ff"
      //                   size="large"
      //                   style={styles.flexContainer}
      //               />
      //           )}
      //       />
      //   ) : (
      //       <Text style={styles.noConnection}>No internet connection</Text>
      //   )}
      // </View>
  );
}


const styles = StyleSheet.create({
  // container: {
  //   flex: 1,
  //   width:'100%',
  //   backgroundColor: '#fff',
  //   alignItems: 'center',
  //   justifyContent: 'center',
  // },

  noConnectionView: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20
  },
  noConnectionText: {
    fontSize: 18,
    marginBottom: 20,
    color: 'red'
  },
  flexContainer: {
    flex: 1,
    justifyContent: 'center'
  },

  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  noConnection: {
    fontSize: 18,
    color: 'red'
  },


});

const xstyles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  noConnection: {
    fontSize: 18,
    color: 'red'
  },
  flexContainer: {
    flex: 1,
    justifyContent: 'center'
  }
});
