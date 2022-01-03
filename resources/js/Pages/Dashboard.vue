<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="w-full whitespace-no-wrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">Name</th>
                                <th class="px-6 pt-6 pb-4">Phone Number</th>
                                <th class="px-6 pt-6 pb-4">Email Address</th>
                                <th class="px-6 pt-6 pb-4">Desired Budget</th>
                                <th class="px-6 pt-6 pb-4">Message</th>
                                <th class="px-6 pt-6 pb-4">Action</th>
                            </tr>

                            <tr class="text-left hover:bg-gray-100 focus-within:bg-gray-100" v-for="customer in customers.data" :key="customer.id">
                                <td class="px-6 pt-6 pb-4" v-html="customer.name"></td>
                                <td class="px-6 pt-6 pb-4" v-html="customer.phone_number"></td>
                                <td class="px-6 pt-6 pb-4" v-html="customer.email_address"></td>
                                <td class="px-6 pt-6 pb-4" v-html="customer.budget"></td>
                                <td class="px-6 pt-6 pb-4" v-html="customer.message"></td>
                                <td class="px-6 pt-6 pb-4">
                                    
                                </td>
                            </tr>
                        </table>

                        <Pagination :links="customers.links" />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Pagination
    },

    props: {
        customers: Object
    },
}
</script>
