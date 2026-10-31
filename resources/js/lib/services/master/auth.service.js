
import api from '$lib/axios';

export const masterAuthService = {
    async login(credentials) {
        await api.get('/sanctum/csrf-cookie');

        const response = await api.post(
            '/api/master/login',
            credentials,
        );

        return response.data;
    },

    async me() {
        const response = await api.get('/api/master/me');

        return response.data.user;
    },

    async logout() {
        await api.post('/api/master/logout');
    },
};
