<template>

    <ValidationObserver v-slot="{ passes }">
        <form class="form-horizontal" @submit.prevent="passes(register)">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">名字</label>
                <div class="col-md-6">
                    <ValidationProvider name="name" rules="required|min:2" v-slot="{ errors }" persist>
                        <input v-model="name" id="name" type="text" class="form-control" name="name" autocomplete="name" autofocus>
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                <div class="col-md-6">
                    <ValidationProvider name="email" rules="required|email" v-slot="{ errors }">
                        <input v-model="email" id="email" type="email" class="form-control" name="email" autocomplete="email">
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">密碼</label>
                <div class="col-md-6">
                    <ValidationProvider name="password" rules="required" v-slot="{ errors }">
                        <input v-model="password" id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">確認密碼</label>
                <div class="col-md-6">
                    <ValidationProvider name="password_confirmation" rules="required" v-slot="{ errors }">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        <span>{{ errors[0] }}</span>
                    </ValidationProvider>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        註冊
                    </button>
                </div>
            </div>
        </form>
    </ValidationObserver>

</template>

<script>
    import { ValidationObserver, ValidationProvider } from "vee-validate"
    export default {
        data() {
            return {
                name : '',
                email : '',
                password : '',
            }
        },
        components: {
            ValidationObserver,
            ValidationProvider
        },
        methods: {
            register() {
                console.log('hey')
                let formData = {
                    name : this.name,
                    email : this.email,
                    password : this.password
                }
                // axios.post('/api/register', formData).then(response => {
                //     // console.log(response)
                //     this.$router.push({name:'confirm'})
                // })
            }
        }
    }
</script>
