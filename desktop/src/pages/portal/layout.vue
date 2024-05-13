<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
const authStore = useAuthStore();
</script>

<template>
  <header>
    <div class="wrapper">
      <nav>
        <RouterLink to="/">首页</RouterLink>

        <template v-if="authStore.check()">
          <RouterLink :to="{ name: 'user.index' }">用户中心</RouterLink>
        </template>
        <template v-else>
          <RouterLink :to="{ name: 'passport.login' }">登录</RouterLink>
        </template>
      </nav>
    </div>
  </header>
  <RouterView />  
  <div >
    Footer component
  </div>
</template>
