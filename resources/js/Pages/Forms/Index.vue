<template>
    <head>
        <title>Forms</title>
    </head>
    <div class="container">
        <h1 class="font-bold text-4xl mb-4">Forms</h1>
        <div class="p-4 bg-white rounded shadow">
            <table class="table">
                <tbody>
                    <tr v-for="form in forms" :key="form.id">
                        <td class="p-2"><Link :href="`/dashboard/forms/${form.id}`">{{ form.name }}</Link></td>
                        <td class="p-2"><Link :href="`/dashboard/forms/${form.id}`">fields: {{ form.fields.length }}</Link></td>
                        <td class="p-2"><Link :href="`/dashboard/forms/${form.id}`">{{ form.id }}</Link></td>
                    </tr>
                </tbody>
            </table>

            <!-- <pre>
                {{ forms }}
            </pre> -->
        </div>
    </div>
</template>

<script>
import { Head, Link, useForm } from "@inertiajs/vue3"
import User from "@/Layouts/User.vue"
import PageTitle from "@/Components/PageTitle.vue"

export default {
    layout: User,
    components: {
        PageTitle,
        Link,
    },
    props: ['forms'],
    data() {
        return {
            customerForm: useForm({
                name: this.customer?.name,
                email: this.customer?.email
            })
        }
    },
    computed: {
        auth() {
            return this.$page.props.auth
        }
    },
    methods: {
        accountUpdate() {
            this.customerForm.put(`/dashboard/account`, {
                preserveScroll: true,
            })
        }
    }
}
</script>
