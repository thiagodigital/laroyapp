import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useGlobalStore = defineStore('globalStore', () => {
  const isLoading = ref(false);

  function setLoading(status) {
      isLoading.value = status
  }

  return {
    isLoading,
    setLoading,
  }
});
