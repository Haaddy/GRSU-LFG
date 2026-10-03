import HomePage from '@/components/pages/HomePage.vue';
import RegisterPage from '@/components/pages/RegisterPage.vue';
import { createRouter, createWebHistory } from 'vue-router';


const routes = [
  { path: '/', component: HomePage },
  {path: '/register', component: RegisterPage}
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;