<template>
    <q-page class="flex">
      <qrcode-stream class="qrcode-reader" @detect="onDetect"></qrcode-stream>
    </q-page>
  </template>

  <script>
  import { QrcodeStream } from 'vue-qrcode-reader'
  // import { BarcodeScanner } from '@capacitor-community/barcode-scanner'
  import { useRoute } from 'vue-router'

  export default {
    name: 'SigneScan',
    components: {
      QrcodeStream
    },
    created () {
      // this.scanImage()
    },
    setup () {
      const route = useRoute()

      return {
        route
      }
    },
    methods: {
      onDetect (content) {
        console.log('Decoded', content[0].rawValue)
        this.$router.push({ name: 'singleLesson', params: { id: this.route.params.id } })
      },
      // async startScan() {
      //   // Check camera permission
      //   // This is just a simple example, check out the better checks below
      //   await BarcodeScanner.checkPermission({ force: true })

      //   // make background of WebView transparent
      //   // note: if you are using ionic this might not be enough, check below
      //   BarcodeScanner.hideBackground()

      //   const result = await BarcodeScanner.startScan() // start scanning and wait for a result

      //   // if the result has content
      //   if (result.hasContent) {
      //     console.log('Decoded', result.content)
      //     this.$router.push({ name: 'singleLesson', params: { id: this.route.params.id } })
      //   }
      // },
      // scanImage() {
      //   cordova.plugins.barcodeScanner.scan(
      //     result => {
      //       alert(
      //         'We got a barcode\n' +
      //           'Result: ' +
      //           result.text +
      //           '\n' +
      //           'Format: ' +
      //           result.format +
      //           '\n' +
      //           'Cancelled: ' +
      //           result.cancelled
      //       )
      //     },
      //     error => {
      //       alert('Scanning failed: ' + error)
      //     },
      //     {
      //       preferFrontCamera: true, // iOS and Android
      //       showFlipCameraButton: true, // iOS and Android
      //       showTorchButton: true, // iOS and Android
      //       // torchOn: true, // Android, launch with the torch switched on (if available)
      //       saveHistory: true, // Android, save scan history (default false)
      //       prompt: 'Place a barcode inside the scan area', // Android
      //       resultDisplayDuration: 500, // Android, display scanned text for X ms. 0 suppresses it entirely, default 1500
      //       //formats : "QR_CODE,PDF_417", // default: all but PDF_417 and RSS_EXPANDED
      //       orientation: 'landscape', // Android only (portrait|landscape), default unset so it rotates with the device
      //       disableAnimations: true, // iOS
      //       disableSuccessBeep: true // iOS and Android
      //     }
      //   )
      // }
    }
  }
</script>

<style lang="scss" scoped>
.qrcode-reader {
  width: 100vw !important;
  height: 100vh !important;
  object-fit: cover;
}
</style>
