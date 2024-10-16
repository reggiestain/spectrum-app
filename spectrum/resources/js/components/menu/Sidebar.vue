<template>
    <div class="w-20 h-dvh bg-white border shadow-sm flex flex-col items-center py-4">
      <!-- Sidebar Icons Menu -->
      <nav class="flex flex-col justify-center items-center flex-1 space-y-10">
        <!-- Dashboard Menu Item -->
        <router-link to="/dashboard" class="block" title="Dashboard" @click="setActive('dashboard')" :class="{ 'active': activeItem === 'dashboard' }">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 opacity-50 hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <path d="M3 3h18v18H3V3z"></path>
            <path d="M9 9h6v6H9V9z"></path>
          </svg>
        </router-link>
        <!-- User Icon with Tooltip -->
        <router-link to="/users" class="block" title="User" @click="setActive('user')" :class="{ 'active': activeItem === 'user' }">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 opacity-50 hover:opacity-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 16v1m-2-2c0-1.1.9-2 2-2s2 .9 2 2m-2-5a2 2 0 100-4 2 2 0 000 4z"/>
          </svg>
        </router-link>
  
        <!-- Therapist Icon with Tooltip -->
        <router-link to="/therapists" class="block" title="Therapist" @click="setActive('therapist')" :class="{ 'active': activeItem === 'therapist' }">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 opacity-50 hover:opacity-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-1.1 0-2-.9-2-2h4c0 1.1-.9 2-2 2zm3.11-4.25l-.16-.12-.14-.14c-1.16-.98-1.84-2.36-1.84-3.77v-1c0-1.49-1.51-2.68-3.35-2.68-1.84 0-3.35 1.19-3.35 2.68v1c0 1.41-.68 2.79-1.84 3.77l-.14.14-.16.12c-.26.19-.41.51-.41.86h12c0-.35-.15-.67-.41-.86zM12 4.5c.83 0 1.5.67 1.5 1.5S12.83 7.5 12 7.5 10.5 6.83 10.5 6 11.17 4.5 12 4.5z"/>
          </svg>
        </router-link>
  
        <!-- Student Icon with Tooltip -->
        <router-link to="/students" class="block" title="Student" @click="setActive('student')" :class="{ 'active': activeItem === 'student' }">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 opacity-50 hover:opacity-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 21v-2a4 4 0 014-4h6a4 4 0 014 4v2M12 14a4 4 0 100-8 4 4 0 000 8zM12 14v8M8 21h8"/>
          </svg>
        </router-link>
  
        <!-- Report Icon with Tooltip -->
        <a href="#" class="block" title="Report" @click="setActive('report')" :class="{ 'active': activeItem === 'report' }">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 opacity-50 hover:opacity-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2m0-4h18M7 8h10M7 4h10"/>
          </svg>
        </a>
      </nav>
  
      <!-- Bottom Section (Settings SVG Icon with Tooltip) -->
      <div class="mt-auto mb-4">
        <a href="#" title="Settings" @click="setActive('settings')" :class="{ 'active': activeItem === 'settings' }">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 opacity-50 hover:opacity-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 8v4l3 3"/>
          </svg>
        </a>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  // Active item state
  const activeItem = ref('');
  
  // Method to set active item
  const setActive = (item) => {
    activeItem.value = item;
  };
  </script>
  
  <style scoped>
  /* Active link styles */
  a.active svg {
    opacity: 1;
    stroke: #f00; /* Change stroke color for active item */
  }
  
  a.active {
    border-left: 4px solid #f00; /* Optional: Red border for active item */
    padding-left: 4px;
  }
  </style>
  