<template>
    <q-page class="flex page-container column">
      <!-- Bouton de retour -->
      <q-btn
        class="btn-back"
        @click="$router.go(-1)"
        label="Retour"
      />
      <h6>Jusitifer une absence</h6>
      <p class="q-mb-lg">La demande de justification sera envoyée à un administrateur pour validation.</p>
      <div class="text-bold">Justification {{ selected }}</div>
        <select v-model="selected" class="rounded-input">
            <option disabled value="">Sélectionner une justification</option>
            <option>HYPERPLANNING - Décès</option>
            <option>HYPERPLANNING - Justifié</option>
            <option>HYPERPLANNING - Réveil</option>
            <option>HYPERPLANNING - Autres</option>
        </select>
        <label class="text-bold  q-mt-md">Date de début</label>
        <input v-model="startDate" type="datetime-local" class="rounded-input">
        <label class="text-bold  q-mt-md">Date de fin</label>
        <input v-model="endDate" type="datetime-local" class="rounded-input">
      <div class="contain-btn">
      <router-link :to="{ name: 'home' }">
        <q-btn class="save" label="Envoyer justificatif" :disabled="!isValidForm" />
      </router-link>
    </div>
    </q-page>
  </template>
  
  <script>
import { useRoute } from 'vue-router'

export default {
  name: 'JustificatifAbsencePage',
  setup() {
    const route = useRoute()

    return {
      route
    }
  },
  data () {
    return {
      loading: true,
      selected: '', 
      startDate: '',
      endDate: '',
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
  computed: {
  isValidForm() {
    return this.selected !== '' && this.startDate !== '' && this.endDate !== '';
  },
},
}
</script>
  

<style lang="scss" scoped>
.contain-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 10vh;
}

.save {
    color: black;
    padding: 10px 20vw;
    background-color: rgb(226, 226, 0);
}
.rounded-input {
  border-radius: 5px; 
  border: 1px solid #ccc;
  padding: 8px; 
  margin: 4px 0;
}
</style>