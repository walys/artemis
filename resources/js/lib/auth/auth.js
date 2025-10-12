import { writable } from 'svelte/store';
let errors = [];

export const isLoading = writable(false);
export let error = writable(null);

export const auth = {

    async login(endpoint, email, password) {
        try {
            // Busca CSRF token primeiro
            const csrfResponse = await fetch('/csrf-token');
            const csrfData = await csrfResponse.json();

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfData.csrf_token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email, password }),
            });
            const data = await response.json();

            if(data?.errors) {
                return data;
            }else{
               console.log('data passou', data);
                return data[0]; 
            }
        } catch (err) {
            console.log('err', err);
            return err;
            throw err;
        } finally {
            isLoading.set(false);
        }
    },

    async register(endpoint, userData) {

        try {
            const csrfResponse = await fetch('/csrf-token');
            const csrfData = await csrfResponse.json();

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfData.csrf_token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(userData),
            });

            const data = await response.json();
            if(data?.errors) {
                return data;
            }else{
                return data[0]; 
            }
        } catch (err) {
            return err;
        } finally {
            isLoading.set(false);
        }
    },

    async logout() {
        isLoading.set(true);

        try {
            const csrfResponse = await fetch('/csrf-token');
            const csrfData = await csrfResponse.json();

            const response = await fetch('/api/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfData.csrf_token,
                    'Accept': 'application/json',
                },
            });

            user.set(null);
            
            return await response.json();
        } catch (err) {
            console.error('Logout error:', err);
        } finally {
            isLoading.set(false);
        }
    },

    async checkAuth() {
        try {
            const response = await fetch('/api/user', {
                headers: {
                    'Accept': 'application/json',
                },
            });

            if (response.ok) {
                const data = await response.json();
                user.set(data.user);
                return data.user;
            } else {
                user.set(null);
                return null;
            }
        } catch (err) {
            console.error('Auth check error:', err);
            user.set(null);
            return null;
        }
    }
};