<template>
    <div>
        <h1>Create Post</h1>
        <form @submit.prevent="createPost">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" v-model="post.title" class="form-control" id="title" name="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea v-model="post.body" class="form-control" id="body" name="body" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                post: {
                    title: '',
                    body: ''
                }
            }
        },
        methods: {
            createPost() {
                axios.post('/api/posts', this.post)
                    .then(response => {
                        this.$router.push({ name: 'post', params: { id: response.data.id } })
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        }
    }

</script>