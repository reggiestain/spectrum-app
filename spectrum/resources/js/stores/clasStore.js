// stores/clastore.js
import { defineStore } from 'pinia';
import client from '../services/client';

export const useClasStore = defineStore('clastore', {
  state: () => ({
    clas: [],
    totalClas: 0,
    currentPage: 1,
    perPage: 10,
    error: null,
    loading: false,
  }),
  
  getters: {
    // Optional: You can define some computed properties here for filtered data
  },

  actions: {
    // Fetch all clas with pagination
    async fetchClas(page = 1) {
      this.loading = true;
      try {
        console.log(`Fetching clas for page: ${page}`);
        const response = await client.get(`/classes?page=${page}&perPage=${this.perPage}`);
        this.clas = response.data.NeuroClass;
        this.totalclas = response.data.total;
        this.currentPage = response.data.currentPage;
      } catch (error) {
        console.error("Error fetching clas:", error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to fetch clas.";
      } finally {
        this.loading = false;
      }
    },

    // Add a new clas
    async addClas(clasData) {
      this.loading = true;
      try {
        console.log("Adding clas:", clasData);
        const response = await client.post('/clas', clasData);
        console.log("clas added successfully:", response.data);
        await this.fetchclas(this.currentPage); // Refresh list after adding
      } catch (error) {
        console.error("Error adding clas:", error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to add clas.";
      } finally {
        this.loading = false;
      }
    },

    // Update an existing clas
    async updateClas(clasId, clasData) {
      this.loading = true;
      try {
        console.log(`Updating clas with ID: ${clasId}`, clasData);
        const response = await client.put(`/classes/${clasId}`, clasData);
        console.log("clas updated successfully:", response.data);
        await this.fetchclas(this.currentPage); // Refresh list after update
      } catch (error) {
        console.error(`Error updating clas with ID: ${clasId}`, error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to update clas.";
      } finally {
        this.loading = false;
      }
    },

    // Delete a clas
    async deleteClas(clasId) {
      this.loading = true;
      try {
        console.log(`Deleting clas with ID: ${clasId}`);
        await client.delete(`/classes/${clasId}`);
        console.log("clas deleted successfully");
        await this.fetchClas(this.currentPage); // Refresh list after deletion
      } catch (error) {
        console.error(`Error deleting clas with ID: ${clasId}`, error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to delete clas.";
      } finally {
        this.loading = false;
      }
    },
  },
});
