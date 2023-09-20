<template>
    <q-page class="flex">
    </q-page>
  </template>

  <script>
  import { BarcodeScanner } from '@capacitor-community/barcode-scanner'
  import { useRoute } from 'vue-router'

  export default {
    name: 'SigneScan',
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
          await console.log('Decoded', result.content)
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
