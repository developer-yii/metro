$(document).ready(function () {

    var jobLogDatatable = $("#jobLog-datatable").DataTable({
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
        columnDefs: [
            { width: "150px", targets: -1 }, // Set the width of the last column to 100 pixels
            { visible: false, targets: [4] } // Hide the 5th column (index 4)
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
                data: "destination",
                name: "destination",
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
