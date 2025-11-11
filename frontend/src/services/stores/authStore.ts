import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import http from '@/services/http'

export const useAuthStore = defineStore('authStore', () => {

    const user =  ref(null);
    const isAuthChecked =  ref(false);

    const isAuthenticated = computed(() => !!user.value);
    const currentUser = computed(() => user.value);

    async function fetchUser() {
      try {
        const response = await http.get('/api/user')
        user.value = response.data
      } catch (error) {
        user.value = null
      } finally {
        isAuthChecked.value = true
      }
    }

    function getCookie(name) {
      const nameEQ = name + "="; // Create the string to search for, including the equals sign
      const ca = document.cookie.split(';'); // Split the document.cookie string into an array of individual cookie strings

      for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') { // Trim leading spaces from the cookie string
          c = c.substring(1, c.length);
        }
        if (c.indexOf(nameEQ) === 0) { // Check if this cookie string starts with the desired name
          return decodeURIComponent(c.substring(nameEQ.length, c.length)); // Extract and decode the cookie value
        }
      }
      return null; // Return null if the cookie is not found
    }

    async function login(credentials: UserAuthType) {
      await http.post('/login', credentials, { headers: { accept: 'application/json', 'X-XSRF-TOKEN': getCookie('XSRF-TOKEN') }, withCredentials: true})
      await fetchUser()
    }

    async function logout() {
      try {
        await http.post('/logout')
      } catch (error) {
        console.error("Erro no logout, mas limpando localmente.", error)
      } finally {
        user.value = null
      }
    }

    return {
      user,
      isAuthChecked,
      isAuthenticated,
      currentUser,
      fetchUser,
      login,
      logout
    }
});
