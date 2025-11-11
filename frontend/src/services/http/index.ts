import axios from 'axios'

const service = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  Headers: {
    Accept: 'application/json',
    Authorization: 'Referer'
  }
})
service.defaults.xsrfCookieName = 'XSRF-TOKEN';
service.defaults.xsrfHeaderName = 'X-XSRF-TOKEN';
service.defaults.withXSRFToken = true;
service.defaults.withCredentials = true;

export default service
