<template>
    <header-component></header-component>
    <div class="dashboard-container h-screen flex">
      <Sidebar></Sidebar>
      <div class="p-8 flex-1 flex flex-col overflow-auto">
        <!-- Header Section -->
     <div class="flex justify-between items-center mb-8"></div>
  
    <!--<div class="relative">
    <div class="h-32 bg-gray-200 rounded-t-lg"></div>
    <button class="absolute top-2 right-2 bg-yellow-500 text-white px-3 py-1 rounded text-sm">
        Enhance cover image
    </button>
    </div>-->

    <!-- Profile Image and Details -->
    <div class="flex items-center justify-between mt-4">
        <!-- Profile Details -->
        <div class="flex items-center space-x-4">
          <img
            class="w-24 h-24 rounded-full border-4 border-white shadow-lg"
            src="https://via.placeholder.com/96"
            alt="Profile Picture"
          />
          <div>
            <h2 class="text-2xl font-bold">Coralie Opoku</h2>
            <p class="text-gray-500"><b>Date Of Birth:</b> </p>
            <p class="text-gray-500"><b>Class:</b> Nursery 1</p>
            <p class="text-gray-500"><b>Teacher(s):</b> Gideon Nii Sai Obodai</p>
            <p class="text-gray-500"><b>Therapist(s):</b> Daniel Percy Okyere</p>
          </div>
        </div>

        <!-- Contact Information -->
        <div class="text-left">
            <p class="text-gray-500"><b>Parent:</b> Mrs Mccarthy</p>
          <p class="text-gray-500"><b>Email:</b> example@example.com</p>
          <p class="text-gray-500"><b>Contact Number:</b> 123-456-7890</p>
        </div>
    </div>

    <!-- Profile Actions -->
    <div class="flex space-x-4 mt-4">
      <button class="bg-blue-500 text-white px-4 py-2 rounded">Add profile section</button>
      <button class="bg-blue-500 text-white px-4 py-2 rounded">Update profile</button>
      <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Resources</button>
    </div>

    <!-- Work Status -->
    <div class="bg-gray-100 p-4 mt-6 rounded-lg">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium">Condition:</p>
          <p class="text-sm text-gray-600">Autism level1</p>
          <a href="#" class="text-blue-500 text-sm">Show details</a>
        </div>
        <div>
          <button class="text-gray-500 hover:text-gray-700">✏️</button>
        </div>
      </div>
    </div>

    <!-- Internal Hiring Status -->
    <!--<div class="bg-gray-100 p-4 mt-4 rounded-lg">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-600">Tell internal hirers you’re interested in jobs at your current company</p>
          <a href="#" class="text-blue-500 text-sm">Get started</a>
        </div>
        <div>
          <button class="text-gray-500 hover:text-gray-700">❌</button>
        </div>
      </div>
    </div>-->
    <!-- Reports Table -->
    <StudentReport />
      </div>
    </div>
  </template>
  <script setup>
  import Sidebar from "../menu/Sidebar.vue";
  import StudentReport from "./StudentReport.vue"
  defineProps({
    user: {
      type: Object,
      default: () => ({
        name: "Michael Simbal",
        title: "Marketing Exec. at Denva Corp",
        description:
          "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto, placeat!",
        status: "Open for side gigs",
        joinedOn: "Apr 08, 2022",
        profileImage: "https://via.placeholder.com/96",
      }),
    },
  });
  
  </script>
  
  <style scoped>
  /* Add any additional styling if needed */
  </style>
  