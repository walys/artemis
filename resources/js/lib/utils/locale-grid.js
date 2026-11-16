import {_} from "$lib/lang/lang.js";

const pt = {
    lang: "pt-BR",

    //calendar
    calendar: {
        monthFull: [
            _("Janeiro"),
            _("Fevereiro"),
            _("Março"),
            _("Abril"),
            _("Maio"),
            _("Junho"),
            _("Julho"),
            _("Agosto"),
            _("Setembro"),
            _("Outubro"),
            _("Novembro"),
            _("Dezembro"),
        ],
        monthShort: [
            _("Jan"),
            _("Fev"),
            _("Mar"),
            _("Abr"),
            _("Mai"),
            _("Jun"),
            _("Jul"),
            _("Ago"),
            _("Set"),
            _("Out"),
            _("Nov"),
            _("Dez"),
        ],

        dayFull: [
            _("Domingo"),
            _("Segunda-feira"),
            _("Terça-feira"),
            _("Quarta-feira"),
            _("Quinta-feira"),
            _("Sexta-feira"),
            _("Sábado"),
        ],

        dayShort: [_("Dom"), _("Seg"), _("Ter"), _("Qua"), _("Qui"), _("Sex"), _("Sáb")],
        hours: _("Horas"),
        minutes: _("Minutos"),
        done: _("Concluído"),
        clear: _("Limpar"),
        today: _("Hoje"),
        am: [_("am"), _("AM")],
        pm: [_("pm"), _("PM")],

        weekStart: 7,
        clockFormat: 24
    },

    //core
    core: {
        ok: _("OK"),
        cancel: _("Cancelar"),
        select: _("Selecionar"),
        "No data": _("Sem dados"),
        "Total pages": _("Total de paginas"),
        "Rows per page": _("Linhas por página")
    },

    //formats
    formats: {
        dateFormat: _("%d.%m.%Y"),
        timeFormat: _("%H:%i"),
        monthYearFormat: _("%F %Y"),
        yearFormat: _("%Y"),
    },

    //Grid
    grid: {
        "Add before": _("Adicionar antes"),
        "Add after": _("Adicionar depois"),
        Copy: _("Copiar"),
        Cut: _("Recortar"),
        Paste: _("Colar"),
        Delete: _("Excluir"),
        "New row": _("Nova linha"),
        "Move up": _("Mover para cima"),
        "Move down": _("Mover para baixo"),
        Undo: _("Desfazer"),
        Redo: _("Refazer"),
        selected: _("selecionado(s)"),
    },
};

export const ptBR = pt;