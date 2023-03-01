<template>
    <form @submit.prevent="submit">
        <v-text-field
            label="Name"
            v-model="data.customer.customerName"
            :model-value="data.customer.customerName"
            :error-messages="customerName.errorMessage.value"
        />
        <v-text-field
            type="date"
            label="Birth Date"
            v-model="data.customer.customerBirthDate"
            :model-value="data.customer.customerBirthDate"
            :error-messages="customerBirthDate.errorMessage.value"
        />
        <v-textarea
            label="Address"
            v-model="data.customer.customerAddress"
            :model-value="data.customer.customerAddress"
            :error-messages="customerAddress.errorMessage.value"
        />
        <v-text-field
            label="City"
            v-model="data.customer.customerCity"
            :model-value="data.customer.customerCity"
            :error-messages="customerCity.errorMessage.value"
        />
        <v-text-field
            label="Phone Number"
            v-model="data.customer.customerNoHandphone"
            :model-value="data.customer.customerNoHandphone"
            :error-messages="customerNoHandphone.errorMessage.value"
        />
        <v-text-field
            label="E-mail"
            v-model="data.customer.customerEmail"
            :model-value="data.customer.customerEmail"
            :error-messages="customerEmail.errorMessage.value"
        />
        <v-btn
            class="me-4"
            type="submit"
        >
            Submit
        </v-btn>
        <v-btn @click="handleReset">
            Clear
        </v-btn>
    </form>
</template>

<script>
    import { ref } from 'vue'
    import { useField, useForm } from 'vee-validate'
    import { sendRequest } from '../../utils/request'
    
    export default {
        data () {
            return {
                data: {
                    customer: {
                        customerName: "",
                        customerBirthDate: "",
                        customerAddress: "",
                        customerCity: "",
                        customerNoHandphone: "",
                        customerEmail: ""
                    }
                },
            }
        },
        setup () {
            const { handleSubmit, handleReset } = useForm({
                validationSchema: {
                    customerName (value) {
                        if (value?.length >= 3) return true
                        return 'Name needs to be at least 3 characters.'
                    },
                    customerBirthDate (value) {
                        if (value?.length === 10) return true
                        return 'Birth date cannot be null.'
                    },
                    customerAddress (value) {
                        if (value?.length >= 10) return true
                        return 'Address needs to be at least 10 characters.'
                    },
                    customerCity (value) {
                        if (value?.length >= 3) return true
                        return 'City needs to be at least 3 characters.'
                    },
                    customerNoHandphone (value) {
                        if (value?.length > 9 && /[0-9-]+/.test(value)) return true

                        return 'Phone number needs to be at least 9 digits.'
                    },
                    customerEmail (value) {
                        if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value)) return true

                        return 'Must be a valid e-mail.'
                    },
                },
            })

            const customerName        = useField('customerName')
            const customerBirthDate   = useField('customerBirthDate')
            const customerAddress     = useField('customerAddress')
            const customerCity        = useField('customerCity')
            const customerNoHandphone = useField('customerNoHandphone')
            const customerEmail       = useField('customerEmail')

            const items = ref([
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4',
                'Item 5',
                'Item 6',
            ])

            const submit = handleSubmit(values => {
                sendRequest('PUT', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customers/${this.$route.params.id}`, values)
                .then(res => {
                    if (res.status) {
                        window.location.href = "/customers"
                    }
                })
                .catch(err => {
                    console.log(err)
                })
            })

            return { customerName, customerBirthDate, customerAddress, customerCity, customerNoHandphone, customerEmail, items, submit, handleReset }
        },
        mounted() {
            this.fetchCustomer(this.$route.params.id)
        },
        methods: {
            async fetchCustomer(id) {
                sendRequest('GET', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customers/${id}`)
                .then(res => {
                    // this.data.customer = res.data
                })
                .catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>