<template>
  <header-component></header-component>
  <div class="dashboard-container h-screen flex">
    <Sidebar></Sidebar>
    <div class="p-8 flex-1 flex flex-col overflow-auto">
      <!-- Header Section -->
      <div class="flex justify-between items-center mb-8">
        <div>
          <h1 class="text-3xl font-bold">Students Management</h1>
          <p class="text-gray-500 text-lg mt-1">
            The options below allow you to add students to existing or new schools.
          </p>
        </div>
        <!-- Stats Cards -->
        <div class="flex space-x-4">
          <div class="bg-white p-4 shadow rounded-lg text-center">
            <h2 class="text-2xl font-bold">5249</h2>
            <p class="text-gray-500">Active Students</p>
          </div>
          <div class="bg-white p-4 shadow rounded-lg text-center">
            <h2 class="text-2xl font-bold">395</h2>
            <p class="text-gray-500">Idle Students</p>
          </div>
          <div class="bg-white p-4 shadow rounded-lg text-center">
            <h2 class="text-2xl font-bold">676</h2>
            <p class="text-gray-500">Archived Students</p>
          </div>
        </div>
      </div>

      <!-- Actions Buttons -->
      <div class="flex items-center mb-4 space-x-4">
        <button @click="openAddStudentModal" class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded-lg shadow">
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
          <input type="text" placeholder="Student" class="w-full px-4 py-2 border rounded-lg" />
        </div>
        <div class="col-span-1">
          <input type="text" placeholder="School(s)" class="w-full px-4 py-2 border rounded-lg" />
        </div>
        <div class="col-span-1">
          <input type="text" placeholder="Status" class="w-full px-4 py-2 border rounded-lg" />
        </div>
        <div class="col-span-1">
          <input type="text" placeholder="Student Role" class="w-full px-4 py-2 border rounded-lg" />
        </div>
        <div class="col-span-1 flex justify-end">
          <button class="bg-red-500 text-white px-4 py-2 rounded-lg shadow">EXPORT</button>
        </div>
      </div>

      <!-- Students Table -->
      <div class="bg-white shadow overflow-hidden sm:rounded-lg flex-1 overflow-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">School(s)</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date of birth</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Condition</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Parent</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Class</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Therapist(s)</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teacher(s)</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
              <th class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="student in students" :key="student.id">
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
                    <div class="text-sm font-medium text-gray-900">{{ student.first_name }} {{ student.last_name }}</div>
                    <div class="text-sm text-gray-500">{{ student.email }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ student.school.name }}</div>
              </td>             
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ student.birth_date }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ student.condition }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ student.parent?.name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ student.class?.name }}</td>    
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ student.therapist?.first_name }} {{ student.therapist?.last_name }}</td>          
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ student.teacher?.first_name }} {{ student.teacher?.last_name }}</td>
              <!--<td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Active
                </span>
              </td>-->
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ student.created_at }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="relative inline-block text-left">
                <div>
                  <button
                    @click="toggleMenu(student.id)"
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
                  v-if="activeDropdown === student.id"
                  class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                >
                  <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <a href="#" @click="editStudent(student.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Invite</a>
                    <a href="#" @click="editStudent(student.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit</a>
                    <a href="#" @click="deleteStudent(student.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Delete</a>                  
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
   <!-- Add Student Modal -->
   <div v-if="isAddStudentModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
          <h2 class="text-2xl font-bold mb-4">Add Student</h2>
          <form @submit.prevent="submitAddStudent">
            <div class="mb-4">
              <label class="block text-gray-700">First Name</label>
              <input v-model="newStudent.firstName" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors?.first_name" class="text-red-500 text-sm">{{ validationErrors.first_name[0]}}</p>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700">Last Name</label>
              <input v-model="newStudent.lastName" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors?.last_name" class="text-red-500 text-sm">{{ validationErrors.last_name[0] }}</p>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700">Date of birth</label>
              <input v-model="newStudent.birth_date" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors?.birth_date" class="text-red-500 text-sm">{{ validationErrors.birth_date[0] }}</p>
            </div>    
            <div class="mb-4">
              <label class="block text-gray-700">Condition</label>
              <input v-model="newStudent.condition" type="text" class="w-full px-4 py-2 border rounded-lg" />
              <p v-if="validationErrors?.condition" class="text-red-500 text-sm">{{ validationErrors.condition[0] ?? ""}}</p>
            </div>
           
            <!-- Class Dropdown -->
            <div class="mb-4">
              <label class="block text-gray-700">Class</label>
              <select v-model="newStudent.neuro_class_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select a class</option>
                <option v-for="c in clases" :key="c.id" :value="c.id">{{ c.name }}</option>
              </select>
              <p v-if="validationErrors?.neuro_class_id" class="text-red-500 text-sm">{{ validationErrors.neuro_class_id[0] }}</p>
            </div>
            <!-- Parent Dropdown -->
            <div class="mb-4">
              <label class="block text-gray-700">Parent</label>
              <select v-model="newStudent.teacher_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select a parent</option>
                <option v-for="parent in parents" :key="parent.id" :value="parent.id">{{ parent.first_name+""+parent.last_name }}</option>
              </select>
              <p v-if="validationErrors?.parent_id" class="text-red-500 text-sm">{{ validationErrors.parent_id[0] }}</p>
            </div>
            <!-- Teacher Dropdown -->
            <div class="mb-4">
              <label class="block text-gray-700">Teacher</label>
              <select v-model="newStudent.teacher_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select a Teacher</option>
                <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">{{ teacher.first_name+" "+teacher.last_name }}</option>
              </select>
              <p v-if="validationErrors?.teacher_id" class="text-red-500 text-sm">{{ validationErrors.teacher_id[0] }}</p>
            </div>
            <!-- Therapist Dropdown -->
            <div class="mb-4">
              <label class="block text-gray-700">Therapist</label>
              <select v-model="newStudent.therapist_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select a therapist</option>
                <option v-for="therapist in therapists" :key="therapist.id" :value="therapist.id">{{ therapist.first_name+" "+therapist.last_name }}</option>
              </select>
              <p v-if="validationErrors?.therapist_id" class="text-red-500 text-sm">{{ validationErrors.therapist_id[0] }}</p>
            </div>
            <!-- School Dropdown -->
            <div class="mb-4">
              <label class="block text-gray-700">School</label>
              <select v-model="newStudent.school_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select a school</option>
                <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.name }}</option>
              </select>
              <p v-if="validationErrors?.school_id" class="text-red-500 text-sm">{{ validationErrors.school_id[0] }}</p>
            </div>
            <div class="flex justify-end space-x-4">
              <button @click="closeAddStudentModal" type="button" class="bg-gray-200 px-4 py-2 rounded-lg shadow">Cancel</button>
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Edit Student Modal -->
  <div v-if="isEditStudentModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
  <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
    <h2 class="text-2xl font-bold mb-4">Edit Student</h2>
    <form @submit.prevent="submitEditStudent">
      <div class="mb-4">
        <label class="block text-gray-700">First Name</label>
        <input v-model="currentStudent.firstName" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors?.first_name" class="text-red-500 text-sm">{{ validationErrors.first_name[0]}}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Last Name</label>
        <input v-model="currentStudent.lastName" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors?.last_name" class="text-red-500 text-sm">{{ validationErrors.last_name[0] }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Condition</label>
        <input v-model="currentStudent.condition" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors?.condition" class="text-red-500 text-sm">{{ validationErrors.condition[0] ?? ""}}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Date of birth</label>
        <input v-model="currentStudent.birth_date" type="text" class="w-full px-4 py-2 border rounded-lg" />
        <p v-if="validationErrors?.birth_date" class="text-red-500 text-sm">{{ validationErrors.birth_date[0] }}</p>
      </div>    
      <!-- Class Dropdown -->
      <div class="mb-4">
        <label class="block text-gray-700">Class</label>
        <select v-model="currentStudent.neuro_class_id" class="w-full px-4 py-2 border rounded-lg">
          <option value="">Select a class</option>
          <option v-for="c in clases" :key="c.id" :value="c.id">{{ c.name }}</option>
        </select>
        <p v-if="validationErrors?.neuro_class_id" class="text-red-500 text-sm">{{ validationErrors.neuro_class_id[0] }}</p>
      </div>
      <!-- Parent Dropdown -->
      <div class="mb-4">
        <label class="block text-gray-700">Parent</label>
        <select v-model="currentStudent.parent_id" class="w-full px-4 py-2 border rounded-lg">
          <option value="">Select a parent</option>
          <option v-for="parent in parents" :key="parent.id" :value="parent.id">{{ parent.first_name+""+parent.last_name }}</option>
        </select>
        <p v-if="validationErrors?.parent_id" class="text-red-500 text-sm">{{ validationErrors.parent_id[0] }}</p>
      </div>
      <!-- Teacher Dropdown -->
      <div class="mb-4">
        <label class="block text-gray-700">Teacher</label>
        <select v-model="currentStudent.teacher_id" class="w-full px-4 py-2 border rounded-lg">
          <option value="">Select a Teacher</option>
          <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">{{ teacher.first_name+" "+teacher.last_name }}</option>
        </select>
        <p v-if="validationErrors?.teacher_id" class="text-red-500 text-sm">{{ validationErrors.teacher_id[0] }}</p>
      </div>
      <!-- Therapist Dropdown -->
      <div class="mb-4">
        <label class="block text-gray-700">Therapist</label>
        <select v-model="currentStudent.therapist_id" class="w-full px-4 py-2 border rounded-lg">
          <option value="">Select a therapist</option>
          <option v-for="therapist in therapists" :key="therapist.id" :value="therapist.id">{{ therapist.first_name+" "+therapist.last_name }}</option>
        </select>
        <p v-if="validationErrors?.therapist_id" class="text-red-500 text-sm">{{ validationErrors.therapist_id[0] }}</p>
      </div>
      <!-- School Dropdown -->
      <div class="mb-4">
        <label class="block text-gray-700">School</label>
        <select v-model="currentStudent.school_id" class="w-full px-4 py-2 border rounded-lg">
          <option value="">Select a school</option>
          <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.name }}</option>
        </select>
        <p v-if="validationErrors?.school_id" class="text-red-500 text-sm">{{ validationErrors.school_id[0] }}</p>
      </div>
      <div class="flex justify-end space-x-4">
        <button @click="closeEditStudentModal" type="button" class="bg-gray-200 px-4 py-2 rounded-lg shadow">Cancel</button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">Submit</button>
      </div>
    </form>
  </div>
