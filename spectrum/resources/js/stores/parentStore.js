// stores/parentstore.js
import { defineStore } from 'pinia';
import client from '../services/client';

export const useParentStore = defineStore('parentStore', {
  state: () => ({
    parents: [],
    totalparents: 0,
    currentPage: 1,
    perPage: 40,
    error: null,
    loading: false,
  }),
  
  getters: {
    // Optional: You can define some computed properties here for filtered data
  },

  actions: {
    // Fetch all parents with pagination
    async fetchParents(page = 1) {
      this.loading = true;
      try {
        console.log(`Fetching parents for page: ${page}`);
        const response = await client.get(`/parents?page=${page}&perPage=${this.perPage}`);
        this.parents = response.data.parents;
        this.totalparents = response.data.total;
        this.currentPage = response.data.currentPage;
        console.log("parents fetched successfully:", this.parents);
      } catch (error) {
        console.error("Error fetching parents:", error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to fetch parents.";
      } finally {
        this.loading = false;
      }
    },

    // Add a new Parent
    async addParent(ParentData) {
      this.loading = true;
      try {
        console.log("Adding Parent:", ParentData);
        const response = await client.post('/parents', ParentData);
        console.log("Parent added successfully:", response.data);
        await this.fetchparents(this.currentPage); // Refresh list after adding
      } catch (error) {
        console.error("Error adding Parent:", error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to add Parent.";
      } finally {
        this.loading = false;
      }
    },

    // Update an existing Parent
    async updateParent(ParentId, ParentData) {
      this.loading = true;
      try {
        console.log(`Updating Parent with ID: ${ParentId}`, ParentData);
        const response = await client.put(`/parents/${ParentId}`, ParentData);
        console.log("Parent updated successfully:", response.data);
        await this.fetchparents(this.currentPage); // Refresh list after update
      } catch (error) {
        console.error(`Error updating Parent with ID: ${ParentId}`, error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to update Parent.";
      } finally {
        this.loading = false;
      }
    },

    // Delete a Parent
    async deleteParent(ParentId) {
      this.loading = true;
      try {
        console.log(`Deleting Parent with ID: ${ParentId}`);
        await client.delete(`/parents/${ParentId}`);
        console.log("Parent deleted successfully");
        await this.fetchParents(this.currentPage); // Refresh list after deletion
      } catch (error) {
        console.error(`Error deleting Parent with ID: ${ParentId}`, error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to delete Parent.";
      } finally {
        this.loading = false;
      }
    },
  },
});
