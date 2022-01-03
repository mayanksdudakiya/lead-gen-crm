<template>
    <Head title="Customer Contact" />

    <BreezeValidationErrors class="mb-4" />

    <FlashMessage />

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="name" value="Name" />
            <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="phone_number" value="Phone Number" />
            <BreezeInput id="phone_number" type="tel" class="mt-1 block w-full" v-model="form.phone_number" required autocomplete="phone_number" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="email_address" value="Email Address" />
            <BreezeInput id="email_address" type="email" class="mt-1 block w-full" v-model="form.email_address" required autocomplete="email" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="budget" value="Desired Budget" />
            <BreezeInput id="budget" type="number" class="mt-1 block w-full" v-model="form.budget" required autocomplete="email" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="message" value="Message" />
            <BreezeTextarea id="message" class="mt-1 block w-full" v-model="form.message" required autocomplete="message" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeTextarea from '@/Components/Textarea.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue'

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeTextarea,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
        FlashMessage
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                phone_number: '',
                email_address: '',
                budget: '',
                message: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(route('customer.store'), {
                onSuccess: () => this.form.reset(),
            })
        }
    }
}
</script>
