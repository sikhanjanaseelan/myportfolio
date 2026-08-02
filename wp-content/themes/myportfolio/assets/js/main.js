'use strict';

import { initMobileMenu } from './modules/mobile-menu.js';

document.addEventListener('DOMContentLoaded', () => {
    document.documentElement.classList.add('js-enabled');

    initMobileMenu();
});