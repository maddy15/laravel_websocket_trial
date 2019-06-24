<template>
    <div>
        <app-timeline-create></app-timeline-create>

        <div class="timeline__posts">
            <app-timeline-post
                v-for="post in posts"
                :key="post.id"
                :post="post"
            ></app-timeline-post>
        </div>
    </div>
</template>

<script>
import { mapGetters,mapActions } from 'vuex';
    export default {
       computed: {
           ...mapGetters([
               'posts'
           ])
       },
       methods: {
           ...mapActions({
               getPosts : 'getPosts'
           })
       },
       mounted () {
           this.getPosts();
       },
    }
</script>

<style lang="scss" scoped>
    .timeline__posts
    {
        margin-top : 40px;
    }
</style>