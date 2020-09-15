<template>
<div>
    <div class="card"  v-for="(post, index) in posts" >
        <!-- post title start -->
        <div class="post-title d-flex align-items-center">
            <!-- profile picture end -->
            <div class="profile-thumb">
                <a href="#">
                    <figure class="profile-thumb-middle">
                        <img v-bind:src="post.user.photo" alt="profile picture">
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
            <div class="post-thumb-gallery">
                
            </div>
            <div class="post-meta" style="display:block">
                <div class="post-reaction-meta">
                    <!-- <span class="" v-if="post.reactions.total >= 2">{{post.reactions.total}} people reacted this</span>
                    <span v-if="post.reactions.total == 1">{{post.reactions.total}} person reacted this</span>
                    <span class="" v-if="post.reactions.total == 0">Be the first to react</span> -->
                    <ul class="comment-share-meta float-right">
                        <li>
                            <button class="post-comment">
                                <i class="bi bi-chat-bubble"></i>
                                <span>{{post.reactions.total}}</span>
                            </button>
                        </li>
                        <li>
                            <button class="post-share">
                                <i class="bi bi-share"></i>
                                <span>{{post.reactions.points}}</span>
                            </button>
                        </li>
                    </ul>
             
                

                
                    <button class="post-meta-like" @click="react(post.id, index, 'lol', reactionRate.lol)" title="Lol" style="margin: 0px 1px">
                        <i v-if="post.user_reactions.lol == true"><img v-bind:src="'/assets/emoticons/excellent_active.png'" class="emoji"></i> 
                        <i v-if="post.user_reactions.lol !=true"><img v-bind:src="'/assets/emoticons/excellent_inactive.png'" class="emoji"></i>   
                    </button>

                    <!-- <button class="post-meta-like" @click="react(post.id, index, 'lwkmd', reactionRate.lwkmd)" title="lwkmd" style="margin: 0px 10px">
                        <i v-if="post.user_reactions.lwkmd == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" style="max-width: 1.2em"></i> 
                        <i v-if="post.user_reactions.lwkmd !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.2em"></i> 
                    </button> -->

                    <button class="post-meta-like" @click="react(post.id, index, 'insidelife', reactionRate.insidelife)" title="insidelife" style="margin: 0px 1px">
                        <i v-if="post.user_reactions.insidelife == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
                        <i v-if="post.user_reactions.insidelife !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
                    </button>

                    <button class="post-meta-like" @click="react(post.id, index, 'omo', reactionRate.omo)" title="omo" style="margin: 0px 1px">
                        <i v-if="post.user_reactions.omo == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
                        <i v-if="post.user_reactions.omo !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
                    </button>

                    <button class="post-meta-like" @click="react(post.id, index, 'asin', reactionRate.asin)" title="asin" style="margin: 0px 1px">
                        <i v-if="post.user_reactions.asin == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
                        <i v-if="post.user_reactions.asin !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
                    </button>

                    <button class="post-meta-like" @click="react(post.id, index, 'smh', reactionRate.smh)" title="smh" style="margin: 0px 1px">
                        <i v-if="post.user_reactions.smh == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
                        <i v-if="post.user_reactions.smh !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
                    </button>

                    <!-- <button class="post-meta-like" @click="react(post.id, index, 'yfmh', reactionRate.yfmh)" title="yfmh" style="margin: 0px 1px">
                        <i v-if="post.user_reactions.yfmh == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" style="max-width: 1.2em"></i> 
                        <i v-if="post.user_reactions.yfmh !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.2em"></i> 
                    </button> -->

                    <button class="post-meta-like" @click="react(post.id, index, 'mtcheew', reactionRate.mtcheew)" title="mtcheew" style="margin: 0px 1px">
                        <i v-if="post.user_reactions.mtcheew == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
                        <i v-if="post.user_reactions.mtcheew !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
                    </button>

                    <button class="post-meta-like" @click="react(post.id, index, 'nfdl', reactionRate.nfdl)" title="nfdl" style="margin: 0px 1px">
                        <i v-if="post.user_reactions.nfdl == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
                        <i v-if="post.user_reactions.nfdl !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
                    </button>

                </div>
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
    export default {
        props: ['profile', 'auth_user'],
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

            react(post_id, index, type, rate){
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
</style>


