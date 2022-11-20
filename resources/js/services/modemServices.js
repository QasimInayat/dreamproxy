
import API from "./api";

export  const getModems =  function () {
    return API.get('modem/list');
}