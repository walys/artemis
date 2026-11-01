import langBr from "$lib/lang/pt-BR.json";
import langEn from "$lib/lang/en-Us.json";
import langEs from "$lib/lang/es-Es.json";

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