<template>
        <div style="margin: 10px">
           <p class="text-center" v-if="loading">
               Loading...
           </p>
            <p class="text-center" v-if="!loading">
                <button class="btn btn-primary" @click="add_friend" v-if="status==0">Add friend</button>
                <button class="btn btn-primary" @click="accept_friend" v-if="status== 'pending'">Accept friend</button>
                <button class="btn btn-primary" v-if="status== 'friends'">Friends</button>
                <span v-if="status == 'waiting'">Waiting for request</span>
            </p>
        </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/check_relationships_status/' + this.profile_user_id)
                .then((resp) => {
                console.log(resp);
                this.status = resp.data.status;
                this.loading = false;
            });
        },
        data () {
           return {
               status: '',
               loading: true
           }
        },
        props: ['profile_user_id'],
        methods: {
            add_friend() {
                this.loading = true
                axios.get('/add_friend/' + this.profile_user_id )
                    .then( (r) => {
                        if(r.data == 1)
                            this.status = 'waiting';
                        noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            text: 'Friend request sent .'
                        })
                        this.loading = false;
                    })
            },
            accept_friend() {
                this.loading = true
                axios.get('/accept_friend/' + this.profile_user_id )
                    .then( (r) => {
                        if(r.data == 1)
                            this.status = 'friends';
                        noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            text: 'You are now friend. Go ahead and hangout .'
                        })
                        this.loading = false;
                    })
            }
        }
    }
</script>

<style>

</style>