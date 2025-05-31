import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.body.classList.add('noscroll');
document.body.classList.remove('noscroll');

import flatpickr from "flatpickr";
import "flatpickr/dist/themes/dark.css"; // <-- dark theme CSS


flatpickr("#start", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    time_24hr: true,
    minuteIncrement: 5
});
@vite(['resources/css/app.css', 'resources/js/app.js'])
