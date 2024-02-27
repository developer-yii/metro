$(document).ready(function () {   

    var priceUpdateDatatable = $("#priceUpdate-datatable").DataTable({        
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
                data: "create_time",
                name: "create_time",
            },            
        ],
        order: [[5, 'desc']],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass(
                "pagination-rounded"
            );
        },
    });     
});
