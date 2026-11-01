const API_URL = '/api/site/languages';

export async function listLanguages() {
    const response = await fetch(API_URL, {
        method: 'GET',
        headers: {
            Accept: 'application/json',
        },
    });

    if (!response.ok) {
        throw new Error('Não foi possível carregar os idiomas.');
    }

    const data = await response.json();

    return data.languages;
}