<template>
  <header-component></header-component>
  <div class="dashboard-container">
  <Sidebar></Sidebar>
  <div class="p-8">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-3xl font-bold">User Management</h1>
        <p class="text-gray-500 mt-1">
          The options below allow you to add users to existing or new organizations & the ability to send invitations to individual or multiple users.
        </p>
      </div>
      <!-- Stats Cards -->
      <div class="flex space-x-4">
        <div class="bg-white p-4 shadow rounded-lg text-center">
          <h2 class="text-2xl font-bold">5249</h2>
          <p class="text-gray-500">Active users</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
          <h2 class="text-2xl font-bold">395</h2>
          <p class="text-gray-500">Idle users</p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
          <h2 class="text-2xl font-bold">676</h2>
          <p class="text-gray-500">Archived users</p>
        </div>
      </div>
    </div>

    <!-- Actions Buttons -->
    <div class="flex items-center mb-4 space-x-4">
      <button class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded-lg shadow">
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
        <input type="text" placeholder="User" class="w-full px-4 py-2 border rounded-lg" />
      </div>
      <div class="col-span-1">
        <input type="text" placeholder="Organization(s)" class="w-full px-4 py-2 border rounded-lg" />
      </div>
      <div class="col-span-1">
        <input type="text" placeholder="Status" class="w-full px-4 py-2 border rounded-lg" />
      </div>
      <div class="col-span-1">
        <input type="text" placeholder="User Role" class="w-full px-4 py-2 border rounded-lg" />
      </div>
      <div class="col-span-1 flex justify-end">
        <button class="bg-red-500 text-white px-4 py-2 rounded-lg shadow">EXPORT</button>
      </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">School(s)</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User Role</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Last Login</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Invited</th>
            <th class="px-6 py-3"></th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="user in users" :key="user.id">
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
                  <div class="text-sm font-medium text-gray-900">{{ user.name }} {{ user.surname }}</div>
                  <div class="text-sm text-gray-500">{{ user.email }}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ user.school.name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                Active
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ user.role.name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ user.lastlogin }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ user.created_at }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="#" class="text-indigo-600 hover:text-indigo-900">Details</a>
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
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useUserStore } from '../../stores/userStore';
import Sidebar from '../menu/Sidebar.vue';

const userStore = useUserStore();

const users = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);

const fetchUsers = async (page = 1) => {
  await userStore.fetchUsers(page);
  users.value = userStore.users;
  currentPage.value = userStore.currentPage;
  totalPages.value = Math.ceil(userStore.totalUsers / userStore.perPage);
};

const prevPage = () => {
  if (currentPage.value > 1) {
    fetchUsers(currentPage.value - 1);
  }
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    fetchUsers(currentPage.value + 1);
  }
};

onMounted(() => {
  fetchUsers();
});
</script>

<style scoped>

</style>
