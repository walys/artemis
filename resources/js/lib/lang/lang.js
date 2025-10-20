import langBr from './pt_br.json';
import langEn from './en-Us.json';
import langEs from './es-Es.json';

function listStorageItems() {
    const storageItems = {};
    for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        const value = localStorage.getItem(key);
        storageItems[key] = value;
    }
    return storageItems;
}

const storageItems = listStorageItems();

export function _(write) {
    console.log('lang', lang);
    let lang = storageItems.lang;
    console.log('storageItems', lang);

    switch (lang) {
        case 'pt-BR':
            return langBr[write];
        case 'en-Us':
            return langEn[write];
        case 'es-Es':
            return langEs[write];
        default:
            return langBr[write];
    }

}