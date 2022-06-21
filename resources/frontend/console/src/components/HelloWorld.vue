<script setup>
import { ref } from 'vue'

defineProps({
  msg: String
})
</script>

<template>
  <h1>{{ msg }}</h1>
</template>

<style scoped>

</style>
