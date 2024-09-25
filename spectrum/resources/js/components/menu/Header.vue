<template>
  <header class="bg-white border-b shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <!--<img src="/images/logo.png" alt="Logo" class="h-8 w-auto" />-->
        <span class="text-gray-700 text-lg font-bold">NEURO SYNC ONLINE SOLUTION</span>
      </div>

      <!-- Navigation -->
      <nav class="hidden lg:flex space-x-8">
        <a href="#" class="text-black-700 hover:text-red-600">HOME</a>
        <a href="#" class="text-black-700 hover:text-red-600">ABOUT</a>
        <a href="#" class="text-black-700 hover:text-red-600">PROGRAMS & SERVICES</a>
        <a href="#" class="text-black-700 hover:text-red-600">REQUEST DEMO</a>
        <a href="#" class="text-black-700 hover:text-red-600">CONTACT US</a>
      </nav>

      <!-- Buttons and User Icon -->
      <div class="flex space-x-4 items-center">
        <!-- Conditionally Render Login Button or Profile Icon -->
        <div v-if="!userStore.user">
          <router-link to="/login">
            <button class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-red-800">LOGIN</button>
          </router-link>
        </div>

        <div v-else class="relative">
          <!-- Profile SVG Icon -->
          <button @click="toggleDropdown" class="flex items-center space-x-2 focus:outline-none">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-8 w-8 text-gray-700 hover:text-red-600"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5.121 17.804A4.001 4.001 0 0110 14h4a4.001 4.001 0 014.879 3.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"
              />
            </svg>
            <span class="text-gray-700 font-semibold">{{ userStore.user.name }}</span>
          </button>

          <!-- Dropdown Menu -->
          <div v-if="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
            <a href="#" @click="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue';
import { useUserStore } from '../../stores/userStore';

// Dropdown state
const dropdownOpen = ref(false);

// Toggle dropdown
const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value;
};

// Access user store
const userStore = useUserStore();

// Logout function
const logout = () => {
  userStore.logout();
  // Close the dropdown after logging out
  router.push('/');   // Redirect to home page after logout
  dropdownOpen.value = false; // Close dropdown after logout
};
</script>

<style scoped>
/* Optional custom styles */
</style>
