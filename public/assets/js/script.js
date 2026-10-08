// document.addEventListener('DOMContentLoaded', function () {

//     const searchInput = document.getElementById('popupWarehouseSearch');
//     const resultsBox = document.getElementById('popupSearchResults');

//     if (!searchInput || !resultsBox) return;

//     let searchTimer;


//     searchInput.addEventListener('input', function () {

//         clearTimeout(searchTimer);

//         const keyword = this.value.trim();

//         if (keyword.length < 2) {

//             resultsBox.innerHTML = '';

//             return;
//         }


//         searchTimer = setTimeout(function () {

//             fetch("{{ route('warehouse.search') }}?search=" + encodeURIComponent(keyword))

//                 .then(response => response.json())

//                 .then(data => {

//                     resultsBox.innerHTML = '';


//                     if (!data.length) {

//                         resultsBox.innerHTML = `
//                             <div class="border rounded-3 p-3 text-muted">
//                                 <i class="fa-solid fa-circle-info me-2"></i>
//                                 No warehouse found.
//                             </div>
//                         `;

//                         return;
//                     }


//                     data.forEach(function (warehouse) {

//                         const item = document.createElement('a');

//                         item.href =
//                             "{{ route('explore') }}?search="
//                             + encodeURIComponent(warehouse.name);

//                         item.className =
//                             'd-block text-decoration-none text-dark border-bottom p-3';


//                         item.innerHTML = `
//                             <div class="fw-semibold">
//                                 <i class="fa-solid fa-warehouse text-warning me-2"></i>
//                                 ${warehouse.name}
//                             </div>

//                             <small class="text-muted">
//                                 ${warehouse.city ?? ''}
//                             </small>
//                         `;


//                         resultsBox.appendChild(item);

//                     });

//                 })

//                 .catch(function () {

//                     resultsBox.innerHTML = `
//                         <div class="alert alert-danger">
//                             Unable to load search results.
//                         </div>
//                     `;

//                 });

//         }, 300);

//     });

//     document.getElementById('searchModal')
//         .addEventListener('hidden.bs.modal', function () {

//             searchInput.value = '';
//             resultsBox.innerHTML = '';

//         });

