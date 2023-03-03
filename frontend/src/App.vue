<template>
    <v-card>
        <v-layout>
            <v-app-bar
                color="info"
                prominent
            >
                <v-toolbar-title>CRM Melawai</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn variant="text" icon="mdi-logout"></v-btn>
            </v-app-bar>
            <v-navigation-drawer
                expand-on-hover
                rail
            >
                <v-list>
                    <v-list-item
                        prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
                        title="Sandra Adams"
                        subtitle="sandra_a88@gmailcom"
                    ></v-list-item>
                </v-list>
                <v-divider></v-divider>
                <v-list density="compact" nav>
                    <v-list-item
                        v-for="(link, i) in links"
                        :key="i"
                        :to="link.to"
                        :prepend-icon="link.icon"
                        :title="link.title"
                        :value="i"
                    />
                </v-list>
            </v-navigation-drawer>
            <v-main style="min-height: 100vh; max-height: 100%;">
                <div style="margin: 40px 40px 40px 40px">
                    <router-view />
                </div>
            </v-main>
        </v-layout>
    </v-card>
</template>

<script>
    export default {
        data() {
            return {
                links: [
                    {
                        to: "/customers",
                        icon: "mdi-account-group",
                        title: "Customers",
                    },
                    {
                        to: "/customer-receipts",
                        icon: "mdi-receipt-text-check",
                        title: "Customer Receipts",
                    },
                    {
                        to: "/materials",
                        icon: "mdi-glasses",
                        title: "Materials",
                    },
                    {
                        to: "/sales-order",
                        icon: "mdi-cart-variant",
                        title: "Sales Order",
                    },
                ],
            }
        }
    }
</script>