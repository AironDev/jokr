<template>
<!-- widget single item start -->
    <div class="card-small comments">
        <h4 class="widget-title">Comments <span class="ml-2"><i class="fa fa-caret-down"> </i></span></h4>
        <div class="widget-body">
            <ul class="like-page-list-wrapper" style="max-height: 200px; overflow-y:scroll">
                <li class="unorder-list mb-3" v-for="(comment, index) in comments">
                    <!-- profile picture end -->
                    <div class="profile-thumb">
                        <a href="#">
                            <figure class="profile-thumb-small">
                                <img src="assets/images/profile/profile-small-33.jpg" alt="profile picture">
                            </figure>
                        </a>
                    </div>
                    <!-- profile picture end -->

                    <div class="unorder-list-info w-100">
                        <h5 class="list-title"><a href="#">{{comment.user.display_name}}</a></h5>
                        <p class="list-subtitle comment-content">{{comment.content}} <span class="text-muted float-right mt-3" style="font-size: 9px">{{comment.date}}</span></p>
                    </div>
                </li>                       
            </ul>
            <div class="share-box-inner mt-4">
                    <!-- profile picture end -->
                    <div class="profile-thumb">
                        <a href="#">
                            <figure class="profile-thumb-small">
                                <img src="assets/images/profile/profile-small-29.jpg" alt="profile picture">
                            </figure>
                        </a>
                    </div>
                    <!-- profile picture end -->

                    <!-- share content box start -->
                    <div class="share-content-box w-100">
                        <form class="share-text-box" @submit.prevent="addComment()">
                            <textarea name="comment" v-model="newComment" class="share-text-field" aria-disabled="true" placeholder="What's your reaction?"  :id="post.id"></textarea>
                            <button class="btn-share" type="submit">send</button>
                        </form>
                    </div>
                    <!-- share content box end -->

                </div>
        </div>
    </div>
<!-- widget single item start -->
</template>

<script>
    export default {
        props: ['post', 'auth_user'],
        data: () => {
            return {
                newComment: '',
                comments: []
            }
        },

        methods: {

            getComments(){
                return axios.get(`/posts/${this.post.id}/comments`, {
                })
                .then(response => {
                        //console.log(response.data.data);
                        this.comments = (response.data.data);
                });  

            },

            addComment(){
                return axios.post(`/posts/${this.post.id}/comment`, {
                    content: this.newComment,
                    auth_user: this.auth_user
                })
                .then(response => {
                        //console.log(response.data.data);
                        this.comments.push(response.data.data);

                }); 


            }
            
            
        },

        computed: {

        },
        mounted() {
           // console.log("hello from post comment component");
           this.getComments();
        },

        created() {

        }
    }
</script>

<style>
    .comments .comment-content {
        padding:5px;   
    }

    .comments .like-page-list-wrapper li{
        border: thin solid whitesmoke;
        padding:10px;
    }
</style>


