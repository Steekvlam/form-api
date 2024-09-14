<template>
    <div class="layout-default">
        <header class="fixed top-0 inset-x-0 z-10 bg-white border-b">
            <nav class="navbar p-2 bg-white shadow">
                <div class="flex items-center font-semibold">
                    <div class="logo mr-4">
                        FormBuilder API
                    </div>

                </div>
            </nav>
        </header>

        <section class="mt-16">
            <div class="p-4">
                <Toast />
                <slot />
            </div>
        </section>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3"
import Toast from "@/Components/Toast.vue"
import Logo from "./Logo.vue"

export default {
    components: {
        Logo,
        Link,
        Toast,
    },
    data() {
        return {
            toggleAccount: false,
            toggleSidebar: true
        }
    },
    computed: {
        auth() {
            return this.$page.props.auth
        }
    },
}
</script>
