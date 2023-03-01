<template>
    <v-btn color="info" style="margin-bottom: 10px;" to="/customers/create">
        Add Customer
    </v-btn>
    <v-table>
        <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Code</th>
                <th class="text-left">Email</th>
                <th class="text-left">Birth Date</th>
                <th class="text-left">Mobile Phone</th>
                <th class="text-left">#</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="customer in customers"
                :key="customer.customerCode"
            >
                <td>{{ customer.customerName }}</td>
                <td>{{ customer.customerCode }}</td>
                <td>{{ customer.customerEmail }}</td>
                <td>{{ customer.customerBirthDate }}</td>
                <td>{{ customer.customerNoHandphone }}</td>
                <td>
                    <v-btn
                        color="warning"
                        icon="mdi-pencil"
                        size="small"
                        @click="$router.push(`/customers/${customer.customerId}/edit`)"
                    />
                </td>
            </tr>
        </tbody>
    </v-table>
</template>

<script lang="js">
    import { sendRequest } from '../../utils/request'

    export default {
        mounted() {
            this.handleCustomers()
        },
        data () {
            return {
                customers: []
            }
        },
        methods: {
            handleCustomers() {
                sendRequest('GET', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customers`)
                .then(res => {
                    this.customers = res.data
                })
                .catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>