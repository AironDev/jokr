class PostService{


    constructor(){

    }
 
     
     getPost(){
        return axios.get('/posts', {
        })
        .then(response => {
            return response.data;
        }).catch(err => {
            console.log(err);
        })
    }


    // getUserReaction(user_id, post_id){
    //     return axios.get('http://jokr.air/api/posts', {
    //     })
    //     .then(response => {
    //         return response.data;
    //     }).catch(err => {
    //         console.log(err);
    //     })
    // }


    loadMore(next_page){
         return axios.get(`${next_page}` , {
        })
         .then(response => {
            return response.data;
        }).catch(err => {
            console.log(err);
        })
    }

    getTrend(commentId, ownerId){
        return axios.post('/api/comments/' + commentId, {
            ownerId: ownerId
        })
        .then(response => {
            response = {
                data: response.data,
                message: "comment deleted successfully"
            }
            return response;
        }).catch(err => {
            console.log(err);
        })
    }


    deletePost(commentId, replyId, ownerId){
        return axios.post('/api/comments/' + commentId + '/replies/' + replyId,{
            ownerId: ownerId
        })
        .then(response => {
            response = {
                data: response.data,
                message: "reply deleted successfully"
            }
            return response;
        }).catch(err => {
            console.log(err);
        })
    }


    updatePost(commentId, ownerId, content){
        return axios.patch('/api/comments/' + commentId, {
            content: content,
            ownerId: ownerId
        })
        .then(response => {
            response = {
                data: response.data,
                message: "comment updated successfully"
            }
            return response;
        })
    }

}

export default PostService;