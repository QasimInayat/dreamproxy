import axios from 'axios';

const base_url = "/api/v1/";

export  const country =  function () {
    return axios.get(`${base_url}country/list`, {headers: {
        'Content-Type':'application/json',
        'Accept': 'application/json'
    }});
}

export  const province =  function () {
    return axios.get(`${base_url}province/list`, {headers: {
        'Content-Type':'application/json',
        'Accept': 'application/json'
    }});
}