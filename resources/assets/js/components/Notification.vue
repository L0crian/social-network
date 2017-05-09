<template>

</template>

<script>
    export default {
        mounted() {
            this.listen();
        },
        props: ['id'],
        methods: {
            listen: function () {
                Echo.private('App.User.' + this.id)
                    .notification((notification) =>
                    {
                        new noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            text: notification.name + notification.message
                        }).show();
                        document.getElementById("noty_audio").play();
                        this.$store.commit('add_not', notification);
                    })
            }
        }

    }
</script>

<style>

</style>