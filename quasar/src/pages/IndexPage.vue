<template>
  <q-page class="flex flex-center column">
    <h4>Bonjour Jade</h4>
    <q-spinner-gears size="100px" color="primary" v-if="loading"></q-spinner-gears>
    <div v-else>
      <h6>Aujourd'hui <span class="small color-grey">({{ todayLessons.length }})</span></h6>
      <ul class="lessons-list">
        <li v-for="singleLesson in todayLessons" :key="singleLesson.id" class="flex lessons-item q-mb-md">
          <img class="lessons-img q-mr-sm" src="~assets/quasar-logo-vertical.svg" alt="">
          <div class="lesson-content">
            <p>{{ singleLesson.label }}</p>
            <p class="color-grey">{{ `${getHours(singleLesson.startAt)} - ${getHours(singleLesson.endAt)}` }}</p>
          </div>
          <q-icon name="check" color="green" size="md" class="q-ml-xl" v-if="singleLesson.signed"></q-icon>
        </li>
      </ul>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'IndexPage',
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
    &-img {
      width: 50px;
    }
    &-item {
      align-items: center;
      p {
        margin: 0 0 5px 0;
      }
    }
  }
</style>
