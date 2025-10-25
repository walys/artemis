import langBr from './pt-BR.json';
import langEn from './en-US.json';
import langEs from './es-ES.json';

export function _(write) {
    let lang = localStorage.getItem("lang");
    
    const translations = {
        'pt-BR': langBr,
        'en-US': langEn,  // Mudei para en-US
        'es-ES': langEs   // Mudei para es-ES
    };
    // console.log('lang', translations[lang]);
    const selectedLang = translations[lang] || translations['pt-BR'];
    return selectedLang[write] || write;
}