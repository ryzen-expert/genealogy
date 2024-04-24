// import { WebView } from 'react-native-webview';
// import Constants from 'expo-constants';
// import { StyleSheet } from 'react-native';
//
// export default function App() {
//   return (
//       <WebView
//           style={styles.container}
//           source={{ uri: 'https://tree.partstore.sa' }}
//       />
//   );
// }
//
// const styles = StyleSheet.create({
//   container: {
//     flex: 1,
//     marginTop: Constants.statusBarHeight,
//   },
// });

import React, { useState, useEffect } from 'react';
import { WebView } from 'react-native-webview';
import Constants from 'expo-constants';
import { StyleSheet, Text, View, Button } from 'react-native';
import NetInfo from '@react-native-community/netinfo';

export default function App() {
  const [isConnected, setConnected] = useState(true);

  useEffect(() => {
    const unsubscribe = NetInfo.addEventListener(state => {
      // @ts-ignore
      setConnected(state.isConnected);
    });

    return () => unsubscribe();
  }, []);

  const handleTryAgain = () => {
    // Optionally, you can check connection status again or simply reload the WebView
    NetInfo.fetch().then(state => {
        // @ts-ignore
      setConnected(state.isConnected);
    });
  };

  return (
      <View style={styles.container}>
        {isConnected ? (
            <WebView
                source={{ uri: 'https://tree.partstore.sa' }}
                onError={(syntheticEvent) => {
                              const { nativeEvent } = syntheticEvent;
                              console.error('WebView error: ', nativeEvent);
                            }}
                            onHttpError={(syntheticEvent) => {
                              const { nativeEvent } = syntheticEvent;
                              console.error('HTTP error: ', nativeEvent.statusCode);
                            }}
                style={{ flex: 1 }}
            />
        ) : (
            <View style={styles.offlineContainer}>
              <Text>No internet connection</Text>
              <Button
                  title="Try Again"
                  onPress={handleTryAgain}
              />
            </View>
        )}
      </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    marginTop: Constants.statusBarHeight,
  },
  offlineContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center'
  }
});