// });



        /*
        ==========================================
           DEMO WAREHOUSE DATA
        ==========================================
        */

        const warehouses = [

            {
                name: "Toronto Logistics Hub",
                location: "Toronto, Ontario",
                storage: "General",
                capacity: 12000
            },

            {
                name: "Vancouver Cold Storage",
                location: "Vancouver, British Columbia",
                storage: "Cold",
                capacity: 8500
            },

            {
                name: "Calgary Distribution Centre",
                location: "Calgary, Alberta",
                storage: "Fulfillment",
                capacity: 15000
            },

            {
                name: "Mississauga Climate Storage",
                location: "Mississauga, Ontario",
                storage: "Climate",
                capacity: 6500
            },

            {
                name: "Montreal Warehouse Park",
                location: "Montreal, Quebec",
                storage: "General",
                capacity: 20000
            },

            {
                name: "Edmonton Fulfillment Hub",
                location: "Edmonton, Alberta",
                storage: "Fulfillment",
                capacity: 10000
            }

        ];


        /*
        ==========================================
           SEARCH FUNCTION
        ==========================================
        */

        document
            .getElementById("warehouseSearch")
            .addEventListener("submit", function (event) {

                event.preventDefault();

                const location =
                    document
                        .getElementById("location")
                        .value
                        .trim()
                        .toLowerCase();

                const storage =
                    document
                        .getElementById("storageType")
                        .value;

                const capacity =
                    document
                        .getElementById("capacity")
                        .value;

                const minCapacity =
                    capacity ? parseInt(capacity) : 0;


                /*
                Filter warehouses
                */

                const filtered = warehouses.filter(function (warehouse) {

                    const locationMatch =
                        !location ||
                        warehouse.location
                            .toLowerCase()
                            .includes(location);

                    const storageMatch =
                        !storage ||
                        warehouse.storage === storage;

                    const capacityMatch =
                        warehouse.capacity >= minCapacity;

                    return (
                        locationMatch &&
                        storageMatch &&
                        capacityMatch
                    );

                });


                showResults(filtered);

            });


        /*
        ==========================================
           DISPLAY RESULTS
        ==========================================
        */

        function showResults(data) {

            const resultsSection =
                document.getElementById("resultsSection");

            const results =
                document.getElementById("results");

            const resultText =
                document.getElementById("resultText");


            resultsSection.classList.add("show");


            resultText.innerHTML =
                `<strong>${data.length}</strong> warehouse(s) found for your search.`;


            if (data.length === 0) {

                results.innerHTML = `

                <div class="no-results">

                    <i
                        class="fa-solid fa-warehouse"
                        style="
                            font-size:45px;
                            color:#b7c2cf;
                            margin-bottom:15px;
                        "
                    ></i>

                    <h4>
                        No warehouses found
                    </h4>

                    <p class="text-muted">
                        Try changing your location, storage type
                        or capacity requirement.
                    </p>

                </div>

            `;

                return;
            }


            results.innerHTML = data.map(function (warehouse) {

                return `

                <div class="warehouse-card">

                    <div class="row align-items-center g-3">

                        <div class="col-auto">

                            <div class="warehouse-icon">
                                <i class="fa-solid fa-warehouse"></i>
                            </div>

                        </div>


                        <div class="col">

                            <div class="warehouse-name">
                                ${warehouse.name}
                            </div>

                            <div class="warehouse-location">
                                <i class="fa-solid fa-location-dot"></i>
                                ${warehouse.location}
                            </div>

                        </div>


                        <div class="col-md-auto">

                            <span class="badge-storage">

                                ${getStorageName(warehouse.storage)}

                            </span>

                        </div>


                        <div class="col-md-auto">

                            <div class="capacity">

                                <i class="fa-solid fa-ruler-combined"></i>

                                ${warehouse.capacity.toLocaleString()}
                                sq ft

                            </div>

                        </div>


                        <div class="col-md-auto">

                            <button
                                class="view-btn"
                                onclick="viewWarehouse('${warehouse.name}')"
                            >

                                View Details

                                <i class="fa-solid fa-arrow-right ms-1"></i>

                            </button>

                        </div>

                    </div>

                </div>

            `;

            }).join("");

        }


        /*
        ==========================================
           STORAGE NAME
        ==========================================
        */

        function getStorageName(type) {

            const names = {

                General: "General Storage",

                Cold: "Cold Storage",

                Climate: "Climate Controlled",

                Fulfillment: "Fulfillment"

            };

            return names[type] || type;

        }


        /*
        ==========================================
           VIEW WAREHOUSE
        ==========================================
        */

        function viewWarehouse(name) {

            alert(
                "You selected: " +
                name +
                "\n\nHere you can redirect the user to the warehouse details page."
            );

        }






 const warehouseSwiper = new Swiper(".warehouse-swiper", {

        slidesPerView: 4,
        spaceBetween: 18,

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        loop: false,

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        breakpoints: {

            576: {
                slidesPerView: 2,
                spaceBetween: 18
            },

            992: {
                slidesPerView: 3,
                spaceBetween: 18
            },

            1200: {
                slidesPerView: 4,
                spaceBetween: 18
            }

        }

    });

        document.addEventListener("DOMContentLoaded", function () {

        const testimonialSwiper = new Swiper(".testimonialSwiper", {

            slidesPerView: 1,

            spaceBetween: 30,

            speed: 700,

            loop: true,

            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            effect: "slide",

            navigation: {
                nextEl: ".testimonial-button-next",
                prevEl: ".testimonial-button-prev",
            },

            pagination: {
                el: ".testimonial-pagination",
                clickable: true,
            },

            keyboard: {
                enabled: true,
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },

                768: {
                    slidesPerView: 1,
                },

                1200: {
                    slidesPerView: 1,
                }
            }

        });

    });


document.addEventListener('DOMContentLoaded', function () {

    const blogSwiper = new Swiper('.blogSwiper', {

        slidesPerView: 1,
        spaceBetween: 24,

        loop: false,

        speed: 700,
        grabCursor: true,

        autoplay: {
            delay: 4500,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },

        pagination: {
            el: '.blogSwiper .swiper-pagination',
            clickable: true,
        },

        navigation: {
            nextEl: '.blog-next',
            prevEl: '.blog-prev',
        },

        breakpoints: {

            576: {
                slidesPerView: 1.5,
                spaceBetween: 20,
            },

            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },

            992: {
                slidesPerView: 3,
                spaceBetween: 28,
            }

        }

    });

});

