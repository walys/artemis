import { register, init, getLocaleFromNavigator, _, waitLocale } from 'svelte-i18n';

// Todos com o mesmo padrão
register('en-US', () => import('./en-US.json'));
register('pt-BR', () => import('./pt-BR.json'));
register('es-ES', () => import('./es-ES.json'));

init({
  fallbackLocale: 'en-US',
  initialLocale: 'en-US',
});

export { _, waitLocale }