<template>
  <q-page class="flex page-container column">
    <div  v-if="loading" class="flex flex-center">
      <q-spinner-gears size="100px" color="primary"></q-spinner-gears>
    </div>
    <div v-else class="flex container column">
      <div class="flex flex-center w-100">
        <q-avatar size="100px">
          <img src="https://cdn.quasar.dev/img/avatar.png">
        </q-avatar>
      </div>
      <h4 class="q-mt-md text-bold">{{ user.firstName + ' ' + user.lastName }}</h4>
      <div class="account-infos">
        <p class="account-infos-label">Email</p>
        <p class="account-infos-value text-bold">{{ user.email }}</p>
      </div>
      <q-btn color="negative" @click="logout" label="Logout" class="q-mt-lg" />
    </div>
  </q-page>
</template>

<script>
import { LocalStorage } from 'quasar'

export default {
  name: 'AccountPage',
  data () {
    return {
      user: {},
      loading: true
    }
  },
  created () {
    setTimeout(() => {
      this.user = {
        firstName: 'John',
        lastName: 'Doe',
        email: 'test@test.tes'
      }
      this.loading = false
    }, 1000)
  },
  methods: {
    logout () {
      LocalStorage.remove('user')
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style lang="scss" scoped>
.account {
  &-infos {
    padding: 0 15px;
  }
}
</style>
