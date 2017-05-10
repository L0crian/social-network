<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-default" v-for="post in posts">
                    <div class="panel-heading">
                        <img :src="post.user.avatar" width='40px' height='40px' alt="">
                           {{post.user.name}}
                    </div>
                    <div class="panel-body">
                        <p class="text-center">
                            {{post.content}}
                        </p>
                       <like :id="post.id"></like>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Like from './Like.vue'

    export default {
            mounted() {
                this.get_feed();
                },
            components: {
                Like
            },
            methods: {
                get_feed() {
                    axios.get('/feed')
                        .then( (resp) => {

                            resp.data.forEach( (post) => {
                                this.$store.commit('add_post', post);
                            });
                        });
                }
            },
            computed: {
                posts() {
                  return  this.$store.getters.all_posts;
                }
        }

    }
</script>

<style>

</style>