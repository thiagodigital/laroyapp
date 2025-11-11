<script setup lang="ts">
import { reactive } from 'vue'
import { useAuthStore } from '@/services/stores/authStore'
import FormComponent from '@/components/form/FormComponent.vue'
import InputTextComponent from '@/components/form/InputTextComponent.vue'
import type { UserAuthType } from '@/services/types/global'

const auth = useAuthStore()
const user = reactive<UserAuthType>({
  email: '',
  password: '',
})
</script>
<template>
  <div class="uk-grid uk-grid-collapse" data-uk-grid>
    <div
      class="uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center"
      data-uk-height-viewport
    >
      <div class="uk-width-3-4@s">
        <div class="uk-text-center uk-margin-bottom">
          <a class="uk-logo uk-text-primary uk-text-bold" href="#">
            <!-- <img src="@/assets/logomarca.svg" alt="LeaderSkill" style="height: 50px" /> -->
             LaroyApp
          </a>
        </div>

        <FormComponent @submit="auth.login(user)">
          <InputTextComponent
            label="Email"
            id="email"
            v-model="user.email"
            name="email"
            type="email"
            placeholder="Digite seu email"
          />
          <InputTextComponent
            label="Senha"
            id="password"
            v-model="user.password"
            name="password"
            type="password"
            placeholder="Digite sua senha"
          />
          <div class="uk-width-1-1 uk-text-center">
            <button class="uk-button uk-button-primary uk-width-1-1">Entrar</button>
          </div>
          <div class="uk-width-1-1 uk-margin uk-text-center">
            <a class="uk-text-small uk-link-muted" href="#">Esqueceu a senha?</a>
          </div>
        </FormComponent>
      </div>
    </div>

    <div
      class="uk-hidden uk-width-1-2@m uk-padding-large uk-flex uk-flex-middle uk-flex-center uk-light uk-background-cover uk-background-norepeat uk-background-blend-overlay uk-overlay-primary"
      style="background-image: url(https://source.unsplash.com/2FPjlAyMQTA/680x1000)"
      data-uk-height-viewport
    >
      <div>
        <div class="uk-text-center">
          <h2 class="uk-h1 uk-letter-spacing-small">Hello There, Join Us</h2>
        </div>
        <div class="uk-margin-top uk-margin-medium-bottom uk-text-center">
          <p>Enter your personal details and join the learning community</p>
        </div>
        <div class="uk-width-1-1 uk-text-center">
          <a href="#" class="uk-button uk-button-primary uk-button-large">Sign Up</a>
        </div>
      </div>
    </div>
  </div>
</template>
