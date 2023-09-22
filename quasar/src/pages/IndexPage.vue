<template>
  <q-page class="flex page-container column">
    <q-spinner-gears size="100px" color="primary" v-if="loading"></q-spinner-gears>
    <div v-else>
      <h4>Bonjour {{ user.first_name }}</h4>
      <router-link :to="{ name: 'justifierAbsence' }">
        <q-btn class="q-mt-xl save btn-abs" label="Justifier une absence" />
      </router-link>
      <h6 class="q-mb-md">Aujourd'hui <span class="small color-grey">({{ todayLessons.length }})</span></h6>
      <ul class="lessons-list">
        <li v-for="singleLesson in todayLessons" :key="singleLesson.id" class="flex lessons-item q-mb-md">
          <q-item class="lessons-item" clickable :to="`/lessons/${singleLesson.id}`">
            <CardComponent :title="singleLesson.label" :description="`${getHours(singleLesson.start_at)} - ${getHours(singleLesson.end_at)}`" iconPath="assets/book.png" :checked="singleLesson.signed" />
          </q-item>
        </li>
      </ul>
    </div>
  </q-page>
</template>

<script>
import CardComponent from 'components/CardComponent.vue'
import { api } from 'boot/axios'
import { Notify, LocalStorage } from 'quasar'

export default {
  name: 'IndexPage',
  components: {
    CardComponent
  },
  data () {
    return {
      loading: true,
      todayLessons: [],
      user: {}
    }
  },
  created () {
    this.user = LocalStorage.getItem('user')

    api.get('/lessons/today')
      .then((response) => {
        this.loading = false
        this.todayLessons = response.data
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
    getHours (date) {
      const dateObject = new Date(date)
      return dateObject.toLocaleString('fr-FR', {
        hour: '2-digit',
        minute: '2-digit',
      })
    },
  }
}
</script>

<style lang="scss" scoped>
  .lessons {
    &-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    &-item {
      width: 100%;
    }
  }
  .btn-abs {
    margin-top: 10px;
    color: black;
    padding: 7px 7vw;
    background-color: rgb(226, 226, 0);
}
</style>
