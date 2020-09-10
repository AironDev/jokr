<template>
<!-- widget single item start -->
    <div class="card widget-item" style="max-height:420px; overflow:scroll">
        <h4 class="widget-title">Recent Notifications</h4>
        <div class="widget-body">
            <ul class="like-page-list-wrapper" v-for="notification in notifications">
                <li class="unorder-list" style="margin-bottom: 20px">
                    <!-- profile picture end -->
                    <div class="profile-thumb">
                        <a href="#">
                            <figure class="profile-thumb-small">
                                <img src="assets/images/profile/profile-small-9.jpg" alt="profile picture">
                            </figure>
                        </a>
                    </div>
                    <!-- profile picture end -->

                    <div class="unorder-list-info">
                        <h3 class="list-title"><a href="#">{{`${notification.user_id} and ${notification.reaction_count} others, reacted to your post ${notification.post_id}`}}</a></h3>
                        <p class="list-subtitle">5 min ago</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<!-- widget single item end -->
</template>

<script>
    export default {
        props: ['profile', 'auth_user'],
        data() {
            return {
                notifications: []
            }
        },

        methods: {
            getNotifications () {
                return axios.get(`notifications/?user_id=${this.auth_user}`, {

                })
                    .then(response => {
                        this.notifications = response.data;
                        //console.log(this.notifications);
                        
                    }); 
            },
        },

        computed: {

        },
        mounted() {
            this.getNotifications();
        },

        created() {

        }
    }
</script>

<style>
    
</style>


