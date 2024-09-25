// resources/js/router.js

import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import Login from '../components/Login.vue';
import Dashboard from '../components/Dashboard.vue';
import Users from '../components/users/UsersTable.vue';
import { useUserStore } from '../stores/userStore';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    meta: { requiresAuth: true }, // Set meta field to indicate route requires authentication
  },
  {
    path: '/users',
    name: 'Users',
    component: Users, // Set the component to display for this route
    meta: { requiresAuth: true }, // Set meta field to indicate route requires authentication
  },
  // Add more routes here as needed
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Navigation Guard for checking authentication
router.beforeEach((to, from, next) => {
  const userStore = useUserStore(); // Access the user store
  const isAuthenticated = !!userStore.token; // Check if the user is authenticated

  // Check if the route requires authentication
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isAuthenticated) {
      // If not authenticated, redirect to login
      return next({ name: 'Login'});
    }
  }
  // If authenticated or route doesn't require auth, allow access
  next();
});

export default router;
