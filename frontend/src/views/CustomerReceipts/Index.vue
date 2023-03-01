<template>
    <v-table>
        <thead>
            <tr style="white-space: nowrap;">
                <th class="text-left">Name</th>
                <th class="text-left">Code</th>
                <th class="text-left">Customer</th>
                <th class="text-left">Spheris</th>
                <th class="text-left">Cylinder</th>
                <th class="text-left">Addition</th>
                <th class="text-left">Axis</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="customer in customers"
                :key="customer.customerCode"
                style="white-space: nowrap;"
            >
                <td>{{ customer.customerReceiptName }}</td>
                <td>{{ customer.customerReceiptCode }}</td>
                <td>{{ customer.customerCode }} - {{ customer.customerName }}</td>
                <td>
                    {{ `R ${customer.customerReceiptSpherisRight}` }}
                    <br/>
                    {{ `L ${customer.customerReceiptSpherisLeft}` }}
                </td>
                <td>
                    {{ `R ${customer.customerReceiptCylinderRight}` }}
                    <br/>
                    {{ `L ${customer.customerReceiptCylinderLeft}` }}
                </td>
                <td>
                    {{ `R ${customer.customerReceiptAdditionRight}` }}
                    <br/>
                    {{ `L ${customer.customerReceiptAdditionLeft}` }}
                </td>
                <td>
                    {{ `R ${customer.customerReceiptAxisRight}` }}
                    <br/>
                    {{ `L ${customer.customerReceiptAxisLeft}` }}
                </td>
            </tr>
        </tbody>
    </v-table>
</template>

<script lang="js">
    import { sendRequest } from '../../utils/request';

    export default {
        mounted() {
            this.handleCustomerReceipts()
        },
        data () {
            return {
                customers: []
            }
        },
        methods: {
            handleCustomerReceipts() {
                sendRequest('GET', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customer-receipts`)
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