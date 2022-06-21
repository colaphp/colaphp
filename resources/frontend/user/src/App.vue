<script setup>
import axios from "./utils/axios"
import HelloWorld from './components/HelloWorld.vue'

const csrf = () => axios.get('/sanctum/csrf-cookie')
csrf()
</script>

<template>
    <HelloWorld msg="Hello"/>
</template>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>
