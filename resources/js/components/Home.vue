<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">文章首頁列表</div>

                    <div v-for="(row, index) in posts" class="card-body" style="border-bottom: #1b4b72 1px solid">
                        <h4><router-link :to="{ name : 'posts', params: { id: row.id } }">{{ row.title }}</router-link></h4>
                        <p>{{ row.content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/posts').then(response => {
                // console.log(response)
                this.posts = response.data.data
            })
        },
        data() {
            return {
                posts: []
            }
        }
    }
</script>
