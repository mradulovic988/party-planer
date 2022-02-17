'use strict';

/**
 * Data elements for processing
 *
 * @type {{alert: {partyTime: *, alc: *, nonAlc: *}, toggle: {advSection: *, advBtn: *, addInfoSection: *, addInfoBtn: *}, require: {checkBox: *, req: *}, globalProcess: {reqProcess: data.globalProcess.reqProcess}}}
 */
const data = {

    /**
     * Elements used for toggling between sections
     */
    toggle: {
        advBtn: document.querySelector('.pp-advance-option'),
        advSection: document.querySelector('.pp-advanced-section'),
        addInfoBtn: document.querySelector('#pp-information'),
        addInfoSection: document.querySelector('.pp-addition-information-wrapper'),
    },

    /**
     * Alerts that handle notice data on fields
     */
    alert: {
        alc: document.querySelector('#pp-alc-guests-number'),
        nonAlc: document.querySelector('#pp-non-alc-guests-number'),
        partyTime: document.querySelector('#pp-time-party'),
        oldGroup: document.querySelectorAll('.pp-range-numbers'),
    },

    /**
     * Toggling with required attribute on necessary fields
     */
    require: {
        checkBox: document.querySelector('input#pp-information'),
        req: document.querySelectorAll('.pp-check-required')
    },

    /**
     * Toggling between checked checkbox fields
     */
    globalProcess: {
        reqProcess: function (e, c) {
            e.forEach(er => er.required = c);
        }
    },

    anchors: {
        result: document.querySelector('#pp-calculated')
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
                b.textContent = 'Osnovne opcije    ⇧';
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
 * @param {string} text Text message for alert()
 */
const alertProcess = (e, max, str, text) => {
    if (e) {
        e.addEventListener('change', () => {
            let s = e.value;
            let i = parseInt(s);

            if (i < 0 || i > max) {
                alert(`Maksimalni broj ${str} je ${max}. ${text}`);
                e.value = '';
            }
        });
    }
}
alertProcess(data.alert.alc, 300, 'gostiju', ' Za veći broj gostiju nas kontaktirajte lično. Hvala.');
alertProcess(data.alert.nonAlc, 300, 'gostiju', ' Za veći broj gostiju nas kontaktirajte lično. Hvala.');
alertProcess(data.alert.partyTime, 8, 'sati', ' Za veći broj sati nas kontaktirajte lično. Hvala.');
data.alert.oldGroup.forEach(o => alertProcess(o, 100, '', ''));

/**
 * Check if the checkbox fields is checked
 */
const requireToggle = () => {
    if (data.require.checkBox) {
        data.require.checkBox.addEventListener('click', () => {
            if (data.require.checkBox.checked === true) {
                data.globalProcess.reqProcess(data.require.req, true);
            } else {
                data.globalProcess.reqProcess(data.require.req, false);
            }
        });
    }
};
requireToggle();

/**
 * Percentages of input fields for group Age
 */
const els = Array.from(document.querySelectorAll('.pp-range-numbers'));
const total = 100;

const values = new Array(els.length).fill(0);
els.forEach((el, i) => el.value = values[i].toFixed(2));

/**
 * Check percentages on input fields
 *
 * @param e
 */
const handleChange = e => {
    const changedIndex = els.indexOf(e.target);
    const newValue = +e.target.value;
    values[changedIndex] = newValue;
    const otherIndexes = new Array(els.length)
        .fill(0)
        .map((_, i) => i)
        .filter((_, i) => i !== changedIndex);

    const otherSum = otherIndexes.map(i => values[i])
        .reduce((a, c) => a + c);

    if (otherSum === 0) {
        otherIndexes.forEach(i => values[i] = (total - newValue) / (values.length - 1));
    } else {
        const f = (total - newValue) / otherSum;
        otherIndexes.forEach(i => values[i] *= f);
    }
    els.forEach((el, i) => el.value = values[i].toFixed(2));
}
els.forEach(el => el.addEventListener('change', handleChange));

