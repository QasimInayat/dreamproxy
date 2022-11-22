import axios from 'axios';

const base_url = "/api/v1/user/";

import API from './api';

export  const login =  function (data) {
    return API.post(`user/login`, data);
}

export  const register =  function (data) {
    return API.post(`user/register`, data,);
}

export  const forget =  function (data) {
    return API.post(`${base_url}lostPassword`, data);
}

export  const confirmpassword =  function (data) {
    return API.post(`user/confirmLostPassword`, data);
}

export  const profile =  function () {
    return API.get(`user/profile`);
}