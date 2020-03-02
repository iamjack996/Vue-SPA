<style>
    .has-error {
        color: red;
    }
</style>
<template>

        <form class="form-horizontal" @submit.prevent="register">
            <div class="form-group row" :class="{'has-error' : errors.has('name')}">
                <label for="name" class="col-md-4 col-form-label text-md-right">名字</label>
                <div class="col-md-6">
<!--                    v-validate="{ rules: { required: true, min: 4 } }"-->
                    <input v-model="name"
                           v-validate="'required|min:4'" data-vv-as="名字"
                           id="name" type="text" class="form-control" name="name" autocomplete="name" autofocus>
                    <span class="help-block" v-show="errors.has('name')">{{ errors.first('name') }}</span>
                </div>
            </div>

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

            <div class="form-group row" :class="{'has-error' : errors.has('password_confirmation')}">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">確認密碼</label>
                <div class="col-md-6">
                    <input v-validate="'required|min:6|confirmed:password'" data-vv-as="確認密碼"
                        id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    <span class="help-block" v-show="errors.has('password_confirmation')">{{ errors.first('password_confirmation') }}</span>
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
            register() {
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
