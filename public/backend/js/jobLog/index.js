$(document).ready(function () {   

    var jobLogDatatable = $("#jobLog-datatable").DataTable({        
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
            url: getJobLogLink,
        },
        columns: [
            {
                data: "productName",
                name: "productName",
            },
            {
                data: "productKey",
                name: "productKey",
            },            
            {
                data: "create_time",
                name: "create_time",
            },            
        ],
        order: [[2, 'desc']],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass(
                "pagination-rounded"
            );
        },
    });     
});
