
import API from "./api";

export  const saveBilling =  function (data) {
    return API.post('billing/save', data);
}

export  const getBilling =  function (data) {
    return API.get('billing/get');
}