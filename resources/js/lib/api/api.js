const API_URL = 'http://localhost:8000/api';  // URL base da API
let csrfToken = getCookie('XSRF-TOKEN');

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

// Função para realizar requisição GET
export async function getData(endpoint) {
    const res = await fetch(`${API_URL}${endpoint}`);
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
export async function postData(endpoint, data) {
    
    const res = await fetch(`${API_URL}${endpoint}`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "Access-Control-Allow-Origin": "*",
            "X-XSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify(data),
    }).catch((error) => console.error(error));
    return await res.json();
}

// Função para realizar requisição PUT
export async function putData(endpoint, data) {
    const res = await fetch(`${API_URL}${endpoint}`, {
        method: 'PUT',
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "Access-Control-Allow-Origin": "*",
        },
        body: JSON.stringify(data),
    });
    if (!res.ok) {
        throw new Error(`Erro ao atualizar dados: ${res.statusText}`);
    }
    return await res.json();
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
