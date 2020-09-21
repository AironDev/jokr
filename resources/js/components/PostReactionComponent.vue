<template>
  <div class="app" style="margin: 20px 0px; text-align:center">
    <!-- <vue-feedback-reaction :labels="reactionNames" v-model="feedback" /> -->
        <button class="post-meta-like" title="Funny" style="margin: 0px 10px">
            <i v-if="user_reactions.funny == true"><img v-bind:src="'/assets/emoticons/excellent_active.png'" style="max-width: 1.5em"></i> 
            <i v-if="user_reactions.funny !=true"><img v-bind:src="'/assets/emoticons/excellent_inactive.png'" style="max-width: 1.5em"></i>   
        </button>
        <button class="post-meta-like" title="Not Funny" style="margin: 0px 10px">
            <i><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.5em"></i>
        </button>
        <button class="post-meta-like" title="SMH" style="margin: 0px 10px">
            <i><img v-bind:src="'/assets/emoticons/natural_inactive.png'" style="max-width: 1.5em"></i> 
        </button>
        <button class="post-meta-like" title="Mad Oh" style="margin: 0px 10px">
            <i><img v-bind:src="'/assets/emoticons/good_inactive.png'" style="max-width: 1.5em"></i> 
        </button>
        <button class="post-meta-like" title="Funny" style="margin: 0px 10px">
            <i><img v-bind:src="'/assets/emoticons/disappointed_inactive.png'" style="max-width: 1.5em"></i> 
        </button>
        <button class="post-meta-like" title="Funny" style="margin: 0px 10px">
            <i><img v-bind:src="'/assets/emoticons/disappointed_inactive.png'" style="max-width: 1.5em"></i> 
        </button>
        <button class="post-meta-like" title="Funny" style="margin: 0px 10px">
            <i><img v-bind:src="'/assets/emoticons/disappointed_inactive.png'" style="max-width: 1.5em"></i> 
        </button>
        <button class="post-meta-like" title="Funny" style="margin: 0px 10px">
            <i><img v-bind:src="'/assets/emoticons/disappointed_inactive.png'" style="max-width: 1.5em"></i> 
        </button>
        <button class="post-meta-like" title="Funny" style="margin: 0px 10px">
            <i><img v-bind:src="'/assets/emoticons/disappointed_inactive.png'" style="max-width: 1.5em"></i> 
        </button>
  </div>
</template>

<script>
  // import { VueFeedbackReaction } from 'vue-feedback-reaction';

  export default {

    name: 'demo',

    components: {
      //VueFeedbackReaction
    },

    props: ['labels', 'user_reactions'],

    data() {
      return {
        feedback: '',
        react: this.user_reactions,
        emojiNames:["not funny","omo","smh","madoh","asin-eh"],
        emoji: {
          funny: 'excellent_inactive',
          funny1: 'excellent_active'
        }
      }   
    },

    methods: {
        userReactions() {
            console.log(this.react);
        },
    },


    mounted() {
            this.userReactions();
    }

  };
</script>
