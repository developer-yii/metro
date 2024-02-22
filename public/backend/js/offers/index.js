$(document).ready(function () {
    $("#offer-form").validate({
        rules: {
            percentage: {
                required: true,
                number: true,
                min: 0,
                max: 100, // Assuming percentage is between 0 and 100
                // Add a custom method to allow decimal values                
                decimalWithTwoPlaces: true,
            },
        },
        messages: {
            percentage: {
                required: "Please enter a percentage value.",
                number: "Please enter a valid number.",
                min: "Percentage must be greater than or equal to 0.",
                max: "Percentage must be less than or equal to 100.",
                decimal: "Please enter a valid decimal value.",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element); // Display error message below the input field
            return;
        },
    });

    // Add custom method to validate decimal values
    $.validator.addMethod(
        "decimalWithTwoPlaces",
        function (value, element) {
            // Regular expression to validate decimal numbers with up to 2 decimal places
            return /^\d+(\.\d{1,2})?$/.test(value);
        },
        "Please enter a valid decimal value with up to 2 decimal places."
    );

    var offerDatatable = $("#offer-datatable").DataTable({        
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
        columnDefs: [
            { width: "150px", targets: -1 }, // Set the width of the last column to 100 pixels
        ],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>",
            },
        },
        ajax: {
            type: "POST",
            url: getOfferDataLink,
        },
        columns: [
            {
                data: "productName",
                name: "productName",
            },
            {
                data: "mid",
                name: "mid",
            },
            {
                data: "offer_price",
                name: "offer_price",
            },
            {
                data: "percentage",
                name: "percentage",
            },
            {
                data: "is_interested_product",
                name: "is_interested_product",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass(
                "pagination-rounded"
            );
        },
    });

    $("#offer-form").submit(function (e) {
        e.preventDefault();
        var $this = $(this);

        if (!$this.valid()) {
            event.preventDefault(); // Prevent form submission
            return;
        }

        var formData = new FormData($("#offer-form")[0]);
        formData.append("_method", "PUT");

        $.ajax({
            type: "POST",
            url: addEditUrl,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $($this).find('button[type="submit"]').prop("disabled", true);
            },
            success: function (response) {
                $(".error").html("");
                $($this).find('button[type="submit"]').prop("disabled", false);

                if (response.status) {
                    $("#offer-modal").modal("hide");
                    offerDatatable.draw();

                    showSuccessToast({
                        text: response.message,
                    });
                } else {
                    showErrorToast({
                        heading: "Opss..!",
                        text: response.message,
                    });
                }
            },
            error: function (error) {
                $(".error").html("");
                $($this).find('button[type="submit"]').prop("disabled", false);

                /* Show validation error using make OfferRequest */
                if (error.status === 422) {
                    var errors = error.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        $("#" + key)
                            .closest(".col-md-12")
                            .find(".error")
                            .html(value);
                    });
                } else {
                    showErrorToast({
                        heading: "Opss..!",
                        text: "Something went wrong!",
                    });
                }
            },
        });
    });

    $("body").on("click", ".offer-edit", function (e) {
        var offerId = $(this).data("id");
        $(".error").html("");
        $("#offer-form")[0].reset();

        $.ajax({
            url: detailUrl,
            type: "POST",
            data: { id: offerId },
            success: function (response) {
                if (response.status) {
                    $("#edit-id").val(response.data.id);
                    $("#offer-form")
                        .find("#offer_name")
                        .html(response.data.productName);

                    if (
                        response.customOffer &&
                        response.customOffer.percentage !== null &&
                        response.customOffer.percentage !== undefined
                    ){                        
                        $("#offer-form")
                            .find("#percentage")
                            .val(response.customOffer.percentage);                   
                    }else{
                        $("#offer-form")
                            .find("#percentage")
                            .val('');                   

                    }

                    if (
                        response.customOffer &&
                        response.customOffer.is_interested_product !== null &&
                        response.customOffer.is_interested_product !== undefined
                    ) {
                        $("#is_interested_product")
                            .prop(
                                "checked",
                                response.customOffer.is_interested_product
                            )
                            .trigger("change");
                    } else {
                        // Handle the case where customOffer is null or is_interested_product is not available
                        $("#is_interested_product")
                            .prop("checked", true)
                            .trigger("change");
                    }
                    $("#offer-modal").modal("show");
                }
            },
        });
    });            
});
