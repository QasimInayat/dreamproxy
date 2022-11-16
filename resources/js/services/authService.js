import axios from 'axios';

const base_url = "/api/v1/user/";

export  const login =  function (data) {
    return axios.post(`${base_url}login`, data);
}

export  const register =  function (data) {
    return axios.post(`${base_url}register`, data, {headers: {
        'Content-Type':'application/json',
        'Accept': 'application/json'
    }});
}

export  const forget =  function (data) {
    return axios.post(`${base_url}lostPassword`, data, {headers: {
        'Content-Type':'application/json',
        'Accept': 'application/json'
    }});
}