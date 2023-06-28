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
            <div class="mt-3">
                <el-upload
                    action="/"
                    list-type="picture-card"
                    :on-preview="handlePictureCard"
                    :on-change="handleChange"
                    :auto-upload="false"
                    >
                    <el-button size="small" type="primary">Click to upload</el-button>
                    <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 500kb</div>
                </el-upload>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Create</button>
        </form>
    </div>
</template>
<script>
import axios from 'axios';
import { ElUpload, ElButton } from 'element-plus';
    export default {
        data() {
            return {
                post: {
                    title: '',
                    body: '',
                    post_image: [],

                }
            }
        },
        methods: {
        // async createPost() {
        //     try {
        //     const response = await axios.post('http://localhost:8000/post/create');
        //     axios.defaults.headers.common['X-CSRF-TOKEN'] =   response.data.csrfToken;
        //     console.log(response.data);
        //     this.fetchPosts(); // Richiama la funzione per ottenere i post aggiornati
        //     } catch (error) {
        //     console.log(error);
        //     }
        // },
        // async fetchPosts() {
        //     try {
        //     const response = await axios.get('http://localhost:8000/post/get_all');
        //     this.posts = response.data.data;
        //     } catch (error) {
        //     console.log(error);
        //     }
        // },
        createPost(e) {
  e.preventDefault();
  const formData = new FormData();
  formData.append('title', this.post.title);
  formData.append('body', this.post.body);
  formData.append('post_image', this.post.post_image);
  
  axios.post('http://localhost:8000/post/create', formData, {
    headers: {
      'Content-Type': 'multipart/form-data',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  })
  .then(response => {
    console.log(response);
  })
  .catch(error => {
    console.log(error);
  });
},

        handlePictureCard(file) {
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;
        },

        handleChange(file, fileList) {
            console.log(file, fileList);
            this.post.post_image.push(file.raw);
        }
    },
        components: {
            ElUpload,
            ElButton
        }
    }
</script>