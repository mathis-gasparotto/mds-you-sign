<template>
  <q-page class="flex flex-center">
    <q-form
      class="flex flex-center column form login-form"
      ref="loginForm"
      @submit.prevent="onsubmit()"
    >
      <q-input
        name="email"
        rounded
        outlined
        label="Adresse mail"
        autofocus
        class="q-mb-md login-input"
        type="email"
        v-model="form.email"
        :rules="[
          (val, rules) =>
            rules.email(val) || 'Veullez rensigner une addresse email valide'
        ]"
        lazy-rules
        hide-bottom-space
      ></q-input>
      <q-input
        name="password"
        rounded
        outlined
        label="Mot de passe"
        class="q-mb-md login-input"
        :type="showPassword ? 'text' : 'password'"
        v-model="form.password"
        :rules="[(val) => val.trim().length > 0 || 'Veullez remplir ce champ']"
        lazy-rules
        hide-bottom-space
      >
        <template v-slot:append>
          <q-icon
            :name="showPassword ? 'visibility' : 'visibility_off'"
            class="cursor-pointer"
            color="secondary"
            @click="showPassword = !showPassword"
          />
        </template></q-input>
      <q-btn
        label="Se connecter"
        type="submit"
        rounded
        :loading="loading"
        padding="sm 50px"
        size="18px"
        :disable="!validate"
        text-color="white"
        :class="`form-btn btn btn-${validate ? 'secondary' : 'disabled'}`"
      />
    </q-form>
  </q-page>
</template>

<script>
import { LocalStorage, Notify } from 'quasar'
import { api } from 'boot/axios'

export default {
  name: 'LoginPage',
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      showPassword: false,
      loading: false,
      validate: false
    }
  },
  watch: {
    form: {
      handler() {
        if (this.form.email && this.form.password) {
          this.$refs.loginForm.validate().then((success) => {
            if (success) {
              this.validate = true
            } else {
              this.validate = false
            }
          })
        } else {
          this.validate = false
        }
      },
      deep: true
    }
  },
  methods: {
    async onsubmit() {
      this.loading = true
      api.post('/login', this.form)
        .then((response) => {
          this.loading = false
          LocalStorage.set('token', response.data.token)
          LocalStorage.set('user', response.data.user)
          this.$router.push({ name: 'home' })
        })
        .catch((e) => {
          this.loading = false
          if (e.response && e.response.data.message === 'These credentials do not match our records.') {
            Notify.create({
              color: 'negative',
              position: 'top',
              message: 'Identifiants incorrects',
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
    }
  }
}
</script>
