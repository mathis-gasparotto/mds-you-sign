<template>
    <q-page class="flex">
      <qrcode-stream class="qrcode-reader" @detect="onDetect"></qrcode-stream>
    </q-page>
  </template>

  <script>
  import { QrcodeStream } from 'vue-qrcode-reader'
  import { useRoute } from 'vue-router'

  export default {
    name: 'SigneScan',
    components: {
      QrcodeStream
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
