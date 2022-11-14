import axios from 'axios';

const headers = {
    "Accept" : "application/json",
    "Content-Type" : "application/json",
}



export  const login =  function (data) {
    return axios.post('/api/user/login', data, {headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }});
}
