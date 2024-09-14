<template>
    <div class="mb-2">
        <label :for="id">
            {{ label }}
        </label>
        <textarea
            :placeholder="placeholder"
            :value="modelValue"
            :type="type"
            @input="$emit('update:modelValue', $event.target.value)"
            rows="6"
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
