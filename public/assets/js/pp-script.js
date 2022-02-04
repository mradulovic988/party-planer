'use strict';

/**
 * Toggle between basic and advanced section on party-planer form
 *
 * @type {{process: basicBtn.process, advSection: *, btn: *}}
 */
const basicBtn = {
    btn: document.querySelector('.pp-advance-option'),
    advSection: document.querySelector('.pp-advanced-section'),
    process: function () {
        if (this.btn) {
            this.btn.addEventListener('click', () => {
                if (this.advSection.style.display === 'block') {
                    this.btn.textContent = 'Napredne opcije    ⇩';
                    return this.advSection.style.display = 'none';
                } else {
                    this.btn.textContent = 'Napredne opcije    ⇧';
                    return this.advSection.style.display = 'block';
                }
            });
        }
    }
}
basicBtn?.process();