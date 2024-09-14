<template>
    <div class="container space-y-6">
        <PageTitle>Nieuwe form</PageTitle>

        <div class="bg-white p-4 rounded space-y-6">
            <form @submit.prevent="update">

                <TextInput label="Name" placeholder="Name" v-model="userForm.name" />

                <TextInput label="Fields" placeholder="Fields" v-model="userForm.fields" />

                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-8  p-4 bg-gray-200 rounded">
                        <draggable
                            class="space-y-4 mb-4"
                            v-model="userForm.fields"
                            group="people"
                            @start="drag=true"
                            @end="drag=false"
                            item-key="id">
                            <template #item="{element, index}">
                                <div class="p-4 border rounded bg-white">
                                    <label class="mb-1 block">{{ element.label }} <span v-if="element.required" class="text-red-500 text-sm">*</span></label>
                                    <div class="border rounded w-full p-2">
                                        <span class="text-gray-500">{{ element.placeholder }}</span>
                                    </div>
                                    <div v-if="element.toggle">
                                        Edit field

                                        <pre>
                                            {{ element }} {{ index }}
                                        </pre>

                                        <TextInput label="Name" placeholder="Name" v-model="element.label" />
                                        <TextInput label="Placeholder" placeholder="Placeholder" v-model="element.placeholder" />
                                    </div>
                                    <div class="text-xs mt-2 gap-1 flex">
                                        <button type="button" class="py-1 px-2 bg-blue-500 text-white" @click="element.toggle =! element.toggle">Edit</button>
                                        <button type="button" class="py-1 px-2 bg-red-500 text-white" @click="removeField(index)">Remove</button>
                                    </div>
                                </div>
                            </template>
                        </draggable>
                    </div>
                    <div class="col-span-4">
                        <h3>Add fields</h3>
                        <ul>
                            <li><button type="button" @click="AddTextField">Text</button></li>
                            <li>Email</li>
                            <li>Phone</li>
                            <li>Textarea</li>
                            <li>File</li>
                        </ul>
                    </div>
                </div>

                <BtnPrimary type="submit">Aanmaken</BtnPrimary>
            </form>
        </div>
    </div>
</template>

<script>
import { Head, Link, useForm } from "@inertiajs/vue3"
import Main from "@/Layouts/Main.vue"
import PageTitle from "@/Components/PageTitle.vue"
import { TextInput } from "@/Components/Form"
import BtnPrimary from "@/Components/Button/Primary.vue"
import Draggable from 'vuedraggable'

export default {
    layout: Main,
    components: {
        Head,
        Link,
        PageTitle,
        TextInput,
        BtnPrimary,
        Draggable
    },
    data() {
        return {
            drag: false,
            list: [
                {
                    type: 'text',
                    name: 'firstname',
                    label: 'Firstname',
                    placeholder: 'Enter your Firstname',
                    required: true,
                    toggle: false,
                },
                {
                    type: 'email',
                    name: 'email',
                    label: 'Email address',
                    placeholder: 'Enter your email address',
                    required: true,
                    toggle: false,
                },
                {
                    type: 'tel',
                    name: 'phone',
                    label: 'Phone number',
                    placeholder: 'Enter your phone number',
                    required: false,
                    toggle: false,
                },
            ],
            dragging: false,
            userForm: useForm({
                name: null,
                fields: [],
            }),
        }
    },
    computed: {
        auth() {
            return this.$page.props.auth
        }
    },
    methods: {
        update() {
            this.userForm.post(`/dashboard/forms/create`, {
                // onSuccess: () => this.form.reset('password', 'photo'),
            })
        },
        removeField(index) {
            this.userForm.fields.splice(index, 1);
        },
        AddTextField() {
            this.userForm.fields.push({
                type: 'text',
                name: 'textfield',
                label: 'Textfield',
                placeholder: 'Enter your placeholder text',
                required: false,
                toggle: false,
            })
        }
    }
}
</script>
