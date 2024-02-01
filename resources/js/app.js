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

    const initGlobalInputsDependsOf = () => {
        let AddedEvents = [];
        let AddedEventsValues = {};
        $('[depends_of]').each((k, item) => {
            $(item).parent('.prc-input-group').hide();
            const [IdDependsOf, values] = $(item).attr('depends_of').split(':');
            if (!AddedEventsValues[IdDependsOf]) AddedEventsValues[IdDependsOf] = {};
            if (!AddedEventsValues[IdDependsOf][values]) AddedEventsValues[IdDependsOf][values] = [];
            AddedEventsValues[IdDependsOf][values].push($(item));
            if (!AddedEvents.includes(IdDependsOf)) {
                AddedEvents.push(IdDependsOf);
                $(`#${IdDependsOf}`).change(function () {
                    $(`[depends_of^="${this.id}"]`).parent('.prc-input-group').hide();
                    if (this.value) {
                        Object.entries(AddedEventsValues[IdDependsOf]).map(([key, items]) => {
                            if (key.includes(this.value)) {
                                items.forEach(item => {
                                    item.parent('.prc-input-group').fadeIn()
                                })
                            }
                        })
                    }
                });
            }
            const _DependsOf = $(`#${IdDependsOf}`);
            if (_DependsOf.val()) _DependsOf.change();
        });
    }

    const initInputmask = () => {
        Inputmask.extendAliases({
            currency: {
                prefix: "$ ",
                groupSeparator: ".",
                alias: "numeric",
                placeholder: "0",
                autoGroup: true,
                digits: 0,
                digitsOptional: false,
                clearMaskOnLostFocus: false
            }
        });
        $(":input").inputmask();
    }

    const loadGlobalEventsForms = () => {
        /**
         * We initialize select2 components
         */
        initGlobalSelect2();

        /**
         * We initialize the components dependent on others
         */
        initGlobalInputsDependsOf();

        /**
         *  We initialize the components InputMask
         */
        initInputmask();

    }

    initGlobalLoading();

    const pathsToEventsForms = ['residential-units.create', 'real-estate.create']
    if( pathsToEventsForms.includes(route().current())) loadGlobalEventsForms();
    if (route().current() === 'residential-units.index') loadViewUnitsIndex();

});