</div>

</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useStudentStore } from '../../stores/studentStore';
import { useSchoolStore } from '../../stores/useSchoolStore';
import { useTherapistStore } from '../../stores/therapistStore';
import { useParentStore } from '../../stores/parentStore';
import { useTeacherStore } from '../../stores/teacherStore';
import { useClasStore } from '../../stores/clasStore';
import Sidebar from '../menu/Sidebar.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const studentStore = useStudentStore();
const schoolStore = useSchoolStore();
const therapistStore = useTherapistStore();
const parentStore = useParentStore();
const clasTypeStore = useClasStore();
const teacherStore = useTeacherStore();

const students = ref([]);
const schools = ref([]);
const parents = ref([]);
const teachers = ref([]);
const clases = ref([]);
const therapists = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);
const validationErrors = ref({});
const activeDropdown = ref(null);
const isAddStudentModalOpen = ref(false);
const newStudent = ref({
  firstName: '',
  lastName: '',
  birth_date: '',
  condition: '',
  neuro_class_id: '',
  school_id: '',
  teacher_id: '',
  therapy_id: '',
});
const isEditStudentModalOpen = ref(false);
const currentStudent = ref({
  firstName: '',
  lastName: '',
  birth_date: '',
  condition: '',
  neuro_class_id: '',
  school_id: '',
  teacher_id: '',
  therapist_id: ''
});

