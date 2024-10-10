// stores/schoolStore.js
import { defineStore } from 'pinia';
import client from '../services/client';


export const useRoleStore = defineStore('RoleStore', {
  state: () => ({
    roles: []
  }),
  actions: {
    async fetchRoles() {
      try {
        const response = await client.get('/roles'); // Adjust the API endpoint as needed
        this.roles = response.data;
      } catch (error) {
        console.error('Error fetching roles:', error);
      }
    }
  }
});
