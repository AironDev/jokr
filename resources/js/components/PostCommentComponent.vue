<template>
<!-- widget single item start -->
    <div class="card-small comments">
        <h4 class="widget-title">Comments <span class="ml-2"><i class="fa fa-caret-down"> </i></span></h4>
        <div class="widget-body">
            <ul class="like-page-list-wrapper" style="max-height: 200px; overflow-y:scroll">
                <li class="unorder-list">
                    <!-- profile picture end -->
                    <div class="profile-thumb">
                        <a href="#">
                            <figure class="profile-thumb-small">
                                <img src="assets/images/profile/profile-small-33.jpg" alt="profile picture">
                            </figure>
                        </a>
                    </div>
                    <!-- profile picture end -->

                    <div class="unorder-list-info">
                        <h3 class="list-title"><a href="#">{{comments[0].user.display_name}}</a></h3>
                        <p class="list-subtitle comment-content"><a href="#">{{comments[0].content}}</a></p>
                    </div>
                </li>                       
                <li class="unorder-list">
                    <!-- profile picture end -->
                    <div class="profile-thumb">
                        <a href="#">
                            <figure class="profile-thumb-small">
                                <img src="assets/images/profile/profile-small-29.jpg" alt="profile picture">
                            </figure>
                        </a>
                    </div>
                    <!-- profile picture end -->

                    <div class="unorder-list-info">
                        <h3 class="list-title"><a href="#">Kenneth</a></h3>
                        <p class="list-subtitle comment-content" style="text-transform:none"><a href="#">My brother the thing tire me oh, how do even explain the fact that this my comment actually says nothing</a></p>
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
                        <form class="share-text-box">
                            <textarea name="comment" class="share-text-field" aria-disabled="true" placeholder="What's your reaction?"  id="comment"></textarea>
                            <button class="btn-share" type="submit">comment</button>
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
        props: ['profile', 'auth_user'],
        data: () => {
            return {
                comments: [
                    {
                        id: 1,
                        post_id: 2,
                        user: {
                            id: 1,
                            name: 'Airon',
                            display_name: 'Airon Dev',
                            photo: 'airondev-avatar.jpg',
                        },
                        content: 'What in the name of God, is this guy talking',
                        privacy: ['public']
                    },
                ]
            }
        },

        methods: {
            
        },

        computed: {

        },
        mounted() {
            console.log("hello from post comment component");
        },

        created() {

        }
    }
</script>

<style>
    .comments .comment-content {
        background: whitesmoke;
        padding: 10px;
        border-radius: 20px;
}
</style>


