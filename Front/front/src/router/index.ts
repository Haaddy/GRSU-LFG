import HomePage from '@/components/pages/HomePage.vue';
import LoginPage from '@/components/pages/LoginPage.vue';
import RegisterPage from '@/components/pages/RegisterPage.vue';
import DashboardPage from '@/components/pages/DashboardPage.vue';
import { createRouter, createWebHistory } from 'vue-router';


const routes = [
  { path: '/', component: HomePage },
  {path: '/dashboard', component: DashboardPage},
  {path: '/register', component: RegisterPage},
  {path: '/login', component: LoginPage}

];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;