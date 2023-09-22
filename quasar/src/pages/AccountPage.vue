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
      <h4 class="q-mt-md text-bold">{{ user.first_name + ' ' + user.last_name }}</h4>
      <div class="account-infos">
        <p class="account-infos-label">Email</p>
        <p class="account-infos-value text-bold">{{ user.email }}</p>
      </div>
      <q-btn color="negative" @click="logout" label="Logout" class="q-mt-lg" />
    </div>
  </q-page>
</template>

<script>
import { LocalStorage, Notify } from 'quasar'
import { api } from 'boot/axios'

export default {
  name: 'AccountPage',
  data () {
    return {
      user: {},
      loading: true
    }
  },
  created () {
    api.get('/users/me')
      .then((response) => {
        this.loading = false
        this.user = response.data
      })
      .catch((e) => {
        this.loading = false
        Notify.create({
          color: 'negative',
          position: 'top',
          message: 'Une erreur est survenue',
          icon: 'report_problem'
        })
      })
  },
  methods: {
    logout () {
      LocalStorage.remove('token')
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
