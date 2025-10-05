// resources/js/stores/auth.js

import { writable } from 'svelte/store';
// import { browser } from '$app/environment';

// Recupera o usuário do localStorage se existir
// const storedUser = browser ? JSON.parse(localStorage.getItem('user') || 'null') : null;

// export const user = writable(storedUser);
export const isLoading = writable(false);
export const error = writable(null);

// Atualiza localStorage quando o usuário muda
// if (browser) {
//     user.subscribe(value => {
//         localStorage.setItem('user', JSON.stringify(value));
//     });
// }

export const auth = {
    async login(baseUrl, email, password) {
        try {
            // Busca CSRF token primeiro
            const csrfResponse = await fetch('/csrf-token');
            const csrfData = await csrfResponse.json();

            const response = await fetch(baseUrl + '/auth', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfData.csrf_token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email, password }),
            });
            const data = await response.json();

            if(Array.isArray(data)) {
               if(data[0].message  !== "Authorized") {
                    return 'error';
                }     
            }

            console.log(data);

            return data[0];
        } catch (err) {
            return err;
            throw err;
        } finally {
            isLoading.set(false);
        }
    },

    async register(userData) {
        isLoading.set(true);
        error.set(null);

        try {
            const csrfResponse = await fetch('/csrf-token');
            const csrfData = await csrfResponse.json();

            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfData.csrf_token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(userData),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Erro no registro');
            }

            user.set(data.user);
            return data;
        } catch (err) {
            error.set(err.message);
            throw err;
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
            localStorage.removeItem('user');
            
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