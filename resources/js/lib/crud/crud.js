import { writable } from 'svelte/store';
let errors = [];

export const isLoading = writable(false);
export let error = writable(null);

export const crud = {

    async get(endpoint){
        try {
            const response = await fetch(endpoint);
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
    async post(endpoint, formData){
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
                body: JSON.stringify(formData),
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