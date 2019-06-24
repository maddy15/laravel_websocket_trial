import store from './store'

Echo.channel('posts')
    .listen('PostCreated', (e) => {
        store.dispatch('getPost',e.post);
    })
    .listen('PostLikeCreated', (e) => {
        console.log(e);
        store.dispatch('getLikePost',e.post);
    })