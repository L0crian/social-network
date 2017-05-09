<template>
    <li>
        <a href="/notifications">Undread Notifications <span class="badge">{{all_nots_count}}</span></a>
    </li>
</template>

<script>
    export default {
            mounted() {
                this.get_unread();
            },
            methods: {
                get_unread() {
                    axios.get('/get_unread')
                        .then( (nots) => {
                            console.log("hey there");
                            console.log(nots.data);
                            nots.data.forEach( (not) => {
                                this.$store.commit('add_not', not);
                            });
                        });
                }
            },
            computed: {
                all_nots_count: function() {
                    return this.$store.getters.all_nots_count;
                }
            }
    }
</script>

<style>

</style>