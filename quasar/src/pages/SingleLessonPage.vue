<template>
  <q-page class="flex page-container column">
    <!-- Bouton de retour -->
    <q-btn
      class="q-mb-xl custom-back-button"
      @click="$router.go(-1)"
      label="Retour"
    />
    <ul class="lessons-list">
      <li class="lessons-item q-mb-md">
        <CardComponent :title="`${getHours(singleLesson.startAt)} - ${getHours(singleLesson.endAt)}`" :description="`${getDate(singleLesson.startAt)}`" iconPath="assets/alarm.png" />
        <CardComponent :title="singleLesson.room" description="Salle" iconPath="assets/room.png" />
        <CardComponent :title="singleLesson.teacher" description="Intervenant" iconPath="assets/teacher.png" />
      </li>
    </ul>
    <h6>Description</h6>
    <p>MBA1 Développeur Full-Stack</p>
    <router-link :to="{ name: 'signeScan' }">
      <q-btn class="q-mt-xl" label="Signe & Scan" />
    </router-link>
  </q-page>
</template>

<script>
import { useRoute } from 'vue-router'
import CardComponent from 'components/CardComponent.vue'

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


    this.loading = false
    // fetch('https://jsonplaceholder.typicode.com/posts')
    //   .then((response) => response.json())
    //   .then((json) => {
    //     this.todayLessons = json
    //     this.loading = false
    //   })
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
      const dateObject = new Date(date);
      const day = dateObject.getDate();
      const month = dateObject.getMonth() + 1;
      const year = dateObject.getFullYear();

      // Formater la date en "jj/mm/aaaa"
      const formattedDate = `${day}/${month.toString().padStart(2, '0')}/${year}`;
      return formattedDate;
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
</style>
