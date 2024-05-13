<script setup lang="ts">
import { RouterLink } from 'vue-router'

</script>

<template>
  <main>
    The user page

    <RouterLink :to="{name: 'user.profile'}"> profile page </RouterLink>

  </main>
</template>
