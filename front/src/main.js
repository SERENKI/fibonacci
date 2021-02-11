import { createApp } from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './App.vue'

axios.defaults.baseURL = 'http://find-fibonacci.msp.anedod.ru/api'

createApp(App).use(VueAxios, axios).mount('#app')
