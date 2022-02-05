'use strict';

/**
 * Data elements for processing
 *
 * @type {{alert: {partyTime: *, alc: *, nonAlc: *}, toggle: {advSection: *, advBtn: *, addInfoSection: *, addInfoBtn: *}}}
 */
const data = {
    toggle: {
        advBtn: document.querySelector('.pp-advance-option'),
        advSection: document.querySelector('.pp-advanced-section'),
        addInfoBtn: document.querySelector('#pp-information'),
        addInfoSection: document.querySelector('.pp-addition-information-wrapper'),
    },
    alert: {
        alc: document.querySelector('#pp-alc-guests-number'),
        nonAlc: document.querySelector('#pp-non-alc-guests-number'),
        partyTime: document.querySelector('#pp-time-party'),
    }
}

/**
 * Toggle between basic and advanced section on party-planer form
 *
 * @param {Element} b Button element for click
 * @param {Element} s Section for toggle
 */
const toggleProcess = (b, s) => {
    if (b) {
        b.addEventListener('click', () => {
            if (s.style.display === 'block') {
                b.textContent = 'Napredne opcije    ⇩';
                return s.style.display = 'none';
            } else {
                b.textContent = 'Napredne opcije    ⇧';
                return s.style.display = 'block';
            }
        });
    }
}
toggleProcess(data.toggle.advBtn, data.toggle.advSection);
toggleProcess(data.toggle.addInfoBtn, data.toggle.addInfoSection);

/**
 * Alert message for specific fields
 *
 * @param {Element} e Get field element
 * @param {int} max Integer for defining rule
 * @param {string} str String message for alert()
 */
const alertProcess = (e, max, str) => {
    if (e) {
        e.addEventListener('change', () => {
            let s = e.value;
            let i = parseInt(s);

            if (i < 0 || i > max) {
                alert(`Maksimalni broj ${str} je ${max}. Za veći broj ${str} nas kontaktirajte lično. Hvala.`);
                e.value = '';
            }
        });
    }
}
alertProcess(data.alert.alc, 300, 'gostiju');
alertProcess(data.alert.nonAlc, 300, 'gostiju');
alertProcess(data.alert.partyTime, 8, 'sati');