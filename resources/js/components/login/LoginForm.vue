<template>

    <form class="form-horizontal" @submit.prevent="login">

        <div class="form-group row" :class="{'has-error' : errors.has('email')}">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
            <div class="col-md-6">
                <input v-model="email"
                       v-validate="'required|email'" data-vv-as="Email"
                       id="email" type="text" class="form-control" name="email" autocomplete="email">
                <span class="help-block" v-show="errors.has('email')">{{ errors.first('email') }}</span>
            </div>
        </div>

        <div class="form-group row" :class="{'has-error' : errors.has('password')}">
            <label for="password" class="col-md-4 col-form-label text-md-right">密碼</label>
            <div class="col-md-6">
                <input v-model="password" ref="password"
                       v-validate="'required|min:6'" data-vv-as="密碼"
                       id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                <span class="help-block" v-show="errors.has('password')">{{ errors.first('password') }}</span>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    登入
                </button>
            </div>
        </div>
    </form>

</template>

<script>
    export default {
        // name: '{locale}',
        // messages: {
        //     // ...
        // },
        data() {
            return {
                name : '',
                email : '',
                password : '',
            }
        },
        components: {

        },
        methods: {
            login() {
                console.log(this.errors.items)
                if (this.errors.items > 0) {
                    return;
                }
                let formData = {
                    name : this.name,
                    email : this.email,
                    password : this.password
                }
                axios.post('/api/register', formData).then(response => {
                    console.log(response)
                    this.$router.push({name:'confirm'})
                })
            }
        }
    }
</script>
<style>
    .has-error {
        color: red;
    }
</style>
