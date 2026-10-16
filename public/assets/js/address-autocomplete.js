(function () {
    const loader = document.currentScript;
    const apiKey = loader && loader.dataset.googleMapsKey;
    const inputs = document.querySelectorAll('[data-google-address]');

    if (!inputs.length || !apiKey) {
        return;
    }

    function findField(form, name) {
        return form.querySelector('[name="' + name + '"]');
    }

    function setValue(form, name, value) {
        const field = findField(form, name);
        if (field && value) {
            field.value = value;
            field.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }

    function component(components, type, useShortName) {
        const match = components.find(function (item) {
            return item.types.includes(type);
        });

        return match ? (useShortName ? match.shortText : match.longText) : '';
    }

    function initializeAutocomplete(places) {
        let nextListId = 0;

        inputs.forEach(function (input) {
            input.setAttribute('autocomplete', 'off');
            input.setAttribute('aria-autocomplete', 'list');

            const list = document.createElement('div');
            list.id = 'google-address-suggestions-' + (++nextListId);
            list.setAttribute('role', 'listbox');
            list.style.cssText = [
                'display:none',
                'position:fixed',
                'z-index:99999',
                'overflow-y:auto',
                'max-height:240px',
                'background:#fff',
                'border:1px solid #dadce0',
                'border-radius:4px',
                'box-shadow:0 2px 6px rgba(0,0,0,.2)',
                'color:#202124',
                'font:14px Arial,sans-serif',
            ].join(';');
            document.body.appendChild(list);
            input.setAttribute('aria-controls', list.id);

            let sessionToken = null;
            let requestId = 0;
            let debounceTimer = null;
            let activeIndex = -1;

            function positionList() {
                const rect = input.getBoundingClientRect();
                list.style.left = rect.left + 'px';
                list.style.top = rect.bottom + 'px';
                list.style.width = rect.width + 'px';
            }

            function hideList() {
                list.style.display = 'none';
                input.setAttribute('aria-expanded', 'false');
                input.removeAttribute('aria-activedescendant');
                activeIndex = -1;
            }

            function showList() {
                positionList();
                list.style.display = 'block';
                input.setAttribute('aria-expanded', 'true');
            }

            function activateOption(index) {
                const options = list.querySelectorAll('[role="option"]');
                if (!options.length) {
                    return;
                }

                activeIndex = (index + options.length) % options.length;
                options.forEach(function (option, optionIndex) {
                    option.setAttribute('aria-selected', optionIndex === activeIndex ? 'true' : 'false');
                    option.style.background = optionIndex === activeIndex ? '#f1f3f4' : '#fff';
                });
                input.setAttribute('aria-activedescendant', options[activeIndex].id);
            }

            async function selectPrediction(prediction) {
                requestId++;
                window.clearTimeout(debounceTimer);
                hideList();
                try {
                    const place = prediction.toPlace();
                    await place.fetchFields({
                        fields: ['addressComponents', 'formattedAddress'],
                    });

                    const form = input.closest('form');
                    if (!form) {
                        return;
                    }

                    const parts = place.addressComponents || [];
                    const street = [
                        component(parts, 'street_number'),
                        component(parts, 'route'),
                    ].filter(Boolean).join(' ');
                    const city = component(parts, 'locality')
                        || component(parts, 'postal_town')
                        || component(parts, 'sublocality_level_1')
                        || component(parts, 'administrative_area_level_2');
                    const postalCode = [
                        component(parts, 'postal_code'),
                        component(parts, 'postal_code_suffix'),
                    ].filter(Boolean).join('-');
                    const formattedAddress = place.formattedAddress || input.value;

                    if (input.matches('[name="address_street"]')) {
                        input.value = street || formattedAddress;
                    } else {
                        input.value = formattedAddress;
                    }

                    setValue(form, 'address_city', city);
                    setValue(form, 'address_state', component(parts, 'administrative_area_level_1'));
                    setValue(form, 'address_country', component(parts, 'country'));
                    setValue(form, 'address_postal', postalCode);
                    setValue(form, 'business_address', formattedAddress);
                    setValue(form, 'address', formattedAddress);
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                    sessionToken = null;
                } catch (error) {
                    sessionToken = null;
                    console.error('Google Places could not retrieve the selected address.', error);
                }
            }

            function renderSuggestions(suggestions) {
                list.replaceChildren();
                activeIndex = -1;

                suggestions.forEach(function (suggestion) {
                    const prediction = suggestion.placePrediction;
                    if (!prediction) {
                        return;
                    }

                    const optionIndex = list.querySelectorAll('[role="option"]').length;
                    const option = document.createElement('button');
                    option.type = 'button';
                    option.id = list.id + '-option-' + optionIndex;
                    option.setAttribute('role', 'option');
                    option.setAttribute('aria-selected', 'false');
                    option.style.cssText = [
                        'display:block',
                        'width:100%',
                        'padding:10px 12px',
                        'border:0',
                        'background:#fff',
                        'color:inherit',
                        'text-align:left',
                        'cursor:pointer',
                        'font:inherit',
                    ].join(';');
                    option.textContent = prediction.text.toString();
                    option.addEventListener('mouseenter', function () {
                        activateOption(optionIndex);
                    });
                    option.addEventListener('mousedown', function (event) {
                        event.preventDefault();
                    });
                    option.addEventListener('click', function () {
                        selectPrediction(prediction);
                    });
                    list.appendChild(option);
                });

                if (!list.childElementCount) {
                    hideList();
                    return;
                }

                const attribution = document.createElement('div');
                attribution.textContent = 'Google Maps';
                attribution.style.cssText = 'padding:6px 12px;text-align:right;color:#5f6368;font:12px Arial,sans-serif;border-top:1px solid #eee';
                list.appendChild(attribution);
                showList();
            }

            input.addEventListener('input', function () {
                const query = input.value.trim();
                const currentRequest = ++requestId;
                window.clearTimeout(debounceTimer);

                if (query.length < 3) {
                    hideList();
                    return;
                }

                if (!sessionToken) {
                    sessionToken = new places.AutocompleteSessionToken();
                }

                debounceTimer = window.setTimeout(async function () {
                    try {
                        const response = await places.AutocompleteSuggestion.fetchAutocompleteSuggestions({
                            input: query,
                            sessionToken: sessionToken,
                        });
                        if (currentRequest === requestId) {
                            renderSuggestions(response.suggestions || []);
                        }
                    } catch (error) {
                        if (currentRequest === requestId) {
                            hideList();
                        }
                        console.error('Google Places autocomplete request failed.', error);
                    }
                }, 250);
            });

            input.addEventListener('keydown', function (event) {
                if (event.key === 'ArrowDown' && list.style.display !== 'none') {
                    event.preventDefault();
                    activateOption(activeIndex + 1);
                } else if (event.key === 'ArrowUp' && list.style.display !== 'none') {
                    event.preventDefault();
                    activateOption(activeIndex < 0 ? 0 : activeIndex - 1);
                } else if (event.key === 'Enter' && activeIndex >= 0) {
                    const option = list.querySelectorAll('[role="option"]')[activeIndex];
                    if (option) {
                        event.preventDefault();
                        option.click();
                    }
                } else if (event.key === 'Escape') {
                    hideList();
                }
            });

            input.addEventListener('blur', function () {
                window.setTimeout(hideList, 100);
            });

            window.addEventListener('resize', function () {
                if (list.style.display !== 'none') {
                    positionList();
                }
            });
            window.addEventListener('scroll', function () {
                if (list.style.display !== 'none') {
                    positionList();
                }
            }, true);
        });
    }

    function loadPlaces() {
        if (!window.google || !google.maps || !google.maps.importLibrary) {
            console.error('Google Maps JavaScript API loaded without importLibrary.');
            return;
        }

        google.maps.importLibrary('places')
            .then(function (places) {
                initializeAutocomplete(places);
            })
            .catch(function (error) {
                console.error('Google Places library failed to load.', error);
            });
    }

    if (window.google && google.maps && google.maps.importLibrary) {
        loadPlaces();
        return;
    }

    window.initGoogleAddressAutocomplete = loadPlaces;
    const script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key='
        + encodeURIComponent(apiKey)
        + '&libraries=places&callback=initGoogleAddressAutocomplete&loading=async';
    script.async = true;
    script.defer = true;
    script.onerror = function () {
        console.error('Google Maps JavaScript API failed to load. Check the API key and referrer restrictions.');
    };
    document.head.appendChild(script);
})();
