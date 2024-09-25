<template>
  <div class="flex h-screen">
    <!-- Left Section -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center bg-white p-8">
      <div class="text-left w-full max-w-md">
        <h1 class="text-4xl font-semibold text-gray-900 mb-8">
          Welcome to NeuroSync
        </h1>

        <!-- Error Alert -->
        <div v-if="loginError" class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">
          {{ loginError }}
        </div>

        <div>
          <!-- Email -->
          <div class="mb-4">
            <label for="email" class="sr-only">Email</label>
            <input
              type="email"
              id="email"
              v-model="userEmail"
              placeholder="Email"
              class="w-full px-4 py-2 border rounded-md"
              :class="{ 'border-red-500': submitted && emailError }"
              required
            />
            <p v-if="submitted && emailError" class="text-red-500 text-sm">{{ emailError }}</p>
          </div>

          <!-- Password -->
          <div class="mb-6">
            <label for="password" class="sr-only">Password</label>
            <div class="relative">
              <input
                :type="showPassword ? 'text' : 'password'"
                id="password"
                v-model="userPassword"
                placeholder="Password"
                class="w-full px-4 py-2 border rounded-md"
                :class="{ 'border-red-500': submitted && passwordError }"
                required
              />
              <button type="button" @click="togglePasswordVisibility" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" v-if="showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.834 3.107-3.271 5.643-6.542 6.542-1.365.382-2.799.543-4.208.486-2.211-.098-4.408-.94-6.208-2.228C3.347 14.708 2.082 13.412 2.458 12z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" v-else class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M9.414 9.414A2 2 0 0111 8h2a2 2 0 012 2v2a2 2 0 01-.414 1.414L5.293 5.293A10.97 10.97 0 013 12c.937 2.626 3.09 4.666 5.707 5.293L9.414 9.414z" />
                </svg>
              </button>
            </div>
            <p v-if="submitted && passwordError" class="text-red-500 text-sm">{{ passwordError }}</p>
          </div>

          <!-- Login Button -->
          <div class="mb-6">
            <button
              type="button"
              @click="login"
              class="w-full bg-red-700 text-white py-2 px-4 rounded-md hover:bg-red-800 focus:outline-none"
            >
              LOGIN
            </button>
          </div>

          <div class="text-sm text-center">
            <a href="/forgot-password" class="text-red-700 hover:underline">Forgot your password? Click HERE.</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Right Section with Brain Image -->
    <div class="hidden lg:block lg:w-1/2 bg-cover bg-no-repeat bg-right" style="background-image: url('/images/human-brain-image.png');"></div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router';
import { useUserStore } from '../stores/userStore'

const userEmail = ref('')
const userPassword = ref('')
const showPassword = ref(false)
const submitted = ref(false)
const emailError = ref('')
const passwordError = ref('')
const loginError = ref('') // Add reactive variable for login error

const router = useRouter();
const userStore = useUserStore();

const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value
}

const validateEmail = () => {
  if (!userEmail.value) {
    emailError.value = 'Email is required.'
    return false
  } else if (!/\S+@\S+\.\S+/.test(userEmail.value)) {
    emailError.value = 'Must be a valid email address.'
    return false
  }
  emailError.value = ''
  return true
}

const validatePassword = () => {
  if (!userPassword.value) {
    passwordError.value = 'Password is required.'
    return false
  } else if (userPassword.value.length < 6) {
    passwordError.value = 'Password must be at least 6 characters long.'
    return false
  }
  passwordError.value = ''
  return true
}

// Handle login submission
const login = async () => {
  submitted.value = true

  const isEmailValid = validateEmail()
  const isPasswordValid = validatePassword()

  if (isEmailValid && isPasswordValid) {
    try {
      const response = await userStore.login(userEmail.value, userPassword.value)
      console.log("Error 1: ",response);
      if (response) {    
        router.push('/dashboard')
      } else {
        loginError.value = response.message // Display error message
      }
    } catch (error) {
      loginError.value = error.message
      console.error('Login failed:', error)
    }
  }
}
</script>

<style scoped>
/* Additional styling if needed */
</style>
