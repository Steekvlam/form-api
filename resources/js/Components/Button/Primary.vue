<template>
    <button v-if="!link" :class="css_class">
        <slot />
    </button>
    <a v-else :href="link" :class="css_class">
        <slot />
    </a>
</template>
<script>
export default {
    props: {
        link: { type: String , required: false, default: ''},
        title: { type: String , required: false, default: ''},
        icon: { type: String, required: false , default: '' },
    },
    data(){
        return {
            css_class: 'px-4 py-3 bg-red-500 text-white rounded'
        }
    }
}
</script>
