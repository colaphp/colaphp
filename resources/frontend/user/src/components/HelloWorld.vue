<script setup>
import {ref} from 'vue'
import axios from "../utils/axios"

defineProps({
    msg: String
})

const user = ref({})

axios.get('/api/user').then(function (res) {
    console.log(res, 'api ddd user')
})
</script>

<template>
    <h1>{{ msg }}</h1>
</template>

<style scoped>

</style>
