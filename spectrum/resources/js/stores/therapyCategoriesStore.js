import { defineStore } from 'pinia';
import client from '../services/client';

export const useTherapyCategoriesStore = defineStore('therapyCategories', {
    state: () => ({
        categories: [],
        loading: false,
        error: null,
    }),
    actions: {
        // Fetch all therapy categories
        async fetchTherapyCategories() {
            try {
                const response = await client.get('/therapy-categories');
                this.categories = response.data;
            } catch (error) {
                console.error('Error fetching categories:', error);
              }
        },

        // Create a new therapy category
        async createTherapyCategory(name) {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.post('/therapy-categories', { name });
                this.categories.push(response.data.data);
            } catch (err) {
                this.error = 'Failed to create therapy category.';
            } finally {
                this.loading = false;
            }
        },

        // Update a therapy category
        async updateTherapyCategory(id, name) {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.put(`/api/therapy-categories/${id}`, { name });
                const index = this.categories.findIndex((category) => category.id === id);
                if (index !== -1) {
                    this.categories[index] = response.data.data;
                }
            } catch (err) {
                this.error = 'Failed to update therapy category.';
            } finally {
                this.loading = false;
            }
        },

        // Delete a therapy category
        async deleteTherapyCategory(id) {
            this.loading = true;
            this.error = null;
            try {
                await axios.delete(`/api/therapy-categories/${id}`);
                this.categories = this.categories.filter((category) => category.id !== id);
            } catch (err) {
                this.error = 'Failed to delete therapy category.';
            } finally {
                this.loading = false;
            }
        },
    },
});
