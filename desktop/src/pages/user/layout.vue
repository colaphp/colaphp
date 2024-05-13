<script setup lang="ts">
import { RouterLink, RouterView, useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore();

const logout = () => {
  authStore.logout()
  router.push({ name: 'passport.login' })
}
</script>

<template>
  <header>
    user layout
    <div class="wrapper">
      <nav>
        <RouterLink to="/">返回首页</RouterLink>

        <a href="#" @click="logout()">注销</a>
      </nav>
    </div>
  </header>

  <RouterView />

  <footer>
    footer
  </footer>
</template>
