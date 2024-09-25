// Make sure to include the necessary imports and configurations as needed
import { defineStore } from 'pinia';
import client from '../services/client';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    token: null,
    users: [],
    totalUsers: 0,
    currentPage: 1,
    perPage: 10,
  }),
  actions: {
    async login(email, password) {
      try {
        const response = await client.post('/login', { email, password });
        this.user = response.data.user;
        this.token = response.data.token;
        client.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        return true;
      } catch (error) {
        console.error('Login failed:', error.response.data);
        throw error.response.data;
      }
    },
    async register(name, email, password) {
      try {
        const response = await client.post('/register', { name, email, password });
        this.user = response.data.user;
        this.token = response.data.token;
        client.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      } catch (error) {
        console.error('Registration failed:', error.response.data);
        throw error.response.data;
      }
    },
    logout() {
      this.user = null;
      this.token = null;
      client.defaults.headers.common['Authorization'] = '';
    },
    async fetchUsers(page = 1) {
      try {
        const response = await client.get('/users', {
          params: { page, perPage: this.perPage },
        });
        this.users = response.data.users;
        this.totalUsers = response.data.total;
        this.currentPage = page;
      } catch (error) {
        console.error('Failed to fetch users:', error.response.data);
      }
    },
  },
});
