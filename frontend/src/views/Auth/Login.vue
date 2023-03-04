<template>
    <v-sheet width="300" class="mx-auto" style="padding-top: 10%">
        <v-form ref="form">
            <v-text-field
                v-model="email"
                :counter="50"
                :rules="emailRule"
                label="Email"
                required
            />
            <v-text-field
                v-model="password"
                :rules="passwordRule"
                label="Password"
                required
            />
            <div class="d-flex flex-column">
                <v-btn
                    color="success"
                    class="mt-4"
                    block
                    @click="validate"
                >
                    Login
                </v-btn>
            </div>
        </v-form>
    </v-sheet>
</template>

<script lang="js">
    import { sendRequest } from '../../utils/request'

    export default {
        data: () => ({
            valid: true,
            email: '',
            emailRule: [
                v => !!v || 'Email is required',
                v => (v && v.length <= 50) || 'Email must be less than 50 characters',
            ],
            password: '',
            passwordRule: [
                v => !!v || 'Password is required',
            ],
        }),
        methods: {
            async validate () {
                const { valid } = await this.$refs.form.validate()
                if (valid) {
                    sendRequest('POST', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/auth/login`, {
                        email: this.email,
                        password: this.password
                    })
                    .then(res => {
                        if (!res.status) throw new Error(res.message)
                        localStorage.setItem('token', res.token)
                        window.location.href = "/customers"
                    })
                    .catch(err => {
                        alert(err)
                    })
                }
            },
            reset () {
                this.$refs.form.reset()
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            },
        },
    }
</script>