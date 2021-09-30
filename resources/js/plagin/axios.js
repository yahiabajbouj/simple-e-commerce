const axios = require('axios').default;

const Http = axios.create({
    baseURL: 'http://127.0.0.1:8000/api',
});

export default Http;