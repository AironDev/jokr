<template>
    <div class="post-reaction-buttons">
        <button class="post-meta-like" @click="react(post.id, 'lol', reactionRate.lol)" title="Lol" style="margin: 0px 1px">
            <i v-if="post.user_reactions.lol == true"><img v-bind:src="'/assets/emoticons/excellent_active.png'" class="emoji"></i> 
            <i v-if="post.user_reactions.lol !=true"><img v-bind:src="'/assets/emoticons/excellent_inactive.png'" class="emoji"></i>   
        </button>

        <!-- <button class="post-meta-like" @click="react(post.id, 'lwkmd', reactionRate.lwkmd)" title="lwkmd" style="margin: 0px 10px">
            <i v-if="post.user_reactions.lwkmd == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" style="max-width: 1.2em"></i> 
            <i v-if="post.user_reactions.lwkmd !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.2em"></i> 
        </button> -->

        <button class="post-meta-like" @click="react(post.id, 'insidelife', reactionRate.insidelife)" title="insidelife" style="margin: 0px 1px">
            <i v-if="post.user_reactions.insidelife == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
            <i v-if="post.user_reactions.insidelife !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
        </button>

        <button class="post-meta-like" @click="react(post.id, 'omo', reactionRate.omo)" title="omo" style="margin: 0px 1px">
            <i v-if="post.user_reactions.omo == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
            <i v-if="post.user_reactions.omo !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
        </button>

        <button class="post-meta-like" @click="react(post.id, 'asin', reactionRate.asin)" title="asin" style="margin: 0px 1px">
            <i v-if="post.user_reactions.asin == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
            <i v-if="post.user_reactions.asin !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
        </button>

        <button class="post-meta-like" @click="react(post.id, 'smh', reactionRate.smh)" title="smh" style="margin: 0px 1px">
            <i v-if="post.user_reactions.smh == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
            <i v-if="post.user_reactions.smh !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
        </button>

        <!-- <button class="post-meta-like" @click="react(post.id, 'yfmh', reactionRate.yfmh)" title="yfmh" style="margin: 0px 1px">
            <i v-if="post.user_reactions.yfmh == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" style="max-width: 1.2em"></i> 
            <i v-if="post.user_reactions.yfmh !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" style="max-width: 1.2em"></i> 
        </button> -->

        <button class="post-meta-like" @click="react(post.id, 'mtcheew', reactionRate.mtcheew)" title="mtcheew" style="margin: 0px 1px">
            <i v-if="post.user_reactions.mtcheew == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
            <i v-if="post.user_reactions.mtcheew !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
        </button>

        <button class="post-meta-like" @click="react(post.id, 'nfdl', reactionRate.nfdl)" title="nfdl" style="margin: 0px 1px">
            <i v-if="post.user_reactions.nfdl == true"><img v-bind:src="'/assets/emoticons/hate_active.png'" class="emoji"></i> 
            <i v-if="post.user_reactions.nfdl !=true"><img v-bind:src="'/assets/emoticons/hate_inactive.png'" class="emoji"></i> 
        </button>
    </div>
</template>

<script>
  // import { VueFeedbackReaction } from 'vue-feedback-reaction';

  export default {

    // name: 'post-reactions',

    components: {
      //VueFeedbackReaction
    },

    props: ['post', 'auth_user'],

    data() {
      return {

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
        sayHi() {
            //console.log('hello from post reaction component');
        },

        react(post_id, type, rate){
            return axios.get(`post/react/?auth_user_id=${this.auth_user}&post_id=${post_id}&type=${type}&rate=${rate}`, {
            })
            .then(response => {

                let userReactions = this.post.user_reactions;
                let postReaction = this.post.reactions;

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

    mounted() {
            this.sayHi();
    }

  };
</script>

