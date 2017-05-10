<template>
    <div class="container">
    <hr>
    <p class="text-center" v-for="like in post.likes">
        <img :src="like.user.avatar" width="40px" height="40px" class="avatar" alt="">
    </p>
    <hr>
        <button class="btn btn-primary" v-if="!auth_user_likes_post" @click="like()">Like this post</button>
        <button class="btn btn-danger" v-else @click="unlike()">Unlike this post</button>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        computed: {
            likers() {
               var likers = [];

                this.post.likes.forEach( (like) => {
                    likers.push(like.user_id);
                });
                return likers;
            },
            auth_user_likes_post() {
                var check_index = this.likers.indexOf(
                    this.$store.state.auth_user.id
                );

                if(check_index === -1) {
                    return false;
                }
                else {
                    return true;
                }
            },
            post() {
                return this.$store.state.posts.find( (post) => {
                    return post.id === this.id
                });
            }
        },
        methods: {
            like() {
                axios.get('/like/' + this.id)
                    .then( (resp) => {
                        this.$store.commit('update_post_likes',{
                            id: this.id,
                            like: resp.data
                        });
                        new noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            text: 'You liked post'
                        }).show();
                    });
            },
            unlike() {
                axios.get('/unlike/' + this.id)
                    .then( (resp) => {

                       this.$store.commit('unlike_post',{
                           post_id: this.id,
                           like_id: resp.data
                       });

                        new noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            text: 'Your unliked this post'
                        }).show();
                    });
            },
        }
    }
</script>

<style>
.avatar{
    border-radius: 50%;
}
</style>