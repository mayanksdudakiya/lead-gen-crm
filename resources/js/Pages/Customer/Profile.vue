<template>
    <Head title="Profile" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                        <table class="w-full whitespace-no-wrap">
                            <tr class="text-left font-bold border border-gray-300">
                                <th class="px-6 pt-6 pb-4">Name</th>
                                <td class="px-6 pt-6 pb-4" v-html="customer.name"></td>
                            </tr>
                            <tr class="text-left font-bold border border-gray-300">
                                <th class="px-6 pt-6 pb-4">Phone Number</th>
                                <td class="px-6 pt-6 pb-4" v-html="customer.phone_number"></td>
                            </tr>
                            <tr class="text-left font-bold border border-gray-300">
                                <th class="px-6 pt-6 pb-4">Email Address</th>
                                <td class="px-6 pt-6 pb-4" v-html="customer.email_address"></td>
                            </tr>
                            <tr class="text-left font-bold border border-gray-300">
                                <th class="px-6 pt-6 pb-4">Desired Budget</th>
                                <td class="px-6 pt-6 pb-4" v-html="customer.budget"></td>
                            </tr>
                            <tr class="text-left font-bold border border-gray-300">
                                <th class="px-6 pt-6 pb-4">Message</th>
                                <td class="px-6 pt-6 pb-4" v-html="customer.message"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },

    props: {
        customer: Object
    }
}
</script>
