<template>
  <q-page class="flex page-container column">
    <q-spinner-gears size="100px" color="primary" v-if="loading"></q-spinner-gears>
    <div v-else>
      <!-- Bouton de retour -->
      <q-btn
        class="q-mb-xl"
        @click="$router.go(-1)"
        label="Retour"
      />
      <ul class="lessons-list">
        <li class="lessons-item q-mb-md">
          <CardComponent :title="`${getHours(singleLesson.start_at)} - ${getHours(singleLesson.end_at)}`" :description="`${getDate(singleLesson.start_at)}`" iconPath="assets/alarm.png" />
          <CardComponent :title="singleLesson.room" description="Salle" iconPath="assets/room.png" />
          <CardComponent :title="singleLesson.teacher.last_name + '' + singleLesson.teacher.first_name" description="Intervenant" iconPath="assets/teacher.png" />
        </li>
      </ul>
      <h6>Description</h6>
      <p>MBA1 Développeur Full-Stack</p>
      <div class="contain-btn" v-if="!singleLesson.signed">
      <router-link :to="{ name: 'signe' }">
        <q-btn class="btn-signe" label="Signe & Scan" />
      </router-link>
      </div>
      <div class="signed-bar" v-if="singleLesson.signed">
        <q-icon name="check" color="white" size="2rem" />
        <span class="q-ml-sm">Signé</span>
      </div>
    </div>
  </q-page>
</template>

<script>
import { useRoute } from 'vue-router'
import CardComponent from 'components/CardComponent.vue'
import { api } from 'boot/axios'

export default {
  name: 'SingleLessonPage',
  components: {
    CardComponent
  },
  setup() {
    const route = useRoute()

    return {
      route
    }
  },
  data () {
    return {
      loading: true,
      singleLesson: {
        id: 1,
        startAt: '2023-09-19T09:00',
        endAt: '2023-09-19T12:30',
        label: 'Starter pack',
        signed: true,
        room: 'F7',
        teacher: 'Benjamin DELAMARRE'
      }
    }
  },
  created() {
    this.loading = true
    api.get(`/lessons/${this.route.params.id}`)
      .then((response) => {
        this.loading = false
        this.singleLesson = response.data
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
    getDate(date) {
      const dateObject = new Date(date)
      const day = dateObject.getDate()
      const month = dateObject.getMonth() + 1
      const year = dateObject.getFullYear()

      // Formater la date en "jj/mm/aaaa"
      const formattedDate = `${day}/${month.toString().padStart(2, '0')}/${year}`
      return formattedDate
    }
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
  }
  .signed-bar {
    position: fixed;
    bottom: 72px;
    left: 0;
    width: 100%;
    height: 50px;
    background-color: #3fbb43;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .contain-btn {
    position: absolute;
    left:5px;
    right: 5px;
    bottom: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
}
  .btn-signe {
    color: black;
    padding: 10px 30vw;
    background-color: rgb(226, 226, 0);
}
</style>
