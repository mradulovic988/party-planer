'use strict';

/**
 * Toggle between basic and advanced section on party-planer form
 *
 * @type {{process: basicBtn.process, advSection: *, btn: *}}
 */
const basicBtn = {
    advBtn: document.querySelector('.pp-advance-option'),
    advSection: document.querySelector('.pp-advanced-section'),
    addInfoBtn: document.querySelector('#pp-information'),
    addInfoSection: document.querySelector('.pp-addition-information-wrapper'),
    process: function (b, s) {
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
};
basicBtn?.process(basicBtn?.advBtn, basicBtn?.advSection);
basicBtn?.process(basicBtn?.addInfoBtn, basicBtn?.addInfoSection);

/**
 * Alert message for specific fields
 *
 * @type {{process: getAlert.process, partyTime: *, alc: *, nonAlc: *}}
 */
const getAlert = {
    alc: document.querySelector('#pp-alc-guests-number'),
    nonAlc: document.querySelector('#pp-non-alc-guests-number'),
    partyTime: document.querySelector('#pp-time-party'),
    process: function (e, max, str) {
        e.addEventListener('change', () => {
            let s = e.value;
            let i = parseInt(s);

            if (i < 0 || i > max) {
                alert(`Maksimalni broj ${str} je ${max}. Za veći broj ${str} nas kontaktirajte lično. Hvala.`);
                e.value = '';
            }
        });
    },
};
getAlert?.process(getAlert?.alc, 300, 'gostiju');
getAlert?.process(getAlert?.nonAlc, 300, 'gostiju');
getAlert?.process(getAlert?.partyTime, 8, 'sati');