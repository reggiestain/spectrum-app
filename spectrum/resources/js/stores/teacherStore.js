// stores/teacherstore.js
import { defineStore } from 'pinia';
import client from '../services/client';

export const useTeacherStore = defineStore('teacherStore', {
  state: () => ({
    teachers: [],
    totalTeachers: 0,
    currentPage: 1,
    perPage: 50,
    error: null,
    loading: false,
  }),
  
  getters: {
    // Optional: You can define some computed properties here for filtered data
  },

  actions: {
    // Fetch all teachers with pagination
    async fetchTeachers(page = 1) {
      this.loading = true;
      try {
        console.log(`Fetching teachers for page: ${page}`);
        const response = await client.get(`/teachers?page=${page}&perPage=${this.perPage}`);
        this.teachers = response.data.teachers;
        this.totalteachers = response.data.total;
        this.currentPage = response.data.currentPage;
        console.log("teachers fetched successfully:", this.teachers);
      } catch (error) {
        console.error("Error fetching teachers:", error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to fetch teachers.";
      } finally {
        this.loading = false;
      }
    },

    // Add a new Teacher
    async addTeacher(TeacherData) {
      this.loading = true;
      try {
        console.log("Adding Teacher:", TeacherData);
        const response = await client.post('/teachers', TeacherData);
        console.log("Teacher added successfully:", response.data);
        await this.fetchteachers(this.currentPage); // Refresh list after adding
      } catch (error) {
        console.error("Error adding Teacher:", error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to add Teacher.";
      } finally {
        this.loading = false;
      }
    },

    // Update an existing Teacher
    async updateTeacher(TeacherId, TeacherData) {
      this.loading = true;
      try {
        console.log(`Updating Teacher with ID: ${TeacherId}`, TeacherData);
        const response = await client.put(`/teachers/${TeacherId}`, TeacherData);
        console.log("Teacher updated successfully:", response.data);
        await this.fetchteachers(this.currentPage); // Refresh list after update
      } catch (error) {
        console.error(`Error updating Teacher with ID: ${TeacherId}`, error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to update Teacher.";
      } finally {
        this.loading = false;
      }
    },

    // Delete a Teacher
    async deleteTeacher(TeacherId) {
      this.loading = true;
      try {
        console.log(`Deleting Teacher with ID: ${TeacherId}`);
        await client.delete(`/teachers/${TeacherId}`);
        console.log("Teacher deleted successfully");
        await this.fetchteachers(this.currentPage); // Refresh list after deletion
      } catch (error) {
        console.error(`Error deleting Teacher with ID: ${TeacherId}`, error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to delete Teacher.";
      } finally {
        this.loading = false;
      }
    },
  },
});
