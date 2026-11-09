import axios from 'axios';

const api = axios.create({
    baseURL: '/',
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
});

// Interceptor para enviar o idioma selecionado ao backend
api.interceptors.request.use((config) => {
    const locale = localStorage.getItem('lang') || 'pt-BR';

    config.headers['Accept-Language'] = locale;

    return config;
});

export default api;