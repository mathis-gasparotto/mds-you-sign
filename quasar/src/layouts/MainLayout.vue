<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <router-view />
    </q-page-container>
    <q-footer class="nav-bar-container">
      <q-tabs align="center" class="bg-dark nav-bar" indicator-color="transparent" active-color="secondary">
        <q-route-tab :to="{ name: 'home' }" icon="home" label="Accueil" />
        <q-route-tab :to="{ name: 'account' }" icon="account_circle" label="Compte" />
      </q-tabs>
    </q-footer>
  </q-layout>
</template>

<script>
export default {
  name: 'MainLayout'
}
</script>
