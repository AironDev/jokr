<template>
<!-- widget single item start -->
    <div class="card card-profile widget-item p-0">
        <div class="profile-banner">
            <figure class="profile-banner-small">
                <a href="profile.html">
                    <img src="assets/images/banner/banner-small.jpg" alt="">
                </a>
                <a href="profile.html" class="profile-thumb-2">
                    <img src="assets/images/profile/profile-midle-1.jpg" alt="">
                </a>
            </figure>
            <div class="profile-desc text-center">
                <h6 class="author"><a href="{{route('profile')}}">Dimbel Lebmid</a></h6>
                <p>Any one can join with but Social network us if you want Any one can join with us if you want</p>
            </div>
        </div>
    </div>
<!-- widget single item start -->
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
                        this.notifications = response.data.data;
                        console.log(this.notifications);
                        
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


