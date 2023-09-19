<template>
  <q-page class="flex flex-center">
    <img
      alt="Quasar logo"
      src="~assets/quasar-logo-vertical.svg"
      style="width: 200px; height: 200px"
    >
    Account
    <q-btn @click="logout" label="Logout" />
  </q-page>
</template>

<script>
import { LocalStorage } from 'quasar'

export default {
  name: 'IndexPage',
  methods: {
    logout () {
      LocalStorage.remove('user')
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
