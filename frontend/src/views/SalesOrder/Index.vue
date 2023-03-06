<template>
    <v-table>
        <thead>
            <tr>
                <th class="text-left">Invoice</th>
                <th class="text-left">Customer</th>
                <th class="text-left">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="salesOrder in salesOrders"
                :key="salesOrder.soInvoice"
            >
                <td>{{ salesOrder.soInvoice }}</td>
                <td>{{ salesOrder.customer.customerCode }} - {{ salesOrder.customer.customerName }}</td>
                <td>{{ salesOrder.soDate }}</td>
            </tr>
        </tbody>
    </v-table>
</template>

<script lang="js">
    import { sendRequest } from '../../utils/request'

    export default {
        mounted() {
            this.handleSalesOrder()
        },
        data () {
            return {
                salesOrders: []
            }
        },
        methods: {
            handleSalesOrder() {
                sendRequest('GET', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/sales-order`)
                .then(res => {
                    this.salesOrders = res.data
                })
                .catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>