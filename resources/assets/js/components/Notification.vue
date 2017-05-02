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
                        alert('new notification');
                        console.log(notification);
                    })
            }
        }

    }
</script>

<style>

</style>