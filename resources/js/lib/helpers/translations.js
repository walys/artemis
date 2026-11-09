
import sweetalert from "$lib/sweet/sweetalert.js";
import { route } from "ziggy-js";
import { crud } from "$lib/crud/crud.js";
import { _ } from "$lib/lang/lang.js";

export default async function saveTranslations(jsonData, lang) {
    let translations;

    // Valida o JSON antes de enviar
    try {
        translations = JSON.parse(jsonData);
    } catch (error) {
        console.error("Erro ao analisar o JSON:", error);

        sweetalert(
            _("Erro"),
            _("O JSON informado é inválido."),
            "error"
        );

        return false;
    }

    // Envia as traduções para a API
    try {
        const response = await crud.post(
            route("master.settings.languages.post"),
            {
                translations,
                lang
            }
        );

        if (response.success) {
            sweetalert(
                _("Sucesso"),
                _("Traduções atualizadas com sucesso!"),
                "success"
            );

            return true;
        }

        sweetalert(
            _("Erro"),
            response.message || _("Ocorreu um erro ao atualizar as traduções."),
            "error"
        );

        return false;

    } catch (error) {
        console.error("Erro ao salvar traduções:", error);

        sweetalert(
            _("Erro"),
            _("Ocorreu um erro ao atualizar as traduções."),
            "error"
        );

        return false;
    }
}
