<template>
    <div class="mb-2">
      <label v-if="label" class="form-label">{{ label }}</label>
      <div class="border border-gray-300 rounded shadow-sm w-full p-0" :class="{ error: errors.length }">
        <input ref="file" type="file" :accept="accept" class="hidden" @change="change" />
        <div v-if="!modelValue" class="p-2">
          <button type="button" class="btn btn-sm" @click="browse">Bladeren</button>
        </div>
        <div v-else class="p-2">
            <div class="mb-1">
                <img v-if="(typeof modelValue === 'string' || modelValue instanceof String)" :src="`/${modelValue}`" alt="">
                <span v-if="modelValue.name" class="break-all">{{ modelValue.name }}</span>
                <span v-if="modelValue.size" class="text-gray-500 text-xs ml-2">({{ filesize(modelValue.size) }})</span>
            </div>
            <button type="button" class="btn btn-sm" @click="remove">Verwijderen</button>
        </div>
      </div>
      <div v-if="errors.length" class="form-error">{{ errors[0] }}</div>
    </div>
  </template>

  <script>
  export default {
    props: {
      modelValue: File,
      label: String,
      accept: String,
      errors: {
        type: Array,
        default: () => [],
      },
    },
    data() {
        return {
        }
    },
    emits: ['update:modelValue'],
    watch: {
      modelValue(value) {
        if (!value) {
          this.$refs.file.value = ''
        }
      },
    },
    methods: {
      filesize(size) {
        var i = Math.floor(Math.log(size) / Math.log(1024))
        return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
      },
      browse() {
        this.$refs.file.click()
      },
      change(e) {
        this.$emit('update:modelValue', e.target.files[0])

      },
      remove() {
        this.$emit('update:modelValue', null)
      },
    },
  }
  </script>
