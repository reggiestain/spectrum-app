<template>
  <div class="p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Therapy Reports</h2>
    <p class="mb-6 text-gray-600">Below is a list of attached daily reports.</p>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg flex-1 overflow-hidden">
      <!-- Wrapper for vertical scrolling -->
      <div class="overflow-y-auto max-h-[500px]">
        <!-- Wrapper for horizontal scrolling -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Report Title
                </th>
                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Therapist
                </th>
                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Notes
                </th>
                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Date Generated
                </th>
                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="report in studentReports" :key="report.id" class="hover:bg-gray-100">
                <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ report.report_title }}</td>
                <td class="py-4 px-6 text-sm text-gray-500">{{ report.therapist?.first_name+" "+report.therapist?.last_name || 'N/A' }}</td>
                <td class="py-4 px-6 text-sm text-gray-500">{{ report.notes || 'No notes' }}</td>
                <td class="py-4 px-6 text-sm text-gray-500">{{ report.report_date }}</td>
                <td class="py-4 px-6 text-sm text-gray-500">
                  <button class="text-blue-500 hover:underline" @click="previewReport(report.file_path)">
                    View Report
                  </button>
                </td>
              </tr>
              <tr v-if="!studentReports.length">
                <td colspan="5" class="text-center py-4 text-gray-500">No reports found.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Document Viewer Modal (PDF & Word) -->
    <div v-if="docPreview" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 h-4/5 flex flex-col">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Report Preview</h3>
          <button @click="closePreview" class="text-red-500 hover:text-red-700 text-lg">✖</button>
        </div>
        <iframe :src="docPreview" class="w-full flex-1 border rounded-lg"></iframe>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { useStudentStore } from "@/stores/studentStore";

const props = defineProps(["studentId"]);
const studentStore = useStudentStore();
const studentReports = ref([]);
const docPreview = ref(null);

// Fetch Reports
const getReport = async () => {
  if (!props.studentId) return;
  const reports = await studentStore.getStudentReports(props.studentId);
  studentReports.value = reports.data || [];
};

const previewReport = (filePath) => {
  if (!filePath) {
    alert("File not available");
    return;
  }

  // Extract the file extension from the file path
  const fileType = filePath.split('.').pop().toLowerCase();

  let docPreview = '';

  if (fileType === "pdf") { 
    // Directly preview PDF files
    docPreview = filePath;
  } else if (fileType === "doc" || fileType === "docx") {
    // Preview DOC/DOCX files using Microsoft Office's online viewer
    const encodedUrl = encodeURIComponent(`${window.location.origin}/${filePath}`);
    docPreview = `https://view.officeapps.live.com/op/embed.aspx?src=${encodedUrl}`;
  } else {
    alert("Preview not supported for this file type.");
    return;
  }

  // Open the preview in a new tab or embed in an iframe (based on your app's requirements)
  window.open(docPreview, '_blank');
};


// Close Preview
const closePreview = () => {
  docPreview.value = null;
};

// Fetch reports when mounted
onMounted(getReport);

// Re-fetch reports if studentId changes
watch(() => props.studentId, getReport);
</script>

<style scoped>
/* Add any additional styling if needed */
</style>
