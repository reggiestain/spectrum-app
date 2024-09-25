<!-- ChartPie.vue -->
<template>
     <div class="flex justify-center">
      <!-- Render the Pie chart only if chartData and chartOptions are valid -->
      <Pie :chartData="chartData" :Options="Options" class="w-full max-w-96"/>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Pie } from 'vue-chartjs'
  import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale,
} from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale);
  
    const chartData = ref({
        labels: ['Excellent', 'Good', 'Average', 'Needs Improvement'],
  datasets: [
    {
      label: 'Progress Distribution',
      data: [45, 30, 15, 10],
      backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384', '#4BC0C0'],
      hoverOffset: 4,
    },
  ],
    })

    const Options = ref({
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
            position: 'right',
            },
            title: {
                display: true,
                text: 'Student Progress Distribution',
            },
        },
    })

  </script>
  
  <style scoped>
  .chart-container {
    width: 100%;
    height: 400px; /* Adjust this height as needed */
  }
  #pie-chart {
  height: 80px !important;
}
  </style>
  