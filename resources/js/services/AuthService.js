class AuthService{

    constructor(){

    }
 
     getAuth(){
        return axios.get('/user', {
        })
        .then(response => {
            return response;
        }).catch(err => {
            console.log(err);
        })
    }
}

export default AuthService;