import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.body.classList.add('noscroll');   // scroll blokkeren
document.body.classList.remove('noscroll'); // scroll toestaan

