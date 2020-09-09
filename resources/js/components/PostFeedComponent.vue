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
                    <span class="" v-if="post.reactions.total >= 2">{{post.reactions.total}} people reacted this</span>
                    <span v-if="post.reactions.total == 1">{{post.reactions.total}} person reacted this</span>
                    <span class="" v-if="post.reactions.total == 0">Be the first to react</span>
                    <ul class="comment-share-meta float-right">
                        <li>
                            <button class="post-comment">
                                <i class="bi bi-chat-bubble"></i>
                                <span>4 {{type}}</span>
                            </button>
                        </li>
                        <li>
                            <button class="post-share">
                                <i class="bi bi-share"></i>
                                <span>{{post.reactions.points}}</span>
                            </button>
                        </li>
                    </ul>
                </div>
                

                <div class="app" style="margin: 20px 0px; text-align:center">
                    <button class="post-meta-like" @click="react(post, index, 'lol', reactionRate.lol)" title="Lol" style="margin: 0px 10px">
                        <i v-if="post.user_reactions.lol == true"><img v-bind:src="'/assets/emoticons/excellent_active.png'" style="max-width: 1.5em"></i> 
                        <i v-if="post.user_reactions.lol !=true"><img v-bind:src="'/assets/emoticons/excellent_inactive.png'" style="max-width: 1.5em"></i>   
                    </button>

                    <button class="post-meta-like" @click="react(post, index, 'notfunny', reactionRate.notfunny)" title="Not Funny" style="margin: 0px 10px">
                        <!-- <i ><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.5em"></i> -->
                        <i v-if="post.user_reactions.notfunny == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" style="max-width: 1.5em"></i> 
                        <i v-if="post.user_reactions.notfunny !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.5em"></i> 
                    </button>

                    <button class="post-meta-like" @click="react(post, index, 'asin', reactionRate.asin)" title="Asin Eh" style="margin: 0px 10px">
                        <!-- <i ><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.5em"></i> -->
                        <i v-if="post.user_reactions.asin == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" style="max-width: 1.5em"></i> 
                        <i v-if="post.user_reactions.asin !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.5em"></i> 
                    </button>

                    <button class="post-meta-like" @click="react(post, index, 'madoh', reactionRate.madoh)" title="Mad Oh" style="margin: 0px 10px">
                        <!-- <i ><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.5em"></i> -->
                        <i v-if="post.user_reactions.madoh == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" style="max-width: 1.5em"></i> 
                        <i v-if="post.user_reactions.madoh !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.5em"></i> 
                    </button>

                    <button class="post-meta-like" @click="react(post, index, 'smh', reactionRate.smh)" title="SMH" style="margin: 0px 10px">
                        <!-- <i ><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.5em"></i> -->
                        <i v-if="post.user_reactions.smh == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" style="max-width: 1.5em"></i> 
                        <i v-if="post.user_reactions.smh !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.5em"></i> 
                    </button>
                </div>
            </div>
        </div>
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
                auth: [],
                reactionRate: {
                    lol:2, //change funny
                    lwkmd:5, //-5 negative not funny didnt laugh
                    insidelife:3,
                    omo:2,
                    asin:2,
                    omo:1,
                    yfmh:3, //-3 negative
                    smh:1, //positive
                    nfdl:1
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


            getAuth () {
                var user = new Auth();
                return user.getAuth()
                    .then(response => {
                        this.auth = response.data;
                    }); 
            },

            loadMore () {
                window.onscroll = () => {
                    let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
                  
                    if (bottomOfWindow && this.load_more ) {
                        this.post.loadMore(this.options['next_page_url'], this.auth_user)
                            .then(response => {
                                this.posts = this.posts.concat(response.data);
                                this.options['next_page_url'] = response.links.next;
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

            react(post, index, type, rate){
                return axios.get(`api/post/react/?auth_user_id=${this.auth_user}&post_id=${post.id}&type=${type}&rate=${rate}`, {
                })
                .then(response => {
                    //console.log(response.data);
                    let userReactions = this.posts[index].user_reactions;
                    let postReaction = this.posts[index].reactions;
                    let totalReaction = this.posts[index].reactions.total;
                    console.log(userReactions);
                    
                    // for(let r in userReactions){
                    //     if(r == type){
                    //         console.log(type);
                    //         if(userReactions.funny == true){
                    //             return userReactions.funny = false;
                    //         }
                    //         return userReactions.funny = true;
                            
                    //     }
                    // }

                    switch(type){
                        case "lol":
                            if(userReactions.lol == true){
                                postReaction.points = postReaction.points-rate;
                                totalReaction = totalReaction-rate;
                                return userReactions.lol = false;
                            }
                            postReaction.points = postReaction.points+rate;
                            return userReactions.lol = true;
                        break;

                        case "notfunny":
                            if(userReactions.notfunny == true){
                                postReaction.points = postReaction.points+rate;
                                return userReactions.notfunny = false;
                            }
                            postReaction.points = postReaction.points-rate;
                            return userReactions.notfunny = true;
                        break;

                        case "madoh":
                            if(userReactions.madoh == true){
                                postReaction.points = postReaction.points-rate;
                                return userReactions.madoh = false;
                            }
                            postReaction.points = postReaction.points+rate;
                            return userReactions.madoh = true;
                        break;

                        case "asin":
                            if(userReactions.asin == true){
                                postReaction.points = postReaction.points-rate;
                                return userReactions.asin = false;
                            }
                            postReaction.points = postReaction.points+rate;
                            return userReactions.asin = true;
                        break;

                        case "smh":
                            if(userReactions.smh == true){
                                postReaction.points = postReaction.points+rate;
                                return userReactions.smh = false;
                            }
                            postReaction.points = postReaction.points-rate;
                            return userReactions.smh = true;
                        break;

                        case "ewo":
                            if(userReactions.smh == true){
                                postReaction.points = postReaction.points+rate;
                                return userReactions.smh = false;
                            }
                            postReaction.points = postReaction.points-rate;
                            return userReactions.smh = true;
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
            this.getAuth();
            this.getPost();
            this.loadMore();  
        },

        created(){

        }
    }
</script>

<style>
    .post-desc video, iframe, img {
        max-width: 100%;
        max-height: 100%;
    }

    .post-reaction-meta {
        background: #e8e8e8;
        padding: 10px;
        border: thin solid #efe5e5;
        margin: -10px;
        color: gray;
}
</style>


