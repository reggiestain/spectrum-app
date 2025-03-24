// resources/js/stores/therapistStore.js
import { defineStore } from 'pinia';
import client from '../services/client';

export const useTherapistStore = defineStore('therapistStore', {
  state: () => ({
    therapists: [],
    totalTherapists: 0,
    total: 0,
    perPage: 10,
    currentPage: 1,
  }),

  getters: {
    totalPages: (state) => Math.ceil(state.total / state.perPage),
  },

  actions: {
    async fetchTherapists(page = 1, perPage = 10) {
      try {
        const response = await client.get(`/therapists`, {
          params: {
            page,
            perPage,
          },
        });
        this.therapists = response.data.therapists;
        this.total = response.data.total;
        this.currentPage = response.data.currentPage;
      } catch (error) {
        console.error('Error fetching therapists:', error);
      }
    },

    // Fetch total student count
    async fetchTherapistCount() {
      try {
        const response = await client.get('/therapists/count');
        this.totalTherapists = response.data.total_therapists;
      } catch (error) {
        console.error('Failed to fetch student count:', error.response?.data || error.message);
      }
    },

    async fetchTherapist(id) {
      try {
        const response = await client.get(`/therapists/${id}`);
        return response.data; // Return the therapist data
      } catch (error) {
        console.error('Error fetching therapist:', error);
        throw error; // Rethrow the error for handling in the component
      }
    },

    async createTherapist(therapistData) {
      try {
        const response = await client.post(`/therapists`, therapistData);
        return response.data; // Return created therapist data
      } catch (error) {
        console.error('Error creating therapist:', error);
        throw error; // Rethrow the error for handling in the component
      }
    },

    async updateTherapist(id, therapistData) {
      console.log("Submit T: ",therapistData)
      try {
        const response = await client.put(`/therapists/${id}`, therapistData);
        return response.data; // Return updated therapist data
      } catch (error) {
        console.error('Error updating therapist:', error);
        throw error; // Rethrow the error for handling in the component
      }
    },

    async deleteTherapist(id) {
      try {
        await client.delete(`/therapists/${id}`);
        this.fetchTherapists(this.currentPage); // Refresh the therapist list
      } catch (error) {
        console.error('Error deleting therapist:', error);
      }
    },
  },
});
