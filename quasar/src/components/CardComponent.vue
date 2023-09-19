<template>
  <div class="flex card-item q-mb-md">
    <img class="card-img q-mr-sm" :src="iconPath">
    <div class="card-content">
      <p>{{ title }}</p>
      <p class="color-grey">{{ description }}</p>
    </div>
    <q-icon name="check" color="green" size="md" class="q-ml-xl" v-if="checked"></q-icon>
  </div>
</template>

<script>
export default {
  name: 'CardComponent',
  props: {
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
    iconPath: {
      type: String,
      required: true
    },
    checked: {
      type: Boolean,
      required: false,
      default: false
    }
  }
}
</script>

<style lang="scss" scoped>
  .card {
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
