<template>
<div>
    <div class="card" v-for="post in posts">
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
            <div class="post-meta">
                <button class="post-meta-like">
                    <i class="bi bi-heart-beat"></i>
                    <span>You and 101 people like this</span>
                    <strong>201</strong>
                </button>
                <ul class="comment-share-meta">
                    <li>
                        <button class="post-comment">
                            <i class="bi bi-chat-bubble"></i>
                            <span>41</span>
                        </button>
                    </li>
                    <li>
                        <button class="post-share">
                            <i class="bi bi-share"></i>
                            <span>07</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import Post from '../services/PostService';
    export default {
        props: ['profile'],
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
            }
        },

        methods: {
            getPost () {
                return this.post.getPost()
                    .then(response => {
                        this.posts = response.data;
                        this.options['total'] = response.meta.total;
                        this.options['last_page_url'] = response.links.last;
                        this.options['next_page_url'] = response.links.next;
                        this.options['current_page_url'] = response.links.first;
                    }); 
            },

            loadMore () {
                window.onscroll = () => {
                    let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
                  
                    if (bottomOfWindow && this.load_more ) {
                        this.post.loadMore(this.options['next_page_url'])
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
        },

        computed: {

        },
        mounted() {
            this.getPost();
            this.loadMore();
            
            
        }
    }
</script>

<style>
    .post-desc video, iframe, img {
        max-width: 100%;
        max-height: 100%;
    }
</style>


