<template>

    <div class="container space-y-6">
        <PageTitle>Edit form</PageTitle>

        <div class="bg-white p-4 rounded space-y-6">
            <form @submit.prevent="update">

                <TextInput label="Name" placeholder="Name" v-model="userForm.name" />

                <div class="grid grid-cols-12 gap-6 mb-4">
                    <div class="col-span-8  p-4 bg-gray-100 rounded">
                        <draggable
                            v-if="userForm.fields.length > 0"
                            class="space-y-4 mb-4"
                            v-model="userForm.fields"
                            group="people"
                            @start="drag=true"
                            @end="drag=false"
                            item-key="id"
                            handle=".handle">
                            <template #item="{element, index}">
                                <div class="p-4 border rounded bg-white">
                                    <div>
                                        <label class="mb-1 block">{{ element.label }} <span v-if="element.required" class="text-red-500 text-sm">*</span></label>
                                        <div class="border rounded w-full p-2">
                                            <span class="text-gray-500">{{ element.placeholder }}</span>
                                        </div>

                                        <div v-if="element.toggle">
                                            <div class="font-bold mt-2">Edit field</div>

                                            <TextInput label="Name" placeholder="Name" v-model="element.label" @input="setFieldSettings(element)" />
                                            <TextInput label="Placeholder" placeholder="Placeholder" v-model="element.placeholder" />
                                        </div>
                                        <div class="text-xs mt-2 gap-1 flex">
                                            <button type="button" class="py-1 px-2 bg-blue-500 text-white" @click="element.toggle =! element.toggle">Edit</button>
                                            <button type="button" class="py-1 px-2 bg-red-500 text-white" @click="removeField(index)">Remove</button>
                                        </div>
                                    </div>
                                    <div class="handle w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                        </svg>
                                    </div>

                                </div>
                            </template>
                        </draggable>
                    </div>
                    <div class="col-span-4">
                        <h3>Add fields</h3>

                        <draggable
                            class="dragArea list-group space-y-4"
                            :list="list1"
                            :sort="false"
                            :group="{ name: 'people', pull: 'clone', put: false }"
                        >
                            <template #item="{element}">
                                <div class="p-2 border w-full rounded bg-white">
                                    {{ element.label }}
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>

                <BtnPrimary type="submit">Save</BtnPrimary>
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
    props: ['form'],
    data() {
        return {
            drag: false,
            userForm: useForm({
                name: this.form.name ?? null,
                fields: this.form.fields ?? [],
            }),
            list1: [
                {
                    type: 'text',
                    name: 'text_field',
                    label: 'Text field',
                    placeholder: 'Enter your placeholder text',
                    required: false,
                    toggle: false,
                },
                {
                    type: 'email',
                    name: 'email_field',
                    label: 'Email field',
                    placeholder: 'Enter your placeholder text',
                    required: false,
                    toggle: false,
                },
                {
                    type: 'phone',
                    name: 'phone_field',
                    label: 'Phone field',
                    placeholder: 'Enter your placeholder text',
                    required: false,
                    toggle: false,
                },
                {
                    type: 'textarea',
                    name: 'textarea',
                    label: 'Textarea',
                    placeholder: 'Enter your placeholder text',
                    required: false,
                    toggle: false,
                },
            ],
        }
    },
    computed: {
        auth() {
            return this.$page.props.auth
        }
    },
    methods: {
        update() {
            this.userForm.put(`/dashboard/forms/${this.form.id}`, {
                // onSuccess: () => this.form.reset('password', 'photo'),
            })
        },
        removeField(index) {
            this.userForm.fields.splice(index, 1);
        },
        setFieldSettings(element) {
            element.name = element.label.replace(/^\s+|\s+$/g, '').toLowerCase().replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '_').replace(/_+/g, '_').replace(/-+/g, '')
        }
    }
}
</script>
