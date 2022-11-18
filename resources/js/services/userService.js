
import axios from 'axios';

const base_url = "/api/v1/user/";

export  const profile =  function () {
    return axios.get(`${base_url}profile`, {headers: {
        'Content-Type':'application/json',
        'Accept': 'application/json',
        Authorization: "Bearer " + localStorage.getItem("token"),
    }});
}