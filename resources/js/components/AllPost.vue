<template>
    
        <h1>All Posts</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mt-4">
                        <img src="" alt="" class="card-image-top">
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Come fare i ravioli</strong><br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quibusdam.
                            </p>
                        </div>
                        <button class="btn btn-primary m-2">Read More</button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mt-4">
                        <img src="" alt="" class="card-image-top">
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Come fare i ravioli</strong><br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quibusdam.
                            </p>
                        </div>
                        <button class="btn btn-primary m-2">Read More</button>
                    </div>

            </div>
        </div>
    
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: []
            }
        },
        created() {
            axios.get('/api/posts')
                .then(response => {
                    this.posts = response.data
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
</script>