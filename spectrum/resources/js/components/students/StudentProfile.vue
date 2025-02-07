<template>
  <header-component></header-component>
  <div class="dashboard-container h-screen flex">
    <Sidebar></Sidebar>
    <div class="p-8 flex-1 flex flex-col overflow-auto">
      <!-- Header Section -->
      <div class="flex justify-between items-center mb-8"></div>

      <!-- Profile Details -->
      <div class="flex items-center justify-between mt-4">
        <!-- Profile Details -->
        <div class="flex items-center space-x-4">
          <img
            class="w-24 h-24 rounded-full border-4 border-white shadow-lg"
            src="https://via.placeholder.com/96"
            alt="Profile Picture"
          />
          <div>
            <h2 class="text-2xl font-bold">{{ studentDetails?.first_name+" "+studentDetails?.last_name }}</h2>
            <p class="text-gray-500"><b>Date Of Birth:</b> {{ studentDetails?.birth_date }}</p>
            <p class="text-gray-500"><b>Class:</b> {{ studentDetails?.class.name }}</p>
            <p class="text-gray-500"><b>Teacher(s):</b> {{ studentDetails?.teacher.first_name+" "+studentDetails?.last_name }}</p>
            <p class="text-gray-500">
              <b>Therapist(s):</b>
              <span v-if="studentDetails?.therapists?.length">
                <template v-for="(therapist, index) in studentDetails.therapists" :key="therapist.id">
                  {{ therapist.first_name + " " + therapist.last_name }}
                  <span v-if="index < studentDetails.therapists.length - 1">, </span>
                </template>
              </span>
              <span v-else>No therapists assigned</span>
            </p>
          </div>
        </div>

        <!-- Contact Information -->
        <div class="text-left">
          <p class="text-gray-500"><b>Parent:</b> {{ studentDetails?.parent.first_name+" "+studentDetails?.parent.last_name }}</p>
          <p class="text-gray-500"><b>Email:</b> {{ studentDetails?.parent.email }}</p>
          <p class="text-gray-500"><b>Contact Number:</b> {{ studentDetails?.parent.phone }}</p>
        </div>
      </div>

      <!-- Profile Actions -->
      <div class="flex space-x-4 mt-4">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Add profile section</button>
        <!--<button class="bg-blue-500 text-white px-4 py-2 rounded">Update profile</button>-->
        <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Resources</button>
      </div>

      <!-- Work Status -->
      <div class="bg-gray-100 p-4 mt-6 rounded-lg">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium">Condition:</p>
            <p class="text-sm text-gray-600">{{ studentDetails?.condition }}</p>
            <a href="#" class="text-blue-500 text-sm">Show details</a>
          </div>
          <div>
            <!--<button class="text-gray-500 hover:text-gray-700">✏️</button>-->
          </div>
        </div>
      </div>

      <!-- Reports Table -->
      <StudentReport :studentId="studentId"/>
    </div>
  </div>
  </template>
  <script setup>
  import { onMounted, ref } from "vue";
  import { useRoute } from "vue-router"; // Import route to access parameters
  import Sidebar from "../menu/Sidebar.vue";
  import StudentReport from "./StudentReport.vue"
  import { useStudentStore } from '../../stores/studentStore';
  const route = useRoute(); // Access route parameters
  const studentStore = useStudentStore();
  const studentId = route.params.id; // Get the student ID from route
  const studentDetails = ref(null);

  const fetchStudentDetails = async (studentId) => {
          await studentStore.fetchStudent(studentId);
            studentDetails.value = studentStore.student;
            console.log("studentDetails: ",studentStore.student)
};

  onMounted(() => {
    // Fetch student details using the studentId
    fetchStudentDetails(studentId);
});
</script>
  
<style scoped>
  /* Add any additional styling if needed */
</style>
  