const fetchStudents = async (page = 1) => {
  await studentStore.fetchStudents(page);
  students.value = studentStore.students;
  currentPage.value = studentStore.currentPage;
  totalPages.value = Math.ceil(studentStore.total / studentStore.perPage);
};

const prevPage = () => {
  if (currentPage.value > 1) {
    fetchStudents(currentPage.value - 1);
  }
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    fetchStudents(currentPage.value + 1);
  }
};
// Fetch schools on modal open
const openAddStudentModal = async () => {
  isAddStudentModalOpen.value = true;
    await teacherStore.fetchTeachers()
    teachers.value = teacherStore.teachers;
    console.log('teach: ',teachers.value);
    await parentStore.fetchParents()
    parents.value = parentStore.parents;
    await schoolStore.fetchSchools(); // Fetch schools if not already loaded
    schools.value = schoolStore.schools;
    await therapistStore.fetchTherapists()
    therapists.value = therapistStore.therapists;
    await clasTypeStore.fetchClas()
    clases.value = clasTypeStore.clas;
}  

const openEditStudentModal = async (Student) => {
  isEditStudentModalOpen.value = true;
  // Pre-fill form with the selected Student's data
  currentStudent.value = {
    id:      Student.id,
    firstName: Student.first_name,
    lastName: Student.last_name,
    birth_date: Student.birth_date,
    condition: Student.condition,
    neuro_class_id: Student.neuro_class_id,
    school_id: Student.school_id,
    teacher_id: Student.teacher_id,
    therapist_id: Student.therapist_id
  };

  await teacherStore.fetchTeachers()
    teachers.value = teacherStore.teachers;
    console.log('teach: ',teachers.value);
    await parentStore.fetchParents()
    parents.value = parentStore.parents;
    await schoolStore.fetchSchools(); // Fetch schools if not already loaded
    schools.value = schoolStore.schools;
    await therapistStore.fetchTherapists()
    therapists.value = therapistStore.therapists;
    await clasTypeStore.fetchClas()
    clases.value = clasTypeStore.clas;
};

