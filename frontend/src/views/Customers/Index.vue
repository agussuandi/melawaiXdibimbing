<template>
    <v-btn color="info" style="margin-bottom: 10px;" to="/customers/create">
        Add Customer
    </v-btn>
    <v-btn color="success" style="margin-left: 10px; margin-bottom: 10px;"  @click="handldExportXls()">
        Export to Xls
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
                    <v-btn
                        color="error"
                        icon="mdi-delete"
                        size="small"
                        @click="handleDestroyCustomer(customer.customerId)"
                    />
                </td>
            </tr>
        </tbody>
    </v-table>
</template>

<script lang="js">
    import xlsx from "json-as-xlsx"
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
            },
            handleDestroyCustomer(id) {
                if (confirm("Are you sure ?")) {
                    sendRequest('DELETE', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customers/${id}`)
                    .then(res => {
                        if (!res.status) {
                            if (!res.status) throw new Error(res.message)
                        }
                        this.handleCustomers()
                        alert('Customer deleted')
                    })
                    .catch(err => {
                        alert(err)
                    })
                }
            },
            handldExportXls() {
                let contents = []
                this.customers?.forEach((customer, i) => {
                    contents.push({
                        name: customer.customerName, 
                        code: customer.customerCode,
                        email: customer.customerEmail,
                        birthdate: customer.customerBirthDate,
                        mobile: customer.customerNoHandphone,
                    })
                })

                const exportData = [{
                    sheet: "Customers",
                    columns: [
                        { label: "Name", value: "name" },
                        { label: "Code", value: "code" },
                        { label: "Email", value: "email" },
                        { label: "Birthdate", value: "birthdate" },
                        { label: "Mobile Phone", value: "mobile" },
                    ],
                    content: contents
                }]
                
                let settings = {
                    fileName: "Customers CRM - Melawai", // Name of the resulting spreadsheet
                    extraLength: 3, // A bigger number means that columns will be wider
                    writeMode: "writeFile", // The available parameters are 'WriteFile' and 'write'. This setting is optional. Useful in such cases https://docs.sheetjs.com/docs/solutions/output#example-remote-file
                    writeOptions: {}, // Style options from https://docs.sheetjs.com/docs/api/write-options
                    RTL: false, // Display the columns from right-to-left (the default value is false)
                }

                xlsx(exportData, settings)
            }
        }
    }
</script>