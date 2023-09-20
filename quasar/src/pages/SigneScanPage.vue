<template>
    <q-page class="flex page-container">
      <qrcode-stream :camera="camera" @decode="onDecode"></qrcode-stream>
    </q-page>
  </template>

  <script>
  import { QrcodeStream } from 'vue-qrcode-reader'

  export default {
    name: 'SigneScan',
    components: {
      QrcodeStream
    },
    data () {
      return {
        camera: 'auto',
        showCamera: true,
        result: ''
      }
    },
    methods: {
      async onDecode (content) {
        this.result = content
        console.log(content)
        this.turnCameraOff()
      },
      turnCameraOn () {
        this.camera = 'auto'
        this.showCamera = true
      },

      turnCameraOff () {
        this.camera = 'off'
        this.showCamera = false
      }
    }
  }
  </script>
