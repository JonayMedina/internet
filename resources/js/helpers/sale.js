import axios from 'axios';

export default {
    all() {
        return axios.get('/api/sales');
    },
    find(id) {
        return axios.get(`/api/sales/show/${id}`);
    },
    create(data) {
        return axios.post(`/api/sales/store/`, data);
    },
    update(id, data) {
        return axios.put(`/api/sales/update/${id}`, data);
    },
};