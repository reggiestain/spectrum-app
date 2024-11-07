<template>
  <header-component></header-component>
  <div class="dashboard-container h-screen flex">
    <Sidebar></Sidebar>
    <div class="p-8 flex-1 flex flex-col overflow-auto">
      <!-- Header Section -->
      <div class="flex justify-between items-center mb-8">
        <div>
          <h1 class="text-3xl font-bold">User Management</h1>
          <p class="text-gray-500 text-lg mt-1">
            The options below allow you to add users to existing or new schools & the ability to send invitations to individual or multiple users.
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
        <button @click="openAddUserModal" class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded-lg shadow">
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
          <input type="text" placeholder="School(s)" class="w-full px-4 py-2 border rounded-lg" />
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
      <div class="bg-white shadow overflow-hidden sm:rounded-lg flex-1 overflow-auto">
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
              <div class="relative inline-block text-left">
                <div>
                  <button
                    @click="toggleMenu(user.id)"
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
                  v-if="activeDropdown === user.id"
                  class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                >
                  <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <a href="#" @click="editUser(user.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Invite</a>
                    <a href="#" @click="editUser(user.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit</a>
                    <a href="#" @click="deleteUser(user.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Delete</a>
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
   <!-- Add User Modal -->
   <div v-if="isAddUserModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md sm:w-2/3 md:w-1/2 lg:w-1/3 max-h-screen overflow-y-auto">
          <h2 class="text-2xl font-bold mb-4">Add User</h2>
          <form @submit.prevent="submitAddUser">
            <div class="mb-4">
              <label class="block text-gray-700">First Name</label>
              <input v-model="newUser.firstName" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors.errors?.name" class="text-red-500 text-sm">{{ validationErrors.errors.name[0]}}</p>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700">Last Name</label>
              <input v-model="newUser.lastName" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors.errors?.surname" class="text-red-500 text-sm">{{ validationErrors.errors.surname[0] }}</p>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700">Email</label>
              <input v-model="newUser.email" type="email" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors.errors?.email" class="text-red-500 text-sm">{{ validationErrors.errors.email[0] ?? ""}}</p>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700">Phone</label>
              <input v-model="newUser.phone" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors.errors?.phone" class="text-red-500 text-sm">{{ validationErrors.errors.phone[0] }}</p>
            </div>
            <!-- School Dropdown -->
            <div class="mb-4">
              <label class="block text-gray-700">School</label>
              <select v-model="newUser.school_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select a school</option>
                <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.name }}</option>
              </select>
              <p v-if="validationErrors.errors?.school_id" class="text-red-500 text-sm">{{ validationErrors.errors.school_id[0] }}</p>
            </div>
            <!-- Role Dropdown -->
            <div class="mb-4">
              <label class="block text-gray-700">User Role</label>
              <select v-model="newUser.role_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select a role</option>
                <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
              </select>
              <p v-if="validationErrors.errors?.role_id" class="text-red-500 text-sm">{{ validationErrors.errors.role_id[0] }}</p>
            </div>
            <div class="flex justify-end space-x-4">
              <button @click="closeAddUserModal" type="button" class="bg-gray-200 px-4 py-2 rounded-lg shadow">Cancel</button>
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Edit User Modal -->
<div v-if="isEditUserModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
  <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
    <h2 class="text-2xl font-bold mb-4">Edit User</h2>
    <form @submit.prevent="submitEditUser">
      <div class="mb-4">
        <label class="block text-gray-700">First Name</label>
        <input v-model="currentUser.firstName" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors.errors?.name" class="text-red-500 text-sm">{{ validationErrors.errors?.name[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Last Name</label>
        <input v-model="currentUser.lastName" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors.errors?.surname" class="text-red-500 text-sm">{{ validationErrors.errors.surname[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input v-model="currentUser.email" type="email" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors.errors?.email" class="text-red-500 text-sm">{{ validationErrors.errors.email[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Phone</label>
        <input v-model="currentUser.phone" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors.errors?.phone" class="text-red-500 text-sm">{{ validationErrors.errors.phone[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">School</label>
        <select v-model="currentUser.school_id" class="w-full px-4 py-2 border rounded-lg">
          <option value="">Select a school</option>
          <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.name }}</option>
        </select>
        <p v-if="validationErrors.errors?.school_id" class="text-red-500 text-sm">{{ validationErrors.errors.school_id[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">User Role</label>
        <select v-model="currentUser.role_id" class="w-full px-4 py-2 border rounded-lg">
          <option value="">Select a role</option>
          <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
        </select>
        <p v-if="validationErrors.errors?.role_id" class="text-red-500 text-sm">{{ validationErrors.errors.role_id[0] }}</p>
      </div>
      <div class="flex justify-end space-x-4">
        <button @click="closeEditUserModal" type="button" class="bg-gray-200 px-4 py-2 rounded-lg shadow">Cancel</button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">Submit</button>
      </div>
    </form>
  </div>
</div>

</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useUserStore } from '../../stores/userStore';
import { useSchoolStore } from '../../stores/useSchoolStore';
import { useRoleStore } from '../../stores/useRoleStore';
import Sidebar from '../menu/Sidebar.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const userStore = useUserStore();
const schoolStore = useSchoolStore();
const roleStore = useRoleStore();

const users = ref([]);
const schools = ref([]);
const roles = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);
const validationErrors = ref({});
const activeDropdown = ref(null);
const isAddUserModalOpen = ref(false);
const newUser = ref({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  school_id: '',
  role_id: ''
});
const isEditUserModalOpen = ref(false);
const currentUser = ref({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  school_id: '',
  role_id: ''
});

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
// Fetch schools on modal open
const openAddUserModal = async () => {
  isAddUserModalOpen.value = true;
    await roleStore.fetchRoles(); // Fetch schools if not already loaded
    roles.value = roleStore.roles;
    await schoolStore.fetchSchools(); // Fetch schools if not already loaded
    schools.value = schoolStore.schools;
    console.log("school: ", schools.value)
};

const openEditUserModal = async (user) => {
  isEditUserModalOpen.value = true;
  // Pre-fill form with the selected user's data
  currentUser.value = {
    id:      user.id,
    firstName: user.name,
    lastName: user.surname,
    email: user.email,
    phone: user.phone,
    school_id: user.school_id,
    role_id: user.role_id
  };

  await roleStore.fetchRoles();
  roles.value = roleStore.roles;

  await schoolStore.fetchSchools();
  schools.value = schoolStore.schools;
};

const closeEditUserModal = () => {
  isEditUserModalOpen.value = false;
};

const submitEditUser = async () => {
  const userData = {
    name: currentUser.value.firstName,
    surname: currentUser.value.lastName,
    email: currentUser.value.email,
    phone: currentUser.value.phone,
    school_id: currentUser.value.school_id,
    role_id: currentUser.value.role_id
  };
  try {
    const data = await userStore.updateUser(currentUser.value.id, userData); // Call API to update user
    toast.success(data.message, {
        //position: toast.POSITION.TOP_CENTER,
        autoClose: 1000,
    });
    closeEditUserModal();
    fetchUsers(currentPage.value); // Reload the user list
    console.log("users: ",users)
  } catch (error) {
    if (error.response && error.response.status === 422) {
      validationErrors.value = error.response.data.errors;
    } else {
      console.error('An error occurred:', error);
    }
  }
};

const closeAddUserModal = () => {
  isAddUserModalOpen.value = false;
};

const submitAddUser = async () => {
  const userData = {
    name: newUser.value.firstName,
    surname: newUser.value.lastName,
    email: newUser.value.email,
    phone: newUser.value.phone,
    school_id: newUser.value.school_id,
    role_id: newUser.value.role_id,
    status: "Active"
  };

  try {
    // Call API to add a user
    await userStore.register(userData); // Assuming this is your method to add users to the system
    // Clear form
    newUser.value = {
      firstName: '',
      lastName: '',
      email: '',
      phone: '',
      schoolId: '' // Reset schoolId
    };
    toast.success("User created successfully.", {
        //position: toast.POSITION.TOP_CENTER,
        autoClose: 1000,
    });
    // Close modal
    closeAddUserModal();
    // Reload the users (pagination is managed here)
    fetchUsers(currentPage.value);
  } catch (error) {
    if (error.response && error.response.status === 422) {
      // Handle validation errors from the server
      const errors = error.response.data.errors;
      console.log(errors)
      validationErrors.value = errors;
    } else {
      // Handle other possible errors
      console.error('An error occurred:', error);
      validationErrors.value = error;
      console.log("TEST: ",validationErrors.value.errors)
    }
  }
};

const toggleMenu = (userId) => {
  if (activeDropdown.value === userId) {
    activeDropdown.value = null;
  } else {
    activeDropdown.value = userId;
  }
};

const editUser = (userId) => {
  const user = users.value.find(u => u.id === userId);
  openEditUserModal(user);
  
};

const deleteUser = async (userId, userData) => {
  try {
    const data = await userStore.deleteUser(userId);

    toast.success("User deleted successfully.", {
          //position: toast.POSITION.TOP_CENTER,
          autoClose: 1000,
      });
     // Reload the users (pagination is managed here)
     fetchUsers(currentPage.value);
    } catch (error) {
    if (error.response && error.response.status === 500) {
      // Handle validation errors from the server
      const errors = error.response.data.errors;
      console.log(errors)
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
  fetchUsers();
});
</script>

