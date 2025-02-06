// stores/studentStore.js
import { defineStore } from 'pinia';
import client from '../services/client';

export const useStudentStore = defineStore('studentStore', {
  state: () => ({
    students: [],
    student: {},
    totalStudents: 0,
    currentPage: 1,
    perPage: 10,
    error: null,
    loading: false,
  }),
  
  getters: {
    // Optional: You can define some computed properties here for filtered data
  },

  actions: {
    // Fetch all students with pagination
    async fetchStudents(page = 1) {
      this.loading = true;
      try {
        const response = await client.get('/students',{
        params: { page, perPage: this.perPage },
      });
      this.students = response.data.students;
      this.totalStudents = response.data.total;
      this.currentPage = page;
    } catch (error) {
      console.error('Failed to fetch students:', error.response.data);
    }
    },

    async fetchStudent(id) {
      this.loading = true;
      try {
        const response = await client.get('/students/'+id);
      this.student = response.data;
    } catch (error) {
      console.error('Failed to fetch students:', error.response.data);
    }
    },

    // Add a new student
    async addStudent(studentData) {
      console.log("Adding student:", studentData);
      try {
        const response = await client.post('/students', studentData);
        this.students = response.data
        return this.students
      } catch (error) {
        console.error('Adding student failed:', error);
        throw error;
      }
    },
    // Update an existing student
    async updateStudent(studentId, studentData) {
      try {
        console.log(`Updating student with ID: ${studentId}`, studentData);
        const response = await client.put(`/students/${studentId}`, studentData);   
        return response.data
      } catch (error) {
        console.error('Failed to update student:', error.response.data);
        throw error.response.data;
      }
    },
    // Delete a student
    async deleteStudent(studentId) {
      this.loading = true;
      try {
        console.log(`Deleting student with ID: ${studentId}`);
        await client.delete(`/students/${studentId}`);
        console.log("Student deleted successfully");
        await this.fetchStudents(this.currentPage); // Refresh list after deletion
      } catch (error) {
        console.error(`Error deleting student with ID: ${studentId}`, error.response?.data || error.message);
        this.error = error.response?.data?.message || "Failed to delete student.";
      } finally {
        this.loading = false;
      }
    },
    // Upload Student Report
    async uploadStudentReport(formData) {

      try {
        const response = await client.post('/student/report', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });
        console.log('Report uploaded successfully:', response.data);
        return true; // Indicate success
      } catch (error) {
        console.error('Error uploading report:', error.response?.data);
        this.reportValidationErrors = error.response?.data.errors || {};
        return false;
      }
    },
  },
});
