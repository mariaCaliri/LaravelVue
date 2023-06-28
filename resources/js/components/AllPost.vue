<template>
  <div>
    <h1>All Posts</h1>
    <div class="container">
      <div class="row">
        <div class="col-md-6" v-for="(post, i) in posts" :key="i">
          <div class="card mt-4">
            <img src="https://picsum.photos/100/200" alt="" class="card-image-top">
            <div class="card-body">
              <p class="card-text">
                <strong>{{ post.title }}</strong><br>
                {{ truncateText(post.body) }}
              </p>
            </div>
            <el-button text @click="openModal(post)">
              Click to open the Dialog
            </el-button>
          </div>
        </div>
      </div>
    </div>
    <div>
      <el-dialog
        v-if="postDetailVisible"
        :visible.sync="postDetailVisible"
        :title="currentPost.title"
        width="30%"
        :before-close="handleClose"
      >
        <div class="row">
          <div class="col-md-6">
            <img src="https://picsum.photos/100/200" alt="" class="img-thumbnail">
          </div>
          <div class="col-md-6">
            <p class="card-text">
              <strong>{{ currentPost.title }}</strong><br>
              {{ currentPost.body }}
            </p>
          </div>
        </div>
        <span>This is a message</span>
        <span slot="footer" class="dialog-footer">
          <el-button @click="handleClose">Cancel</el-button>
          <el-button type="primary" @click="handleConfirm">Confirm</el-button>
        </span>
      </el-dialog>
    </div>
  </div>
</template>

  
  <script>
  import { ElButton, ElDialog, ElMessageBox } from 'element-plus';
  import axios from 'axios';

  
  export default {
  async created() {
    try {
      const response = await axios.get('http://localhost:8000/post/get_all');
      this.posts = response.data.data;
      console.log(response.data);
    } catch (error) {
      console.log(error);
    }
  },

    components: {
      ElButton,
      ElDialog
    },
    data() {
      return {
        posts: [
        //   {
        //     id: 1,
        //     post_image: [
        //       {
        //         path: 'https://picsum.photos/100/200'
        //       }
        //     ],
        //     title: 'Post One',
        //     body: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'
        //   },
        //   {
        //     id: 2,
        //     post_image: [
        //       {
        //         path: 'https://picsum.photos/100/200'
        //       }
        //     ],
        //     title: 'Post Two',
        //     body: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'
        //   },
        //   {
        //     id: 3,
        //     post_image: [
        //       {
        //         path: 'https://picsum.photos/100/200'
        //       }
        //     ],
        //     title: 'Post Three',
        //     body: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'
        //   },
        //   {
        //     id: 4,
        //     post_image: [
        //       {
        //         path: 'https://picsum.photos/100/200'
        //       }
        //     ],
        //     title: 'Post Four',
        //     body: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'
        //   }
        ],
    
        currentPost: null,
        postDetailVisible: false,
    
      }
    },
    methods: {
      truncateText(text) {
        return text ? text.substring(0, 30) + '...' : '';
      },
      openModal(post) {
        this.currentPost = post;
        this.postDetailVisible = true;
        console.log(post);
        
      },
      handleClose(done) {
        ElMessageBox.confirm('Are you sure to close this dialog?')
          .then(() => {
            done();
          })
          .catch(() => {
            // Handle error or cancel
          });
      },
      handleConfirm() {
        // Handle modal confirmation
        this.postDetailVisible = false;
      },
        openModal() {
            this.modalVisible = true;
        }
    }
  }
  </script>
  