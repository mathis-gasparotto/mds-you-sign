<template>
  <q-page class="flex page-container column">
    <!-- Bouton de retour -->
    <q-btn class="btn-back" @click="$router.go(-1)" label="Retour" />
    <h6>Émargement</h6>
    <p>Veuillez signer dans le cadre</p>
    <div class="signature-container">
      <div class="sign-here">Signez ici</div>
      <VueSignaturePad width="100%" height="200px" ref="signaturePad" :options="{ onBegin, onEnd }" />

    </div>
    <div class="contain-btn">
      <q-btn class="suppr" @click="undo">Effacer</q-btn>
    </div>
    <p>Je signe en tant que {{ user.name }}</p>
    <p>{{ user.mail }}</p>
    <div class="contain-btn">
      <router-link :to="{ name: 'signeScan' }">
        <q-btn :class="`q-mt-xl save btn btn-${isEmpty ? 'disabled' : 'secondary'}`" label="Sauvegarder" text-color="white"  :disable="isEmpty" />
      </router-link>
    </div>
  </q-page>
</template>

<script>
import { useRoute } from 'vue-router'
import { VueSignaturePad } from 'vue-signature-pad'

export default {
  name: 'SignePage',
  components: { VueSignaturePad },
  setup() {
    const route = useRoute()

    return {
      route
    }
  },
  data() {
    return {
      loading: true,
      user: {
        id: 1,
        name: 'Jade Gurnaud',
        mail: 'jade.gurnaud@my-digital-school.org'
      },
      isEmpty: true
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
    undo() {
      this.$refs.signaturePad.undoSignature()
      this.isEmpty = this.$refs.signaturePad.isEmpty()
    },
    // save() {
    //   const { isEmpty, data } = this.$refs.signaturePad.saveSignature()
    //   console.log(isEmpty)
    //   console.log(data)
    // },
    onBegin() {
      // console.log('=== Begin ===')
    },
    onEnd() {
      this.isEmpty = this.$refs.signaturePad.isEmpty()
    }
  }
}
</script>


<style lang="scss" scoped>
.signature-container {
  position: relative;
  background-color: rgba(221, 221, 221, 0.5);
  border: 1px solid #000;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

}

.contain-btn {
  display: flex;
  align-items: center;
  justify-content: center;
}

.suppr {
  margin: 10px;
  margin-left: -10px;
  margin-right: -10px;
}

.save {
  margin-top: 15px;
  // color: black;
  padding: 10px 25vw;
  // background-color: rgb(226, 226, 0);
}

.sign-here {
  position: absolute;
  font-size: 26px;
  color: rgba(59, 58, 58, 0.8);
}
</style>
