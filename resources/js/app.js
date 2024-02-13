import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

import loadViewUnitsIndex from "./units.index.js";
import loadViewRealEstateIndex from "./real-estate.index.js";
import loadScriptFormRealState from "./real-estate.create.js";

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
                                    item.parent('.prc-input-group').fadeIn();
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

    const initInputTypeFiles = () => {

        window['removeImage'] = (e) => {
            e.preventDefault();
            const ImagesGroup = e.target.closest('.prc-input-file-group');
            const ContentImages = ImagesGroup.querySelector('label.grid');
            const ContentNoImages = ImagesGroup.querySelector('label.flex');
            const InputFile = ImagesGroup.querySelector('input[type=file].prc-input-file');
            const name = e.target.alt;
            const container = new DataTransfer();
            for (const file of InputFile.files) {
                if (file.name !== name) container.items.add(file);
            }
            InputFile.files = container.files;
            e.target.remove();
            ContentImages.querySelector(`input[value="${name}"]`)?.remove();
            if (!InputFile.files.length && !ContentImages.querySelectorAll('img').length) {
                ContentNoImages.classList.remove('hidden');
                ContentImages.classList.add('hidden');

            }
        };
        $('.prc-input-file').on('change', (e) => {
            const ImagesGroup = e.target.closest('.prc-input-file-group');
            const ContentImages = ImagesGroup.querySelector('label.grid');
            const ContentNoImages = ImagesGroup.querySelector('label.flex');
            const Files = e.target.files;
            const oldImages = ContentImages.querySelectorAll('img.old-img');
            const maxlength = +e.target.getAttribute('maxlength') || Infinity;
            const allowFormat = e.target.getAttribute('allow-format')?.split(',') || [];
            const totalImages = Files.length + oldImages.length;

            /** Validations **/
            if (totalImages > maxlength) {
                ImagesGroup.querySelector('.prc-input-file-errors').innerHTML = `El número máximo de imágenes permitidas es de: ${maxlength} imágenes`;
                return;
            }

            if (allowFormat.length) {
                const isAllow = Array.from($('.prc-input-file')[0].files).every(F => allowFormat.includes(F.type));
                if (!isAllow) {
                    ImagesGroup.querySelector('.prc-input-file-errors').innerHTML = `Uno o más archivos seleccionados no cumplen con el formato permitido:  ${allowFormat}`;
                    return;
                }
            }

            if (Files.length) {
                ContentImages.classList.remove('hidden');
                ContentNoImages.classList.add('hidden');
            }

            ContentImages.querySelectorAll('img').forEach(img => {
                if (!img.classList.contains('old-img')) img.remove();
            });
            for (const file of Files) {
                const blobImage = URL.createObjectURL(file);
                ContentImages.insertAdjacentHTML('beforeend', `<img src="${blobImage}" class="h-auto max-w-full rounded-lg cursor-no-drop" alt="${file.name}" onclick="removeImage(event)">`)
            }

        })
    }

    /**
     * Init input mask componentes
     */
    const initInputmask = () => {
        if (typeof Inputmask === 'function') {
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

        /**
         * We initialize the inputs type file
         */
        initInputTypeFiles();

    }

    initGlobalLoading();

    const pathsToEventsForms = ['residential-units.create', 'real-estate.create', 'real-estate.index']
    if (pathsToEventsForms.includes(route().current())) loadGlobalEventsForms();

    if (route().current() === 'residential-units.index') loadViewUnitsIndex();
    if (route().current() === 'real-estate.index') loadViewRealEstateIndex();
    if (['real-estate.create', 'real-estate.update'].includes(route().current())) loadScriptFormRealState();

});
