<template>
  <header-component></header-component>
      <div class="dashboard-container">
        <!-- Sidebar -->
        <Sidebar />
    
        <!-- Main content area -->
        <div class="main-content flex-1">
          <!-- Header -->
          <header class="bg-white border-b shadow-sm px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
              <!-- NEUROSYNC ONLINE SOLUTION Logo -->
              <!--<img src="/images/neurosync-logo.png" alt="Neurosync Logo" class="w-12 h-12">-->
              <h1 class="text-xl font-semibold">NEUROSYNC ONLINE SOLUTION</h1>
            </div>
            <div class="user-profile">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 16v1m-2-2c0-1.1.9-2 2-2s2 .9 2 2m-2-5a2 2 0 100-4 2 2 0 000 4z" />
              </svg>
            </div>
          </header>
    
          <!-- Neuro Students and Therapists Management Section -->
          <section class="p-8">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-semibold">Neuro Students and Therapists</h2>
              <button class="bg-red-600 text-white py-2 px-4 rounded">Export Report</button>
            </div>
    
            <!-- Statistics Cards for Neuro Students and Therapists -->
            <div class="stats-grid grid grid-cols-3 gap-6 mb-6">
              <div class="stat-card bg-white p-6 rounded shadow-sm">
                <h3 class="text-lg font-semibold">Total Neuro Students</h3>
                <p class="text-3xl font-bold">450</p>
                <p class="text-sm text-gray-500">Active and enrolled</p>
              </div>
              <div class="stat-card bg-white p-6 rounded shadow-sm">
                <h3 class="text-lg font-semibold">Total Therapists</h3>
                <p class="text-3xl font-bold">120</p>
                <p class="text-sm text-gray-500">Available across centers</p>
              </div>
              <div class="stat-card bg-white p-6 rounded shadow-sm">
                <h3 class="text-lg font-semibold">Sessions This Week</h3>
                <p class="text-3xl font-bold">85</p>
                <p class="text-sm text-gray-500">Scheduled therapy sessions</p>
              </div>
            </div>
    
            <!-- Suggested Graphs: Progress and Sessions Data -->
            <div class="grid grid-cols-2 gap-6">
              <!-- Line Chart for Therapy Sessions Trend -->
              <div class="chart-card bg-white p-6 rounded shadow-sm">
                <h4 class="text-lg font-semibold mb-4">Therapy Sessions Over Time</h4>
                <ChartLine />
              </div>
    
              <!-- Pie Chart for Student Progress Distribution -->
               
              <div class="chart-card bg-white p-6 rounded shadow-sm">
                <h4 class="text-lg font-semibold mb-4">Student Progress Distribution</h4>
                <ChartPie  width="100" height="400"/>
              </div>
            </div>
          </section>
        </div>
      </div>
    </template>
    
    <script setup>
    import Sidebar from './menu/Sidebar.vue';
    import ChartLine from './charts/ChartLine.vue';
    import ChartPie from './charts/ChartPie.vue';
    
    </script>
    
    <style scoped>
    .dashboard-container {
      display: flex;
      height: 100vh;
    }
    
    .main-content {
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
    }
    
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1rem;
    }
    
    .stat-card {
      background-color: #fff;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      width: 100%;
      height: 200px !important;
    }
    
    .chart-card {
      background-color: #fff;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .chart-container {
      width: 100%;
      height: 400px; /* Adjust this height as needed */
      position: relative;
    }
    </style>
  