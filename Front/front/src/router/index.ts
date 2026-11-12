import HomePage from '@/components/pages/HomePage.vue';
import LoginPage from '@/components/pages/LoginPage.vue';
import RegisterPage from '@/components/pages/RegisterPage.vue';
import DashboardPage from '@/components/pages/DashboardPage.vue';
import CreateEventPage from '@/components/pages/CreateEventPage.vue';
import CreateTeamPage from '@/components/pages/CreateTeamPage.vue';
import EventDetails from '@/components/pages/EventDetails.vue';
import TeamDetailsPage from '@/components/pages/TeamDetailsPage.vue';
import { createRouter, createWebHistory } from 'vue-router';


const routes = [
  { path: '/', component: HomePage },
  {path: '/dashboard', component: DashboardPage},
  {path: '/create-event', component: CreateEventPage},
  {path: '/create-team', component: CreateTeamPage},
  {path: '/event-details', component: EventDetails},
  {path: '/team-details/:teamId', component: TeamDetailsPage},
  {path: '/register', component: RegisterPage},
  {path: '/login', component: LoginPage}

];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;