<template>
  <q-page class="flex page-container column">
    <h4>Bonjour Jade</h4>
    <q-spinner-gears size="100px" color="primary" v-if="loading"></q-spinner-gears>
    <div v-else>
      <router-link :to="{ name: 'justifierAbsence' }">
        <q-btn class="q-mt-xl save btn-abs" label="Justifier une absence" />
      </router-link>
      <h6>Aujourd'hui <span class="small color-grey">({{ todayLessons.length }})</span></h6>
      <ul class="lessons-list">
        <li v-for="singleLesson in todayLessons" :key="singleLesson.id" class="flex lessons-item q-mb-md">
          <q-item class="lessons-item" clickable :to="`/lessons/${singleLesson.id}`">
            <CardComponent :title="singleLesson.label" :description="`${getHours(singleLesson.startAt)} - ${getHours(singleLesson.endAt)}`" iconPath="assets/book.png" :checked="singleLesson.signed" />
          </q-item>
        </li>
      </ul>
    </div>
  </q-page>
</template>

<script>
import CardComponent from 'components/CardComponent.vue'

export default {
  name: 'IndexPage',
  components: {
    CardComponent
  },
  data () {
    return {
      loading: true,
      todayLessons: []
    }
  },
  created () {
    this.todayLessons = [
      {
        id: 1,
        startAt: '2023-09-19T09:00',
        endAt: '2023-09-19T12:30',
        label: 'Starter pack',
        signed: true
      },
      {
        id: 2,
        startAt: '2023-09-19T13:30',
        endAt: '2023-09-19T17:00',
        label: 'Starter pack',
        signed: false
      }
    ]
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
