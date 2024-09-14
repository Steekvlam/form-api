<template>
    <div class="mb-2">
        <label class="block" :for="label">
            {{ label }}
        </label>
        <input
            class="w-full border border-gray-300 rounded shadow-sm"
            :class="{'border-red-500': error}"
            :placeholder="placeholder"
            :value="modelValue"
            :type="type"
            :id="label"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </div>
</template>

<script>
export default {
    props: {
        modelValue: { type: String , required: false, default: ''},
        label: { type: String , required: false, default: ''},
        icon: { type: String, required: false , default: '' },
        placeholder: { type: String, required: false, default: ''},
        error: {type: String, required: false, default: ''},
        type: {
            type: String,
            default: 'text',
        },
    },
    emits: ['update:modelValue'],
    data() {
        return {
            inputValue: this.value,
        }
    },
    methods: {
        updateValue() {
            this.$emit('input', this.inputValue);
        },
    },
}
</script>
