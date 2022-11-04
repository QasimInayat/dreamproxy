import axios from 'axios';



export  const login =  function (data) {
    return axios.post('api/user/login', data);
}

// export default class Service {
//     login(){
        
//     }
// }