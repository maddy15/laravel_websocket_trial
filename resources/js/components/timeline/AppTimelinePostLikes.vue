<template>
    <div>   
        <span class="text-secondary">
            {{ pluralize('like',this.post.likes,true) }}  from {{ pluralize('person',post.likers.data.length,true) }}
            
            <template v-if="post.author.data.liked">
                (including you)
            </template>
        </span>

        <ul class="list-inline mb-0">
            <li class="list-inline-item" v-if="canLike">
                <a href="#" @click.prevent="like">Like it</a>
            </li>
        </ul>
    </div>  
</template>

<script>
import pluralize from 'pluralize'
import { mapActions } from 'vuex'

export default {
    props : {
        post : {
            required : true,
            type : Object
        }
    },
    computed: {
        canLike() {
            if(this.post.author.data.owner)
            {
                return false;
            }

            if(this.post.author.data.likesRemaining <= 0)
            {
                return false;
            }

            return true;
        }
    },
    methods: {
        ...mapActions({
            likePost : 'likePost'
        }),
        pluralize,

        like()
        {
            this.likePost(this.post.id);
            console.log('test');
        }
    },
}
</script>

<style lang="scss" scoped>

</style>