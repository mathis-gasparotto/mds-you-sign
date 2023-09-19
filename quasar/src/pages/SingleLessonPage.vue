<template>
  <q-page class="flex flex-center">
    <img
      alt="Quasar logo"
      src="~assets/quasar-logo-vertical.svg"
      style="width: 200px; height: 200px"
    >
    single
  </q-page>
</template>

<script>
import { useRoute } from 'vue-router'

export default {
  name: 'SingleLessonPage',
  setup() {
    const route = useRoute()

    return {
      route
    }
  },
  created() {
    console.log(this.route.params.id)
  }
}
</script>
