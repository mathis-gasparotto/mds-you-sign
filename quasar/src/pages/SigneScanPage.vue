<template>
    <q-page class="flex">
    </q-page>
  </template>

  <script>
  import { BarcodeScanner } from '@capacitor-community/barcode-scanner'
  import { useRoute } from 'vue-router'
  import { api } from 'boot/axios'
  import { Notify } from 'quasar'

  export default {
    name: 'SigneScan',
    created () {
      this.startScan()
      document.addEventListener('ionBackButton', (ev) => {
        BarcodeScanner.stopScan()
      })
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
          await api.post(`/lessons/${this.route.params.id}/scan`, { code: result.content })
            .catch((e) => {
              if (e.response.data.message === 'Wrong code') {
                Notify.create({
                  color: 'negative',
                  position: 'top',
                  message: 'Le QR Code est invalide',
                  icon: 'report_problem'
                })
              } else {
                Notify.create({
                  color: 'negative',
                  position: 'top',
                  message: 'Une erreur est survenue',
                  icon: 'report_problem'
                })
              }
            })
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
