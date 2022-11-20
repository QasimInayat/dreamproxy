
import API from "./api";

export  const products =  function () {
    return API.get('products/list');
}