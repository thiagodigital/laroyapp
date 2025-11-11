<script setup>
import { defineProps, onMounted, ref } from 'vue'
defineProps({
  label: {
    type: [Boolean, String],
    default: false,
  },
  cls: {
    type: String,
    default: 'input',
  },
  id: {
    type: String,
    default: '',
  },
  required: {
    type: Boolean,
    default: false,
  },
  type: {
    type: String,
    default: 'text',
  },
  name: {
    type: String,
    default: 'name',
  },
  placeholder: {
    type: String,
    default: 'placeholder',
  },
  erro: {
    type: String,
    default: '',
  },
  modelValue: {
    type: String,
    required: true,
  },
})
const input = ref(null)

defineEmits(['update:modelValue'])

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus()
  }
})
const togglePassword = (event) => {
  console.log('Toggle password clicked', inputField.type)
  event.preventDefault()
  const inputField = input.value
  if (inputField.type === 'password') {
    inputField.type = 'text'
  } else {
    inputField.type = 'password'
  }
}

defineExpose({ focus: () => input.value.focus() })
</script>
<template>
  <div class="uk-width-1-1 uk-margin" v-if="type == 'password'">
    <label v-if="label" class="uk-form-label" :for="type">{{ label }}</label>
    <div class="uk-inline uk-width-1-1">
      <a
        class="uk-form-icon uk-form-icon-flip"
        @click.prevent="togglePassword()"
        href="#"
        uk-icon="icon: eye"
      ></a>
      <input
        :id="id ? id : `toggle-password-label`"
        :type="type"
        :required="required"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :name="name"
        :placeholder="placeholder"
        ref="input"
        class="uk-input"
      />
    </div>

    <!-- <button
      type="button"
      :data-toggle-password="`{ &quot;target&quot;: &quot;#${id ? id : `toggle-password-label`}&quot; }`"
      class="block cursor-pointer"
      aria-label="password toggle"
    >
      <span
        class="icon-[tabler--eye] text-base-content/80 password-active:block hidden size-5 shrink-0"
      ></span>
      <span
        class="icon-[tabler--eye-off] text-base-content/80 password-active:hidden block size-5 shrink-0"
      ></span>
    </button> -->
  </div>
  <div class="uk-width-1-1 uk-margin" v-else>
    <label v-if="label" class="uk-form-label">{{ label }}</label>
    <input
      :type="type"
      :value="modelValue"
      :required="required"
      @input="$emit('update:modelValue', $event.target.value)"
      :class="cls"
      class="uk-input"
      :name="name"
      :placeholder="placeholder"
      ref="input"
    />
    <div v-if="erro !== ''" class="fv-plugins-message-container invalid-feedback">{{ erro }}</div>
  </div>
</template>
