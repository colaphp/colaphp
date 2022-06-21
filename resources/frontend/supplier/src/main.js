import { createApp } from 'vue'
import ElementPlus from 'element-plus'
import App from './App.vue'

createApp(App).use(ElementPlus, { size: 'small', zIndex: 3000 }).mount('#app')
