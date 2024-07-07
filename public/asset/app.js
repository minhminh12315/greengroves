var R = {
    init: function () {
        R.navbarStick();
        R.registerEvents();
        R.generateCombinations();
        R.headerStickyMinScreen();
    },
    registerEvents: function () {
        let variantCount = 0;
        let variantData = [];

        $("#add_variant").click(function () {
            variantCount++;
            $("#variants_container").append(`
                <div class="variant-group mb-2" data-variant-id="${variantCount}">
                    <div class="form-group">
                        <label for="variant_name_${variantCount}">Variant Name</label>
                        <input wire:model="variantNames[]" type="text" class="form-control variant-name" name="variant_name[]" required>
                    </div>
                    <div class="variant-options-container" data-variant-id="${variantCount}"></div>
                    <button type="button" class="btn btn-info badge add_variant_option" data-variant-id="${variantCount}">Add Variant Option</button>
                    <button type="button" class="btn btn-danger badge remove_variant">Remove Variant</button>
                </div>
            `);
        });

        $(document).on("click", ".remove_variant", function () {
            $(this).closest(".variant-group").remove();
        });

        $(document).on("click", ".add_variant_option", function () {
            let variantId = $(this).data("variant-id");
            $(
                `.variant-options-container[data-variant-id="${variantId}"]`
            ).append(`
                <div class="variant-option-group">
                    <div class="form-group">
                        <label for="value_${variantId}">Option Value</label>
                        <input wire:model="values[]" type="text" class="form-control variant-value" name="value[${variantId}][]" required>
                    </div>
                    <button type="button" class="btn btn-danger badge remove_variant_option">Remove Option</button>
                </div>
            `);
        });

        $(document).on("click", ".remove_variant_option", function () {
            $(this).closest(".variant-option-group").remove();
        });

        $("#generate_combinations").click(function () {
            variantData = [];
            $("#variants_container .variant-group").each(function () {
                let variantName = $(this).find(".variant-name").val();
                let options = [];
                $(this)
                    .find(".variant-value")
                    .each(function () {
                        options.push(variantName + ": " + $(this).val());
                    });
                variantData.push({ name: variantName, options: options });
            });

            let combinations = R.generateCombinations(variantData);
            $("#combinations_container").empty();
            combinations.forEach((combination, index) => {
                $("#combinations_container").append(`
                    <div class="combination-group mb-2">
                        <div class="form-group">
                            <label>Combination: ${combination.join(
                    ", "
                )}</label>
                            <input type="hidden" name="combinations[${index}]" value="${combination.join(
                    ", "
                )}">
                        </div>
                        <div class="form-group">
                            <label for="quantity_${index}">Quantity</label>
                            <input wire:model="quantities[]" type="number" class="form-control" name="quantity[${index}]" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="price_${index}">Price</label>
                            <input wire:model="prices[]" type="number" step="0.01" class="form-control" name="price[${index}]" min="0" required>
                        </div>
                    </div>
                `);
            });
        });
        $('.btn-toggle-menu').click(() => {
            $('.menu-collapse-header').toggleClass('show');
        })
        $('.btn-close-menu').click(() => {
            $('.menu-collapse-header').removeClass('show');
        });
        $('.btn-user').click(() => {
            $('.loggedInUser').toggleClass('show');
        });
        $(document).on('livewire:init', function () {
            Livewire.on('swalsuccess', (e) => {
                const data = e;
                Swal.fire({
                    icon: data[0].icon,
                    title: data[0].title,
                    text: data[0].text,
                    timer: 3000
                });
            });
        });
    },

    generateCombinations: (variants) => {
        let result = [];
        let f = function (prefix, variants) {
            if (variants.length === 0) {
                result.push(prefix);
                return;
            }
            let variant = variants[0];
            let rest = variants.slice(1);
            variant.options.forEach(function (option) {
                f(prefix.concat([option]), rest);
            });
        };
        f([], variants);
        return result;
    },
    formInputProductType: () => {
        if ($("input[name=product_type]:checked").val() == "single") {
            $("#variants_container").empty();
            $("#combinations_container").empty();
        }
        if ($("input[name=product_type]:checked").val() == "variable") {
            $("#variants_container").empty();
            $("#combinations_container").empty();
            $("#variants_container").append(`
                <div class="variant-group mb-2" data-variant-id="${variantCount}">
                    <div class="form-group">
                        <label for="variant_name_${variantCount}">Variant Name</label>
                        <input type="text" class="form-control variant-name" name="variant_name[]" required>
                    </div>
                    <div class="variant-options-container" data-variant-id="${variantCount}"></div>
                    <button type="button" class="btn btn-info badge add_variant_option" data-variant-id="${variantCount}">Add Variant Option</button>
                    <button type="button" class="btn btn-danger badge remove_variant">Remove Variant</button>
                </div>
            `);

        }
    },
    navbarStick: () => {
        let navbar = $('.nav-home');
        let sticky = navbar.offset().top;
        $(window).scroll(function () {
            if ($(window).scrollTop() >= sticky) {
                navbar.addClass("navbarSticky");
                navbar.css("top", "0");
            } else {
                navbar.removeClass("navbarSticky");
                navbar.css("top", "");
            }
        });
    },
    // showSweetAlert: function (title, text, icon) {
    //     Swal.fire({
    //         title: title,
    //         text: text,
    //         icon: icon,
    //         timer: 3000,
    //         toast: true,
    //     });
    // }
};
R.init();
