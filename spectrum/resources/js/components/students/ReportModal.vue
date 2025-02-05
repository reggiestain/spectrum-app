<script setup>
import { defineProps, defineEmits, ref } from 'vue';

const props = defineProps([
  'isUploadModalOpen', 
  'reportName', 
  'therapists', 
  'currentStudent', 
  'reportValidationErrors', 
  'availableYears', 
  'months', 
  'availableDays'
]);

const emit = defineEmits(['closeUploadModal', 'uploadReport']);
const selectedYear = ref('Select a year');
const selectedMonth = ref('Select a month');
const selectedDay = ref('Select a day');
const notes = ref('');
const selectedFile = ref(null);
const therapist_id = ref(""); // Store the selected therapist ID
const validationErrors = ref({}); // Store errors

const handleFileInput = (event) => {
  selectedFile.value = event.target.files[0];
};

const uploadReport = () => {
  validationErrors.value = {}; // Reset errors
  // Validate required fields
  if (!therapist_id.value) validationErrors.value.therapist_id = "Therapist is required.";
  if (!selectedYear.value) validationErrors.value.year = "Year is required.";
  if (!selectedMonth.value) validationErrors.value.month = "Month is required.";
  if (!selectedDay.value) validationErrors.value.day = "Day is required.";
  if (!selectedFile.value) validationErrors.value.file = "File upload is required.";

  // Stop if there are validation errors
  if (Object.keys(validationErrors.value).length > 0) return;

  const formData = {
    student_id: props.currentStudent.id,
    therapist_id: therapist_id.value, // Get selected therapist ID from dropdown
    year: selectedYear.value,
    month: selectedMonth.value,
    day: selectedDay.value,
    file: selectedFile.value,
    notes: notes.value
  };

  console.log("upload--", formData);
  emit('uploadReport', formData);
  // **Reset form fields after submission**
  therapist_id.value = "";
  selectedYear.value = new Date().getFullYear(); // Reset to current year
  selectedMonth.value = "January"; // Reset to default month
  selectedDay.value = "";
  selectedFile.value = null;
  notes.value = "";
};

</script>

<template>
  <!-- Modal -->
  <div v-if="isUploadModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md sm:w-2/3 md:w-1/2 lg:w-1/3 max-h-screen overflow-y-auto">
      <!-- Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">{{ reportName }}</h2>
        <button @click="emit('closeUploadModal')" class="text-gray-500 hover:text-gray-700 focus:outline-none">✖</button>
      </div>

      <!-- Upload Form -->
      <form @submit.prevent="uploadReport">
        <div class="mb-4">
          <label class="block text-gray-700">Therapist</label>
          <select v-model="therapist_id" class="w-full px-4 py-2 border rounded-lg">
            <option value="">Select a therapist</option>
            <option v-for="therapist in therapists" :key="therapist.id" :value="therapist.id">
              {{ therapist.first_name }} {{ therapist.last_name }}
            </option>
          </select>
          <p v-if="validationErrors.therapist_id" class="text-red-500 text-sm">
            {{ validationErrors.therapist_id }}
          </p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Select Year</label>
          <select v-model="selectedYear" class="w-full px-4 py-2 border rounded-lg">
            <option value="">Select a year</option>
            <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
          </select>
          <p v-if="validationErrors.year" class="text-red-500 text-sm">
            {{ validationErrors.year }}
          </p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Select Month</label>
          <select v-model="selectedMonth" class="w-full px-4 py-2 border rounded-lg">
            <option selected value="">Select a month</option>
            <option v-for="month in months" :key="month" :value="month">{{ month }}</option>
          </select>
          <p v-if="validationErrors.month" class="text-red-500 text-sm">
            {{ validationErrors.month }}
          </p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Select Day</label>
          <select v-model="selectedDay" class="w-full px-4 py-2 border rounded-lg">
            <option selected value="">Select a day</option>
            <option v-for="day in availableDays" :key="day" :value="day">{{ day }}</option>
          </select>
          <p v-if="validationErrors.day" class="text-red-500 text-sm">
            {{ validationErrors.day }}
          </p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Upload File</label>
          <input type="file" @change="handleFileInput" class="w-full px-4 py-2 border rounded-lg" />
          <p v-if="validationErrors.file" class="text-red-500 text-sm">
            {{ validationErrors.file }}
          </p>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Notes</label>
          <textarea v-model="notes" class="w-full px-4 py-2 border rounded-lg" rows="3"></textarea>
        </div>

        <div class="flex justify-end space-x-4">
          <button type="button" @click="emit('closeUploadModal')" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Upload</button>
        </div>
      </form>
    </div>
  </div>
</template>
