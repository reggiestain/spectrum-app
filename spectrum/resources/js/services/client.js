import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
// Get the current host
const currentHost = location.host;

const host = 
        currentHost === 'localhost'
        ? 'http://localhost:8008/api'
        : currentHost === 'polsinelli-web-app.azurewebsites.net'
        ? 'https://online.polsinelli.com/api'
        : 'http://localhost:8008/api';
const apiClient = axios.create({
    baseURL: host,
});
// Add a request interceptor
apiClient.interceptors.request.use(
    function (config) {
        // Get the token from localStorage
        const token = localStorage.getItem("token");

        // If the token exists, add it to the Authorization header
        if (token) {
            config.headers["Authorization"] = `Bearer ${token}`;
        }

        return config;
    },
    function (error) {
        if (error.response && error.response.status === 401) {
            router.push("/login");
        }
        // Handle request error
        return Promise.reject(error);
    }
);

export default apiClient;
