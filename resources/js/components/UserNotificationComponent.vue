<template>
<!-- widget single item start -->
    <div class="card widget-item" style="max-height:420px; overflow:scroll">
        <h4 class="widget-title">Recent Notifications</h4>
        <div class="widget-body">
            <ul class="like-page-list-wrapper" v-for="notification in notifications">
                <li class="unorder-list" style="margin-bottom: 20px">
                    
                    <div class="profile-thumb">
                        <a href="#">
                            <figure class="profile-thumb-small">
                                <img :src="'uploads/avatars/' + notification.photo" alt="profile picture">
                            </figure>
                        </a>
                    </div>
                    

                    <div class="unorder-list-info">
                        <h3 class="list-title"><a href="#">{{notification.message}}</a></h3>
                        <p class="list-subtitle">{{notification.date}}</p>
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
                return axios.get(`/user/notifications`, {

                })
                    .then(response => {
                        this.notifications = response.data.data;
                        // console.log(this.notifications);
                        
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


