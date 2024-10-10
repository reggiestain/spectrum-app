// stores/schoolStore.js
import { defineStore } from 'pinia';
import client from '../services/client';


export const useSchoolStore = defineStore('schoolStore', {
  state: () => ({
    schools: []
  }),
  actions: {
    async fetchSchools() {
      try {
        const response = await client.get('/schools'); // Adjust the API endpoint as needed
        this.schools = response.data;
      } catch (error) {
        console.error('Error fetching schools:', error);
      }
    }
  }
});
