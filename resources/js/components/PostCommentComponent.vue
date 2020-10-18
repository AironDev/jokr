<template>
<!-- widget single item start -->
    <div class="card-small comments p-0">
        <h4 class="widget-title"><a href="#" @click.prevent="toggleComments()" style="color:#e8e8e8;">Comments <span class="ml-1"><i class="fa fa-caret-down"> </i></span></a></h4>
        <div class="widget-body" v-if="commentDisplay">
            <ul class="like-page-list-wrapper"  id="comments" style="max-height: 200px; overflow-y:scroll">
                <li class="unorder-list mb-3" v-for="(comment, index) in comments" v-bind:key="index">
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
                    <!-- <div class="profile-thumb">
                        <a href="#">
                            <figure class="profile-thumb-small">
                                <img src="assets/images/profile/profile-small-29.jpg" alt="profile picture">
                            </figure>
                        </a>
                    </div> -->
                    <!-- profile picture end -->

                    <!-- share content box start -->
                    <div class="share-content-box w-100">
                        <form class="share-text-box" @submit.prevent="addComment()">
                            <textarea name="comment" id="newComment" v-model="newComment" class="share-text-field autoresize" aria-disabled="true" placeholder="What's your reaction?"  :id="post.id"></textarea>
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
                comments: [],
                showComments: false,
            }
        },

        methods: {

            getComments(){
                return axios.get(`/posts/${this.post.id}/comments`, {
                    params: {}
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
                        console.log(response.data.data);
                        this.comments.push(response.data.data);

                }); 


            },

            toggleComments(event){
                if(this.showComments == false){
                    this.showComments = true;
                    jQuery(document).ready(function() {
                        setTimeout(function() { 
                           jQuery('textarea.autoresize').autoHeight();
                        }, 1000);
           
                    });
                }else{
                    this.showComments = false;
                }
                console.log(this.showC);
            }
            
        },

        computed: {
            commentDisplay: function() {
                return this.showComments;
            }
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

    .hidden{
        display: none;
    }

    .comments .share-text-box .share-text-field {
        padding: 13px 1px 13px 20px;
        position: relative;
        border-radius: 10px;
    }

    @media only screen and (max-width: 479.98px) {
      .comments .share-text-box .btn-share {
        display: flex !important;
        top: 95%;
        padding: 10px 20px;
      }
    }
</style>


