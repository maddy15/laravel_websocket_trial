<template>
    <div class="timeline__post media">
        <img :src="post.author.data.avatar" alt="" class="mr-3 rounded timeline__avatar">
        <div class="media-body">
            <div class="font-weight-bold">
                {{ post.author.data.name }}
            </div>
            <p>
                {{ post.body }}
            </p>
            <app-timeline-post-likes :post="post"></app-timeline-post-likes>
        </div>
    </div>
</template>

<script>
    export default {
        props : {
            post : {
                required : true
            }
        }
    }
</script>

<style lang="scss" scoped>
    .timeline__post
    {
        background:#fff;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .timeline__avatar
    {
        width: 60px;
    }
</style>