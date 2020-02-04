<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="font-size: 20px">{{ post.title }}</div>

                    <div class="card-body">
                        <p>{{ post.content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/posts/' + this.$route.params.id).then(response => {
                console.log(response)
                this.post = response.data
            })
        },
        data() {
            return {
                post: {}
            }
        }
    }
</script>
