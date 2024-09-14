<template>
    <Head>
        <title>Dashboard</title>
    </Head>
    <div class="container space-y-6">
        <PageTitle>Welcome back {{ auth.user.first_name }}</PageTitle>

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded">
                <h2 class="font-bold">Latest submissions</h2>
            </div>

            <div class="bg-white p-4 rounded">
                <h2 class="font-bold">Forms</h2>
            </div>

            <div class="bg-white p-4 rounded">
                <h2 class="font-bold">Statistics</h2>
            </div>
        </div>
    </div>
</template>

<script>
import { Head, Link } from "@inertiajs/vue3"
import Main from "@/Layouts/Main.vue"
import PageTitle from "@/Components/PageTitle.vue"


export default {
    layout: Main,
    components: {
        Head,
        PageTitle
    },
    computed: {
        auth() {
            return this.$page.props.auth
        }
    },
}
</script>

<style>

</style>
