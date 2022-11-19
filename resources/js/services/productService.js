
import axios from 'axios';

const base_url = "/api/v1/products/";

export  const products =  function () {
    return axios.get(`${base_url}list`, {headers: {
        'Content-Type':'application/json',
        'Accept': 'application/json'
    }});
}