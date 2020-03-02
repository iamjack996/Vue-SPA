<style>
    .bar-row {
        border-bottom: #1b1e21 1px solid;
    }
</style>
<template>
    <div class="row" style="background-color: white;height: 70px;padding-top: 15px;">
        <div class="navbar-header"style="margin-left: 40px;width: 80%;">
            <router-link to="/" class="navbar-brand">Vue SPA</router-link>
        </div>
        <div style="margin-left: 20px;">
            <ul class="nav navbar-nav navbar-right" style="width: 130%;">
                <router-link to="/about" tag="li" class="bar-row">
                    <a>About</a>
                </router-link>
                <router-link :to="{ name : 'login' }" tag="li" class="bar-row">
                    <a>Login</a>
                </router-link>
                <router-link :to="{ name : 'register' }" tag="li">
                    <a>Register</a>
                </router-link>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
    }
</script>
