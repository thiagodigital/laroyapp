import { defineStore } from 'pinia'
import axios from 'axios'
import { ref } from 'vue'

export const usePostStore = defineStore('postStore', () => {

  const posts = ref([]);
  const isLoading = ref(false);

  async function fetchPosts() {
    // Se NÃO tivermos posts, mostramos o loading
    if (this.posts.length === 0) {
      this.isLoading = true
    }

    // Se JÁ temos posts (stale), a UI os exibe
    // enquanto o fetch acontece em segundo plano.

    try {
      const response = await axios.get('/posts')
      this.posts = response.data // Atualiza com os dados novos
    } catch (error) {
      console.error('Falha ao buscar posts', error)
    } finally {
      this.isLoading = false
    }
  }

  return {
    posts,
    isLoading,
    fetchPosts,
  }
});
