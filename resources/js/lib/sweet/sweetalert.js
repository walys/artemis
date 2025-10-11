import sweetalert2 from 'sweetalert2';

export default function sweetalert(title, text, icon) {
    return sweetalert2.fire({
        title: title,
        text: text,
        icon: icon,
    });
}