<template>
    <head>
        <title>Login to FormBuilder</title>
    </head>
    <div class="homepage container space-y-6">
        <PageTitle>Login</PageTitle>

        <div class="grid grid-cols-12">
            <div class="col-span-5">
                <form action="" v-if="!forgotToggle" @submit.prevent="loginForm">
                    <TextInput type="email" label="Email" placeholder="Email" v-model="login.email" />

                    <TextInput type="password" label="Password" placeholder="Password" v-model="login.password" />

                    <div class="mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <input id="remember" type="checkbox" v-model="login.remember">
                                <label for="remember">Remember</label>
                            </div>

                            <div><button @click="forgotToggle = true" href="#" class="font-bold text-blue-600" type="button">Forgot Password?</button></div>
                        </div>

                    </div>
                    <BtnPrimary :disabled="!login.isDirty || login.processing">Login</BtnPrimary>
                </form>

                <form action="" v-if="forgotToggle">
                    <h2>Forgot Password?</h2>
                    <TextInput type="email" label="Email" placeholder="Email" />

                    <div class="flex items-center justify-between">
                        <button @click="forgotToggle = false" href="#" class="font-bold text-blue-600" type="button">Back</button>
                        <BtnPrimary :disabled="!login.isDirty || login.processing">Next</BtnPrimary>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
import { Head, Link, useForm } from "@inertiajs/vue3"
import Default from "@/Layouts/Default.vue"
import PageTitle from "@/Components/PageTitle.vue"
import { TextInput } from "@/Components/Form"
import BtnPrimary from "@/Components/Button/Primary.vue"

export default {
    layout: Default,
    components: {
        PageTitle,
        TextInput,
        BtnPrimary
    },
    data() {
        return {
            login: useForm({
                email: '',
                password: '',
                remember: false,
            }),
            forgotToggle: false,
        }
    },
    methods: {
        loginForm() {
            this.login.post(`/login`, {
                preserveScroll: true
            })
        }
    }
}
</script>
