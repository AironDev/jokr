<template>
<div>
    <div class="card"  v-for="(post, index) in posts" >
        <!-- post title start -->
        <div class="post-title d-flex align-items-center">
            <!-- profile picture end -->
            <div class="profile-thumb">
                <a href="#">
                    <figure class="profile-thumb-middle">
                        <img v-bind:src="'uploads/avatars/' + post.user.photo" alt="profile picture">
                    </figure>
                </a>
            </div>
            <!-- profile picture end -->
            

            <div class="posted-author">
                <h6 class="author"><a :href="profile +'/' + post.user.username">{{post.user.display_name}}</a></h6>
                <span class="post-time">40 min ago</span>
            </div>

            <div class="post-settings-bar">
                <span></span>
                <span></span>
                <span></span>
                <div class="post-settings arrow-shape">
                    <ul>
                        <li><button>copy link to adda</button></li>
                        <li><button>edit post</button></li>
                        <li><button>embed adda</button></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- post title start -->
        <div class="post-content">
            <div class="post-desc" v-html="post.content"> 
            </div>
            <div class="post-meta" style="display:block">
                <!-- post reaction component -->
                <post-reactions
                    :post="post"
                    :auth_user="auth_user"
                />
            </div>

            <div class="post-comments mt-3">
                <post-comments />
            </div>

        </div>
    </div>
    <div class="card">
        <H3>Loading</H3>
    </div>
</div>
</template>

