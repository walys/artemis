const API_URL = 'http://localhost:8000/api';  // URL base da API
let csrfToken = getCookie('XSRF-TOKEN');
let baseUrl = '';

// Função auxiliar para obter CSRF token
function getCSRFToken() {
    // 1. Tentar do meta tag
    let token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    if (token) return token;

    // 2. Tentar do cookie XSRF-TOKEN (decodificado)
    token = getCookie('XSRF-TOKEN');
    if (token) {
        return decodeURIComponent(token);
    }

    // 3. Tentar do cookie csrf-token
    token = getCookie('csrf-token');
    if (token) {
        return decodeURIComponent(token);
    }

    return null;
}

// Função auxiliar para pegar cookies
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

async function renewCSRFToken() {
    try {
        const response = await fetch('/sanctum/csrf-cookie', {
            method: 'GET',
            credentials: 'include'
        });
        
        if (response.ok) {
            console.log('CSRF token renewed successfully');
        }
    } catch (error) {
        console.error('Failed to renew CSRF token:', error);
    }
}

export async function accessTokenXSRF(baseUrl){
    const res = await fetch(`${baseUrl}/csrf-token`);
    if (!res.ok) {
        throw new Error(`Erro ao buscar dados: ${res.statusText}`);
    }
     const { csrf_token } = await res.json();
    return csrf_token;
}

// Função para realizar requisição GET
export async function getData(endpoint) {
    const res = await fetch(`${endpoint}`);
    if (!res.ok) {
        throw new Error(`Erro ao buscar dados: ${res.statusText}`);
    }
    return await res.json();
}

export async function getDataParams(endpoint, params) {
    const url = `${API_URL}${endpoint}`;
    const queryString = Object.keys(params).map(key => `${key}=${params[key]}`).join('&');
    const fullUrl = `${url}?${queryString}`;
  
    const res = await fetch(fullUrl);
    if (!res.ok) {
      throw new Error(`Erro ao buscar dados: ${res.statusText}`);
    }
    return await res.json();
}

// Função para realizar requisição POST
// export async function postData(endpoint, data) {
//     let csrf_token = '';
//     accessTokenXSRF(baseUrl).then(token => {
//         csrf_token = token
//     });
//     // const csrfData = await csrfResponse.json();
//     const res = await fetch(`${endpoint}`, {
//         method: 'POST',
//         headers: {
//             "Content-Type": "application/json",
//             "Accept": "application/json",
//             "Access-Control-Allow-Origin": "*",
//             "X-XSRF-TOKEN": csrf_token,
//         },
//         credentials: 'include',
//         body: JSON.stringify(data),
//     }).catch((error) => console.error('Error:', error));
//     return await res.json();
// }


export async function postData(endpoint, data) {
    try {
        // Obter o CSRF token de forma síncrona
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        const headers = {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "Access-Control-Allow-Origin": "*",
        };

        // Adicionar CSRF token se disponível
        if (csrfToken) {
            headers["X-CSRF-TOKEN"] = csrfToken;
        }

        const res = await fetch(endpoint, {
            method: 'POST',
            headers: headers,
            credentials: 'include', // Importante para cookies/sessions
            body: JSON.stringify(data),
        });

        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }

        return await res.json();
    } catch (error) {
        console.error('Error in postData:', error);
        throw error;
    }
}

// Função para realizar requisição PUT
export async function putData(endpoint, data) {
    try {
        // Obter o CSRF token de forma síncrona
        const csrfResponse = await fetch('/csrf-token');
        const csrfToken = await csrfResponse.json();

        const headers = {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest", // Importante para Laravel
        };

        // Adicionar CSRF token se disponível
        if (csrfToken) {
            headers["X-CSRF-TOKEN"] = csrfToken.csrf_token;
        }

        const res = await fetch(endpoint, {
            method: 'PUT',
            headers: headers,
            credentials: 'include', // Importante para cookies/sessions
            body: JSON.stringify(data),
        });

        return await res.json();
        console.log('putData data', data);
        if(data?.errors) {
            return data;
        }else{
            return data[0]; 
        }
    } catch (err) {
        return err.json();
    }
}

// Função para realizar requisição DELETE
export async function deleteData(endpoint) {
    const res = await fetch(`${API_URL}${endpoint}`, {
        method: 'DELETE',
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "Access-Control-Allow-Origin": "*",
        },
        body: JSON.stringify(data),
    });
    if (!res.ok) {
        throw new Error(`Erro ao deletar dados: ${res.statusText}`);
    }
    return await res.json();
}
