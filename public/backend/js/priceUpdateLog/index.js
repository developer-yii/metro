$(document).ready(function () {

    var priceUpdateDatatable = $("#priceUpdate-datatable").DataTable({
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
        columnDefs: [
            { width: "150px", targets: -1 }, // Set the width of the last column to 100 pixels
            { visible: false, targets: [6] } // Hide the 7th column (index 6)
        ],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>",
            },
        },
        ajax: {
            type: "POST",
            url: getLogDataLink,
        },
        columns: [
            {
                data: "productName",
                name: "productName",
            },
            {
                data: "mmid",
                name: "mmid",
            },
            {
                data: "old_price",
                name: "old_price",
            },
            {
                data: "new_price",
                name: "new_price",
            },
            {
                data: "type",
                name: "type",
            },
            {
                data: "created_at",
                name: "created_at",
                render: function(data, type, row) {
                    // Assuming data is in the format 'Y-m-d H:i:s'
                    var dateObj = new Date(data);
                    // Format date as desired
                    var formattedDate = ('0' + dateObj.getDate()).slice(-2) + '.' + ('0' + (dateObj.getMonth() + 1)).slice(-2) + '.' + dateObj.getFullYear() + ' ' + ('0' + dateObj.getHours()).slice(-2) + '.' + ('0' + dateObj.getMinutes()).slice(-2);
                    return formattedDate;
                }
            },
            {
                data: "create_time_formatted", // Use the formatted date from the controller
                name: "create_time_formatted",
            },

        ],
        order: [[5, 'desc']],
        // ordering: false,
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass(
                "pagination-rounded"
            );
        },
    });
});