<script>
    import Post from '../services/PostService';
    import Auth from '../services/AuthService';
    import PostReactions from './PostReactionComponent.vue';
    import PostComments from './PostCommentComponent.vue';
    export default {
        props: ['profile', 'auth_user'],

        components: {
            PostReactions,
            PostComments,
        },

        data() {
            return {
                post: new Post(),
                posts: [],
                options: [
                    'current_page_url',
                    'last_page_url',
                    'next_page_url',
                    'total',
                ],

                load_more: true,
                reactionRate: {
                    lol:3, // positve - laugh out loud
                    lwkmd:3, // positive - laugh wan kii me die
                    insidelife:1, //positive
                    omo:1, //positive
                    asin:2, //positive
                    smh:3, //negative
                    mtcheew:2, //negative
                    nfdl:2, //negative
                    yfmh:2, // negative
                    
                }
            }
        },

        methods: {
            getPost () {
                return this.post.getPost(this.auth_user)
                    .then(response => {
                        this.posts = response.data;
                        this.options['total'] = response.meta.total;
                        this.options['last_page_url'] = response.links.last;
                        this.options['next_page_url'] = response.links.next;
                        this.options['current_page_url'] = response.links.first;
                    }); 
            },

            scroll () {
                window.onscroll = () => {
                let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) + window.innerHeight >= document.documentElement.offsetHeight;

                  
                    if (bottomOfWindow && this.load_more) {
                        this.post.loadMore(this.options['next_page_url'], this.auth_user)
                            .then(response => {
                                this.posts = this.posts.concat(response.data);
                                this.options['next_page_url'] = response.links.next;
                                //console.log(this.posts);
                            }).catch(err => {
                                console.log(err);
                            });
                    if(this.options['last_page_url'] == this.options['next_page_url']){
                        this.load_more = false;
                        console.log('last page loaded');
                    }
                  }
                };
            },

            reactOLD(post_id, index, type, rate){
                return axios.get(`post/react/?auth_user_id=${this.auth_user}&post_id=${post_id}&type=${type}&rate=${rate}`, {
                })
                .then(response => {

                    let userReactions = this.posts[index].user_reactions;
                    let postReaction = this.posts[index].reactions;

                     //response payload contains current post points and total reactions
                    let reactionResponse = response.data;
                    
                    switch(type){
                        case "lol":
                            if(userReactions.lol == true){
                                postReaction.points = reactionResponse.points;
                                postReaction.total = reactionResponse.total;
                                return userReactions.lol = false;
                            }
                            postReaction.points = reactionResponse.points;
                            postReaction.total = reactionResponse.total;
                            return userReactions.lol = true;
                        break;

                        case "lwkmd":
                            if(userReactions.lwkmd == true){
                                postReaction.points = reactionResponse.points;
                                postReaction.total = reactionResponse.total;
                                return userReactions.lwkmd = false;
                            }
                            postReaction.points = reactionResponse.points;
                            postReaction.total = reactionResponse.total;
                            return userReactions.lwkmd = true;
                        break;

                        case "insidelife":
                            if(userReactions.insidelife == true){
                                postReaction.points = reactionResponse.points;
                                postReaction.total = reactionResponse.total;
                                return userReactions.insidelife = false;
                            }
                            postReaction.points = reactionResponse.points;
                            postReaction.total = reactionResponse.total;
                            return userReactions.insidelife = true;
                        break;

                        case "omo":
                            if(userReactions.omo == true){
                                postReaction.points = reactionResponse.points;
                                postReaction.total = reactionResponse.total;
                                return userReactions.omo = false;
                            }
                            postReaction.points = reactionResponse.points;
                            postReaction.total = reactionResponse.total;
                            return userReactions.omo = true;
                        break;

                        case "asin":
                            if(userReactions.asin == true){
                                postReaction.points = reactionResponse.points;
                                postReaction.total = reactionResponse.total;
                                return userReactions.asin = false;
                            }
                            postReaction.points = reactionResponse.points;
                            postReaction.total = reactionResponse.total;
                            return userReactions.asin = true;
                        break;

                        case "smh":
                            if(userReactions.smh == true){
                                postReaction.points = reactionResponse.points;
                                postReaction.total = reactionResponse.total;
                                return userReactions.smh = false;
                            }
                            postReaction.points = reactionResponse.points;
                            postReaction.total = reactionResponse.total;
                            return userReactions.smh = true;
                        break;

                        case "mtcheew":
                            if(userReactions.mtcheew == true){
                                postReaction.points = reactionResponse.points;
                                postReaction.total = reactionResponse.total;
                                return userReactions.mtcheew = false;
                            }
                            postReaction.points = reactionResponse.points;
                            postReaction.total = reactionResponse.total;
                            return userReactions.mtcheew = true;
                        break;

                        case "nfdl":
                            if(userReactions.nfdl == true){
                                postReaction.points = reactionResponse.points;
                                postReaction.total = reactionResponse.total;
                                return userReactions.nfdl = false;
                            }
                            postReaction.points = reactionResponse.points;
                            postReaction.total = reactionResponse.total;
                            return userReactions.nfdl = true;
                        break;

                        case "yfmh":
                            if(userReactions.yfmh == true){
                                postReaction.points = reactionResponse.points;
                                postReaction.total = reactionResponse.total;
                                return userReactions.yfmh = false;
                            }
                            postReaction.points = reactionResponse.points;
                            postReaction.total = reactionResponse.total;
                            return userReactions.yfmh = true;
                        break;

                    }
                })
                .catch(err => {
                    console.log(err);
                })
            },

        },

        computed: {

        },
        mounted() {
            // this.getPost();
            this.scroll();  
        },

        created(){

            this.getPost();
            //this.loadMore();  

        }
    }
</script>

<style>
    .post-desc video, .post-desc iframe, .post-desc img {
        max-width: 100%;
        max-height: 100%;
        width:95%;
        text-align:center;
    }

    .post-reaction-meta {
        background: #e8e8e8;
        padding: 10px;
        border: thin solid #efe5e5;
        margin: -10px;
        color: gray;
    }

    .post-reaction-meta  .emoji{
        max-width: 1.5em;

    }

    @media only screen and (max-width: 600px){
        .post-reaction-meta .emoji{
            max-width: 1.2em;
        }
    }

    @media only screen and (max-width: 420px){
        .post-reaction-meta .post-reaction-buttons {
            overflow-x: scroll;
            display: inline-flex;
        }

        .post-meta .comment-share-meta li {
            display: inline-block;
            margin-left: 4px;
        }


        .post-meta-like i, .post-comment i, .post-share i {
            font-size: 16px;
            color: #333333;
            vertical-align: baseline;
        }


    }
</style>


