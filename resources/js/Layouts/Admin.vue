<template>
    <div class="layout-default">
        <header class="fixed top-0 inset-x-0 z-10 bg-white border-b">
            <nav class="navbar p-2 bg-white shadow">
                <div class="flex items-center font-semibold">
                    <div class="logo mr-4">
                        <Logo />
                    </div>

                    <ul class="flex gap-4 w-full" v-if="auth?.user">
                        <li>
                            <Link class="nav-link" href="/dashboard" as="button">Dashboard</Link>
                        </li>

                        <li>
                            <Link class="nav-link" href="/beheer" as="button" :class="{'border-b border-b-2 border-red-500' : isUrl('beheer')}">Beheer</Link>
                        </li>

                        <li class="ml-auto">
                            <Link class="nav-link ml-auto" href="/" as="button">My account</Link>
                        </li>

                        <li>
                            <Link v-if="auth?.user"  href="/logout" as="button">Logout</Link>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="fixed left-0 top-[57px] bottom-0 w-60 border-r bg-white py-3" v-if="!isUrl('admin') && auth?.user">
            <nav class="font-semibold">
                <ul class="">
                    <li class="border-b">
                        <Link class="block py-3 px-4 nav-link" href="/dashboard">
                            Dashboard
                        </Link>
                    </li>
                </ul>
            </nav>
        </aside>

        <aside class="fixed left-0 top-[57px] bottom-0 w-60 border-r bg-white py-2" v-if="isUrl('admin') && auth?.user">
            <nav class="font-semibold">
                <div class="block py-2 px-2 bg-red-500 text-white text-center">
                    <h2 class="text-sm uppercase">Admin</h2>
                </div>
                <ul class="">
                    <li class="border-b">
                        <Link class="block py-3 px-4 nav-link" href="/admin/users">
                            Users
                        </Link>
                    </li>
                </ul>
            </nav>
        </aside>

        <section class="ml-60 mt-16">
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
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1)
            if (urls[0] === '') {
                return currentUrl === ''
            }
            return urls.filter((url) => currentUrl.startsWith(url)).length
        },
    }
}
</script>