const closeEditStudentModal = () => {
  isEditStudentModalOpen.value = false;
};

const submitEditStudent = async () => {
  const StudentData = {
    first_name: currentStudent.value.firstName,
    last_name: currentStudent.value.lastName,
    birth_date: currentStudent.value.birth_date,
    condition: currentStudent.value.condition,
    neuro_class_id: currentStudent.value.neuro_class_id,
    school_id: currentStudent.value.school_id,
    teacher_id: currentStudent.value.teacher_id,
    therapist_id: currentStudent.value.therapist_id
  };
  try {
    const data = await studentStore.updateStudent(currentStudent.value.id, StudentData); // Call API to update Student
    console.log("test-4-5: ",data);
    toast.success(data.message, {
        //position: toast.POSITION.TOP_CENTER,
        autoClose: 1000,
    });
    closeEditStudentModal();
    fetchStudents(currentPage.value); // Reload the Student list
    console.log("Students: ",students)
  } catch (error) {
    if (error.response && error.response.status === 422) {
      validationErrors.value = error.response.data.errors;
    } else {
      console.error('An error occurred:', error);
    }
  }
};

const closeAddStudentModal = () => {
  isAddStudentModalOpen.value = false;
};

const submitAddStudent = async () => {
  
  const StudentData = {
    first_name: newStudent.value.firstName,
    last_name: newStudent.value.lastName,
    birth_date: newStudent.value.birth_date,
    school_id: newStudent.value.school_id,
    condition: newStudent.value.condition,
    parent_id: newStudent.value.parent_id,
    therapist_id: newStudent.value.therapist_id,
    teacher_id: currentStudent.value.teacher_id,
    neuro_class_id: newStudent.value.neuro_class_id, // Ensure this is correct
  };

  try {
    // Call API to add a Student
    await studentStore.addStudent(StudentData); // Assuming this is your method to add Students to the system
    // Clear form
    newStudent.value = {
      firstName: '',
      lastName: '',
      birth_date: '',
      school_id: '',
      condition: '',
      parent_id: '',
      teacher_id: '',
      therapist_id: '',
      neuro_class_id: ''
    };
    toast.success("Student created successfully.", {
        //position: toast.POSITION.TOP_CENTER,
        autoClose: 1000,
    });
    // Close modal
    closeAddStudentModal();
    // Reload the Students (pagination is managed here)
    fetchStudents(currentPage.value);
  } catch (error) {
    if (error.response && error.response.status === 400) {
      // Handle validation errors from the server
      const errors = error.response.data;
      console.log("Error: ",errors)
      validationErrors.value = errors;
    } else {
      // Handle other possible errors
      console.error('An error occurred:', error);
      validationErrors.value = error;
      console.log("TEST: ",validationErrors.value.errors)
    }
  }
};

const toggleMenu = (StudentId) => {
  if (activeDropdown.value === StudentId) {
    activeDropdown.value = null;
  } else {
    activeDropdown.value = StudentId;
  }
};

const editStudent = (studentId) => {
  const student = students.value.find(u => u.id === studentId);
  openEditStudentModal(student);
  
};

const deleteStudent = async (StudentId, StudentData) => {
  try {
    const data = await StudentStore.deleteStudent(StudentId);

    toast.success("Student deleted successfully.", {
          //position: toast.POSITION.TOP_CENTER,
          autoClose: 1000,
      });
     // Reload the Students (pagination is managed here)
     fetchStudents(currentPage.value);
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
  fetchStudents();
});
</script>

