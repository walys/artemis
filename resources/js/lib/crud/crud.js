import { writable } from 'svelte/store';
let errors = [];

export const isLoading = writable(false);
export let error = writable(null);

export const crud = {

    async get(endpoint) {
        try {
            const response = await fetch(endpoint, {
                headers: {
                    'Accept': 'application/json',
                    'Accept-Language': localStorage.getItem('lang') || 'pt-BR',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
            });

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;

        } catch (err) {
            console.error('Erro na requisição GET:', err);
            throw err;
        } finally {
            isLoading.set(false);
        }
    },
    async post(endpoint, formData) {
        try {
            // Inicializa o cookie CSRF do Laravel Sanctum
            await fetch('/sanctum/csrf-cookie', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
            });

            // Recupera o cookie XSRF-TOKEN
            const xsrfCookie = document.cookie
                .split('; ')
                .find(cookie => cookie.startsWith('XSRF-TOKEN='));

            if (!xsrfCookie) {
                throw new Error('Cookie XSRF-TOKEN não encontrado.');
            }

            const xsrfToken = decodeURIComponent(
                xsrfCookie.substring('XSRF-TOKEN='.length)
            );

            // Executa a requisição POST
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-XSRF-TOKEN': xsrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
                body: JSON.stringify(formData),
            });

            const contentType = response.headers.get('content-type') || '';

            let data;

            if (contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const responseText = await response.text();

                throw new Error(
                    `O servidor retornou uma resposta não JSON. Status: ${response.status}. Resposta: ${responseText.substring(0, 200)}`
                );
            }

            if (!response.ok) {
                throw data;
            }

            return data;

        } catch (err) {
            console.error('Erro na requisição POST:', err);
            throw err;

        } finally {
            isLoading.set(false);
        }
    },

    async put(endpoint, formData){
        try {
            const csrfResponse = await fetch('/csrf-token');
            const csrfData = await csrfResponse.json();
            const response = await fetch(endpoint, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfData.csrf_token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(formData),
            });
            const data = await response.json();
            if(data?.errors) {
                return data;
            }else{
               console.log('data passou', data);
                return data; 
            }
        } catch (err) {
            console.log('err', err);
            return err;
            throw err;
        } finally {
            isLoading.set(false);
        }
    },
    async delete(endpoint){
        try {
            const csrfResponse = await fetch('/csrf-token');
            const csrfData = await csrfResponse.json();
            const response = await fetch(endpoint, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfData.csrf_token,
                    'Accept': 'application/json',
                },
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
    }
}