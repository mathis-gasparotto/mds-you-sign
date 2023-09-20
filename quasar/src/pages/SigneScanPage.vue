<template>
    <q-page class="flex">
      <!-- <qrcode-stream class="qrcode-reader" @detect="onDetect"></qrcode-stream> -->
    </q-page>
  </template>

  <script>
  // import { QrcodeStream } from 'vue-qrcode-reader'
  import { BarcodeScanner } from '@capacitor-community/barcode-scanner'
  import { useRoute } from 'vue-router'

  export default {
    name: 'SigneScan',
    // components: {
    //   QrcodeStream
    // },
    created () {
      this.startScan()
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
      async startScan() {
        // Check camera permission
        // This is just a simple example, check out the better checks below
        await BarcodeScanner.checkPermission({ force: true })

        // make background of WebView transparent
        // note: if you are using ionic this might not be enough, check below
        BarcodeScanner.hideBackground()

        const result = await BarcodeScanner.startScan() // start scanning and wait for a result

        // if the result has content
        if (result.hasContent) {
          console.log('Decoded', result.content)
          this.$router.push({ name: 'singleLesson', params: { id: this.route.params.id } })
        }
      }
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
