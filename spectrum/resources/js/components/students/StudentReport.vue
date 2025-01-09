<template>
    <div class="p-6 bg-white rounded shadow">
      <h2 class="text-2xl font-bold mb-4">Therapy Reports</h2>
      <p class="mb-6 text-gray-600">
        Below is a list of attached daily reports.
      </p>
      <!--<button class="bg-blue-500 text-white px-4 py-2 rounded mb-4" @click="generateReport">
        + Generate Report
      </button>-->
      <div class="bg-white shadow overflow-hidden sm:rounded-lg flex-1 overflow-hidden">
        <!-- Wrapper for vertical scrolling -->
        <div class="overflow-y-auto max-h-[500px]">
          <!-- Wrapper for horizontal scrolling -->
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Report Name
                  </th>
                  <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Date Generated
                  </th>
                  <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="report in reports" :key="report.id" class="hover:bg-gray-100">
                  <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ report.name }}</td>
                  <td class="py-4 px-6 text-sm text-gray-500">{{ report.date }}</td>
                  <td class="py-4 px-6 text-sm">
                    <span
                      :class="{
                        'text-green-500': report.status === 'Completed',
                        'text-yellow-500': report.status === 'Pending',
                        'text-red-500': report.status === 'Failed',
                      }"
                    >
                      {{ report.status }}
                    </span>
                  </td>
                  <td class="py-4 px-6 text-sm text-gray-500">
                    <button class="text-blue-500 hover:underline" @click="viewReport(report.id)">Download</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from 'vue';
  const reports = ref([
    { id: 1, name: 'Therapy Report Q1', date: '2024-12-01', status: 'Completed' },
    { id: 2, name: 'Therapy Report', date: '2024-12-05', status: 'Completed' },
    { id: 3, name: 'Therapy reportt', date: '2024-11-30', status: 'Completed' },
    // Add more reports as needed
  ]);
  
  const generateReport = () => {
    // Implement report generation logic
  };
  
  const viewReport = (id) => {
    // Implement logic to view the report details
  };
  </script>
  
  <style scoped>
  /* Add any additional styling if needed */
  </style>
  