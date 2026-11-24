import sweetalert2 from 'sweetalert2';
import { _ } from "$lib/lang/lang.js";

export default function sweetalert(title, text, icon) {
    return sweetalert2.fire({
        title: title,
        text: text,
        icon: icon,
    });
}

export function confirmAlert(title, text, options = {}) {
    return sweetalert2.fire({
        title,
        text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: _("Sim, excluir!"),
        cancelButtonText: _("Cancelar"),
        reverseButtons: true,
        ...options
    });
}

export function alertTimer(position, icon, title, timer, options = {}) {
    return sweetalert2.fire({
        position: position,
        icon: icon,
        title: title,
        showConfirmButton: false,
        timer: timer
    });
}