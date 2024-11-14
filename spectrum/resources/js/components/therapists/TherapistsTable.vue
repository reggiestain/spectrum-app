<template>
  <header-component></header-component>
  <div class="dashboard-container h-screen flex">
    <Sidebar></Sidebar>
    <div class="p-8 flex-1 flex flex-col overflow-auto">
      <!-- Header Section -->
      <div class="flex justify-between items-center mb-8">
        <div>
          <h1 class="text-3xl font-bold">Therapist Management</h1>
          <p class="text-gray-500 text-lg mt-1">
            The options below allow you to add therapists to existing or new schools.
          </p>
        </div>
        <!-- Stats Cards -->
        <div class="flex space-x-4">
          <div class="bg-white p-4 shadow rounded-lg text-center">
            <h2 class="text-2xl font-bold">5249</h2>
            <p class="text-gray-500">Active therapists</p>
          </div>
          <div class="bg-white p-4 shadow rounded-lg text-center">
            <h2 class="text-2xl font-bold">395</h2>
            <p class="text-gray-500">Idle therapists</p>
          </div>
          <div class="bg-white p-4 shadow rounded-lg text-center">
            <h2 class="text-2xl font-bold">676</h2>
            <p class="text-gray-500">Archived therapists</p>
          </div>
        </div>
      </div>

      <!-- Actions Buttons -->
      <div class="flex items-center mb-4 space-x-4">
        <button @click="openAddtherapistModal" class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded-lg shadow">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <path d="M12 4v16m8-8H4"/>
          </svg>
          <span>ADD</span>
        </button>

        <button class="bg-gray-200 text-black px-4 py-2 rounded-lg shadow">ACTIVE</button>
        <button class="bg-gray-200 text-black px-4 py-2 rounded-lg shadow">ARCHIVED</button>
      </div>

      <!-- Filters Section -->
      <div class="grid grid-cols-5 gap-4 mb-4">
        <div class="col-span-1">
          <input type="text" placeholder="Therapist" class="w-full px-4 py-2 border rounded-lg" />
        </div>
        <div class="col-span-1">
          <input type="text" placeholder="School(s)" class="w-full px-4 py-2 border rounded-lg" />
        </div>
        <div class="col-span-1">
          <input type="text" placeholder="Status" class="w-full px-4 py-2 border rounded-lg" />
        </div>
        <div class="col-span-1">
          <input type="text" placeholder="therapist Role" class="w-full px-4 py-2 border rounded-lg" />
        </div>
        <div class="col-span-1 flex justify-end">
          <button class="bg-red-500 text-white px-4 py-2 rounded-lg shadow">EXPORT</button>
        </div>
      </div>

      <!-- therapists Table -->
      <div class="bg-white shadow overflow-hidden sm:rounded-lg flex-1 overflow-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">therapist</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">School(s)</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Position</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Specialization</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
              <th class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="therapist in therapists" :key="therapist.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
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
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ therapist.first_name }} {{ therapist.last_name }}</div>
                    <div class="text-sm text-gray-500">{{ therapist.email }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ therapist.last_name }}</div>
              </td>             
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ therapist.specialization }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ therapist.category?.name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ therapist.phone }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Active
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ therapist.created_at }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="relative inline-block text-left">
                <div>
                  <button
                    @click="toggleMenu(therapist.id)"
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                  >
                  <!-- Vertical Ellipsis Icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 5a2 2 0 110-4 2 2 0 010 4zm0 5a2 2 0 110-4 2 2 0 010 4z" />
                  </svg>
                  </button>
                </div>
                <div
                  v-if="activeDropdown === therapist.id"
                  class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                >
                  <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <a href="#" @click="editTherapist(therapist.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Invite</a>
                    <a href="#" @click="editTherapist(therapist.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit</a>
                    <a href="#" @click="deleteTherapist(therapist.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Delete</a>                  
                  </div>
                </div>
              </div>
            </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-4 flex justify-center space-x-4">
        <button
          @click="prevPage"
          :disabled="currentPage <= 1"
          class="px-4 py-2 rounded-lg"
          :class="{
            'bg-blue-500 text-white hover:bg-blue-600': currentPage > 1,
            'bg-gray-200 text-gray-400 cursor-not-allowed': currentPage <= 1
          }"
        >
          Previous
        </button>
        
        <span class="mx-2">Page {{ currentPage }} of {{ totalPages }}</span>
        
        <button
          @click="nextPage"
          :disabled="currentPage >= totalPages"
          class="px-4 py-2 rounded-lg"
          :class="{
            'bg-blue-500 text-white hover:bg-blue-600': currentPage < totalPages,
            'bg-gray-200 text-gray-400 cursor-not-allowed': currentPage >= totalPages
          }"
        >
          Next
        </button>
      </div>
    </div>
  </div>
   <!-- Add therapist Modal -->
   <div v-if="isAddtherapistModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md sm:w-2/3 md:w-1/2 lg:w-1/3 max-h-screen overflow-y-auto">
          <h2 class="text-2xl font-bold mb-4">Add therapist</h2>
          <form @submit.prevent="submitAddTherapist">
            <div class="mb-4">
              <label class="block text-gray-700">First Name</label>
              <input v-model="newTherapist.firstName" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors?.first_name" class="text-red-500 text-sm">{{ validationErrors.first_name[0]}}</p>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700">Last Name</label>
              <input v-model="newTherapist.lastName" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors?.last_name" class="text-red-500 text-sm">{{ validationErrors.last_name[0] }}</p>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700">Email</label>
              <input v-model="newTherapist.email" type="email" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors?.email" class="text-red-500 text-sm">{{ validationErrors.email[0] ?? ""}}</p>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700">Phone</label>
              <input v-model="newTherapist.phone" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors?.phone" class="text-red-500 text-sm">{{ validationErrors.phone[0] }}</p>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700">Position</label>
              <input v-model="newTherapist.specialization" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors?.specialization" class="text-red-500 text-sm">{{ validationErrors.specialization[0] }}</p>
            </div>
            <!-- cat Dropdown -->
            <div class="mb-4">
              <label class="block text-gray-700">Specialization</label>
              <select v-model="newTherapist.therapy_category_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select a therapy category</option>
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
              </select>
              <p v-if="validationErrors.errors?.therapy_category_id" class="text-red-500 text-sm">{{ validationErrors.errors.therapy_category_id[0] }}</p>
            </div>
            <!-- School Dropdown -->
            <div class="mb-4">
              <label class="block text-gray-700">School</label>
              <select v-model="newTherapist.school_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select a school</option>
                <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.name }}</option>
              </select>
              <p v-if="validationErrors.errors?.school_id" class="text-red-500 text-sm">{{ validationErrors.errors.school_id[0] }}</p>
            </div>
            <div class="flex justify-end space-x-4">
              <button @click="closeAddtherapistModal" type="button" class="bg-gray-200 px-4 py-2 rounded-lg shadow">Cancel</button>
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Edit therapist Modal -->
<div v-if="isEditTherapistModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md sm:w-2/3 md:w-1/2 lg:w-1/3 max-h-screen overflow-y-auto">
    <h2 class="text-2xl font-bold mb-4">Edit therapist</h2>
    <form @submit.prevent="submitEditTherapist">
      <div class="mb-4">
        <label class="block text-gray-700">First Name</label>
        <input v-model="currentTherapist.firstName" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors.errors?.first_name" class="text-red-500 text-sm">{{ validationErrors.first_name[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Last Name</label>
        <input v-model="currentTherapist.lastName" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors.errors?.last_name" class="text-red-500 text-sm">{{ validationErrors.errors.last_name[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input v-model="currentTherapist.email" type="email" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors.errors?.email" class="text-red-500 text-sm">{{ validationErrors.email[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Phone</label>
        <input v-model="currentTherapist.phone" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors.errors?.phone" class="text-red-500 text-sm">{{ validationErrors.phone[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Position</label>
        <input v-model="currentTherapist.specialization" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors.errors?.specialization" class="text-red-500 text-sm">{{ validationErrors.specialization[0] }}</p>
      </div>
      <!-- cat Dropdown -->
      <div class="mb-4">
        <label class="block text-gray-700">Specialization</label>
        <select v-model="currentTherapist.therapy_category_id" class="w-full px-4 py-2 border rounded-lg">
          <option value="">Select a therapy category</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
        </select>
        <p v-if="validationErrors.errors?.therapy_category_id" class="text-red-500 text-sm">{{ validationErrors.errors.therapy_category_id[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">School</label>
        <select v-model="currentTherapist.school_id" class="w-full px-4 py-2 border rounded-lg">
          <option value="">Select a school</option>
          <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.name }}</option>
        </select>
        <p v-if="validationErrors.errors?.school_id" class="text-red-500 text-sm">{{ validationErrors.errors.school_id[0] }}</p>
      </div>
      <div class="flex justify-end space-x-4">
        <button @click="closeEditTherapistModal" type="button" class="bg-gray-200 px-4 py-2 rounded-lg shadow">Cancel</button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">Submit</button>
      </div>
    </form>
  </div>
</div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import { useTherapistStore } from '../../stores/therapistStore';
import { useSchoolStore } from '../../stores/useSchoolStore';
import { useTherapyCategoriesStore } from '../../stores/therapyCategoriesStore';
import Sidebar from '../menu/Sidebar.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const therapistStore = useTherapistStore();
const schoolStore = useSchoolStore();
const therapistCategoryStore = useTherapyCategoriesStore();

const therapists = ref([]);
const schools = ref([]);
const categories = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);
const validationErrors = ref({});
const activeDropdown = ref(null);
const isAddtherapistModalOpen = ref(false);
const newTherapist = ref({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  specialization: '',
  school_id: '',
  therapy_category_id: ''
});
const isEditTherapistModalOpen = ref(false);
const currentTherapist = ref({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  specialization: '',
  school_id: '',
  therapy_category_id: ''
});

const fetchTherapists = async (page = 1) => {
  await therapistStore.fetchTherapists(page);
  therapists.value = therapistStore.therapists;
  currentPage.value = therapistStore.currentPage;
  totalPages.value = Math.ceil(therapistStore.total / therapistStore.perPage);
};

const prevPage = () => {
  if (currentPage.value > 1) {
    fetchTherapists(currentPage.value - 1);
  }
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    fetchTherapists(currentPage.value + 1);
  }
};
// Fetch schools on modal open
const openAddtherapistModal = async () => {
  isAddtherapistModalOpen.value = true;
    await schoolStore.fetchSchools(); // Fetch schools if not already loaded
    schools.value = schoolStore.schools;
    await therapistCategoryStore.fetchTherapyCategories()
    categories.value = therapistCategoryStore.categories;
};

const openEditTherapistModal = async (therapist) => {
  isEditTherapistModalOpen.value = true;
  // Pre-fill form with the selected therapist's data
  currentTherapist.value = {
    id:      therapist.id,
    firstName: therapist.first_name,
    lastName: therapist.last_name,
    email: therapist.email,
    phone: therapist.phone,
    specialization: therapist.specialization,
    school_id: therapist.school_id,
    therapy_category_id: therapist.therapy_category_id
  };

  await schoolStore.fetchSchools();
    schools.value = schoolStore.schools;
  await therapistCategoryStore.fetchTherapyCategories()
    categories.value = therapistCategoryStore.categories;
};

const closeEditTherapistModal = () => {
  isEditTherapistModalOpen.value = false;
};

const submitEditTherapist = async () => {
  console.log("Field: ",currentTherapist.therapy_category_id)
  const therapistData = {
    first_name: currentTherapist.value.firstName,
    last_name: currentTherapist.value.lastName,
    email: currentTherapist.value.email,
    phone: currentTherapist.value.phone,
    specialization: currentTherapist.value.specialization,
    school_id: currentTherapist.value.school_id,
    therapy_category_id: currentTherapist.therapy_category_id
  };
  //console.log("test",currentTherapist)
  try {
    const data = await therapistStore.updateTherapist(currentTherapist.value.id, therapistData); // Call API to update therapist
    toast.success(data.message, {
        //position: toast.POSITION.TOP_CENTER,
        autoClose: 1000,
    });
    closeEditTherapistModal();
    fetchTherapists(currentPage.value); // Reload the therapist list
    console.log("therapists: ",therapists)
  } catch (error) {
    if (error.response && error.response.status === 422) {
      validationErrors.value = error.response.data.errors;
    } else {
      console.error('An error occurred:', error);
    }
  }
};

const closeAddtherapistModal = () => {
  isAddtherapistModalOpen.value = false;
};

const submitAddTherapist = async () => {

  const therapistData = {
    first_name: newTherapist.value.firstName,
    last_name: newTherapist.value.lastName,
    email: newTherapist.value.email,
    phone: newTherapist.value.phone,
    specialization: newTherapist.value.specialization,
    school_id: newTherapist.value.school_id,
    therapy_category_id: newTherapist.value.therapy_category_id
  };

  try {
    // Call API to add a therapist
    await therapistStore.createTherapist(therapistData); // Assuming this is your method to add therapists to the system
    // Clear form
    newTherapist.value = {
      firstName: '',
      lastName: '',
      email: '',
      phone: '',
      schoolId: '',
      specialization: '',
      school_id: '',
      therapy_category_id: ''
    };
    toast.success("therapist created successfully.", {
        //position: toast.POSITION.TOP_CENTER,
        autoClose: 1000,
    });
    // Close modal
    closeAddtherapistModal();
    // Reload the therapists (pagination is managed here)
    fetchTherapists(currentPage.value);
  } catch (error) {
    if (error.response && error.response.status === 400) {
      // Handle validation errors from the server
      console.log("Error: ",error.response.status)
      const errors = error.response.data.errors;
      
      validationErrors.value = errors;
      console.log(validationErrors.value)
    } else {
      // Handle other possible errors
      console.error('An error occurred:', error);
      validationErrors.value = error;
      console.log("TEST: ",validationErrors.value.errors)
    }
  }
};

const toggleMenu = (therapistId) => {
  if (activeDropdown.value === therapistId) {
    activeDropdown.value = null;
  } else {
    activeDropdown.value = therapistId;
  }
};

const editTherapist = (therapistId) => {
  const therapist = therapists.value.find(u => u.id === therapistId);
  openEditTherapistModal(therapist);
  
};

const deleteTherapist = async (therapistId, therapistData) => {
  try {
    const data = await therapistStore.deleteTherapist(therapistId);

    toast.success("therapist deleted successfully.", {
          //position: toast.POSITION.TOP_CENTER,
          autoClose: 1000,
      });
     // Reload the therapists (pagination is managed here)
     fetchTherapists(currentPage.value);
    } catch (error) {
    if (error.response && error.response.status === 500) {
      // Handle validation errors from the server
      const errors = error.response.data.errors;
      validationErrors.value = errors;
    } else {
      // Handle other possible errors
      //console.error('An error occurred:', error);
      //validationErrors.value = error;
      //console.log("TEST: ",validationErrors.value.errors)
    }
  }
};

onMounted(() => {
  fetchTherapists();
});
</script>

