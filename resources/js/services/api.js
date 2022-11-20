import axios from 'axios';
// Create axios client, pre-configured with baseURL

const base_url = "/api/v1/";

let API = axios.create({
    baseURL: base_url,
    timeout: 5000,
    headers:{
        'Content-Type':'application/json',
        'Accept': 'application/json',
        Authorization: "Bearer " + localStorage.getItem("token"),
    }
});

export default API;
