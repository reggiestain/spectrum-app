<!-- ChartLine.vue -->
<template>
    <div>
      <Line :chartData="chartData" :chartOptions="chartOptions" />
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Line } from 'vue-chartjs';
  import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    CategoryScale,
    LinearScale,
    PointElement,
  } from 'chart.js';
  
  // Register chart.js components
  ChartJS.register(Title, Tooltip, Legend, LineElement, CategoryScale, LinearScale, PointElement);
  
  const chartData = ref({
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    datasets: [
      {
        //label: 'Therapy Sessions',
        data: [15, 25, 30, 45],
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 2,
        tension: 0.4, // Add curve to the line
      },
    ],
  });
  
  const chartOptions = ref({
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: true,
      },
      title: {
        display: true,
        text: 'Therapy Sessions Trend',
      },
    },
  });
  </script>
  
  <style scoped>
  /* You can set specific styling for the chart here if needed */
  </style>
  