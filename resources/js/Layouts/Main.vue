<template>
    <component :is="auth.user.role == 'admin' ? 'Admin' : 'User'">
        <slot></slot>
    </component>
</template>

<script>
import User from "@/Layouts/User.vue"
import Admin from "@/Layouts/Admin.vue"

export default {
    components: {
        User,
        Admin,
    },
    computed: {
        auth() {
            return this.$page.props.auth
        }
    },
}
</script>
