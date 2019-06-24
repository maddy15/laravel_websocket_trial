<template>
    <form action="#" @submit.prevent="submit">
        <div class="form-group">
            <label for="body" class="sr-only">Share Something</label>
            <textarea 
            class="form-control"
            placeholder="Share Something" 
            rows="3"
            v-model="form.body"
            >
            
            </textarea>
        </div>

        <button class="btn btn-primary btn-block">Post It!</button>
    </form>
</template>

<script>
import { mapActions } from 'vuex';
    export default {
        data() {
            return {
                form:{
                    body: null
                }
            }
        },
        methods: {
            ...mapActions({
               createPost : 'createPost' 
            }),
            async submit() {
                await this.createPost(this.form);
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>