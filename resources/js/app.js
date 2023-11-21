import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

import loadViewUnitsIndex from "./units.index.js";

$(document).ready(function () {

    const initGlobalLoading = () => {
        window.onbeforeunload = function (event) {
            document.getElementsByClassName('prc-loading-container')[(0)].classList.remove('hidden');
        }
    }

    const initGlobalSelect2 = () => {
        function formatState(state) {
            let textParent = $(state.element).parent('optgroup')?.attr('label') || '';
            if (textParent) textParent += ' - ';
            return `${textParent} ${state.text}`;
        }
        $('.auto-init-select2').select2({width: '100%', templateSelection: formatState});
    }

    const loadGlobalEvents = () => {

        /**
         * We register the event that allows the loading component to be displayed while the view is changed.
         * @param event
         */
        initGlobalLoading();

        /**
         * We initialize select2 components
         */
        initGlobalSelect2();

    }

    loadGlobalEvents();

    if (route().current() === 'residential-units.index') loadViewUnitsIndex();

});
