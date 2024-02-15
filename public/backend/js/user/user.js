$(document).ready(function () {
    var userDatatable = $("#user-datatable").DataTable({
        // dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
        columnDefs: [
            { "width": "150px", "targets": -1 },  // Set the width of the last column to 100 pixels
        ],
        // buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>",
            },
        },
        ajax: {
            type: "POST",
            url: getUserDataLink,
        },
        columns:[{
            data: 'name',
            name: 'name',
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'is_active',
            name: 'is_active'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }
        ],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        },
    });

    $('body').on('click', '.delete-data', function(e) {
        var userId = $(this).data('id');
        $('#delete-modal').find("#delete-id").val(userId);
    });

    $('body').on('click', '#continue', function(e) {
        var id = $('#delete-modal').find("#delete-id").val();

        $.ajax({
            url: deleteUrl,
            type: 'POST',
            data: {id: id},
            success: function (response) {
                $("#delete-modal").modal('hide');

                if (response.status) {
                    showSuccessToast({
                        text: response.message,
                    });
                } else {
                    showErrorToast({
                        heading: 'Opss..!',
                        text: 'Something went wrong!',
                    });
                }

                userDatatable.draw();
            }
        });
    });

    $("#import-file-btn").click(function () {
        $("#import-form")[0].reset();
        $("#import-form").find('.error').html('');
        $("#download_sample_file").attr('href', csvUrl);
        $("#import-form").find("#file").attr('accept','.csv');
    });

    $("#import-form").submit(function (e) {
        e.preventDefault();
        var $this = $(this);

        var formData = new FormData($("#import-form")[0]);

        $.ajax({
            type: "POST",
            url: importUrl,
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $($this).find('button[type="submit"]').prop('disabled', true);
            },
            success: function (response) {
                $('.error').html("");
                $($this).find('button[type="submit"]').prop('disabled', false);

                if(response.status) {
                    $("#import-file-modal").modal('hide');
                    userDatatable.draw();

                    showSuccessToast({
                        text: response.message,
                    });

                } else {

                    // Display errors in the error modal
                    if (response.file_errors && response.file_errors.length > 0) {
                        var errorListHtml = "";
                        $.each(response.file_errors, function (key, value) {
                            errorListHtml += `<li class="text-danger">${value}</li>`;
                        });

                        $('#importErrorList').html(errorListHtml);
                        $('#importErrorModal').modal('show');
                        $("#import-file-modal").modal('hide');
                    }

                    // Valid file
                    if (response.file_upload_errors) {
                        showErrorToast({
                            heading: 'Opss..!',
                            text: response.file_upload_errors,
                        });
                    }

                    $.each(response.errors, function(key, value) {
                        $("."+key+"Err").text(value);
                    });
                }
            },
            error: function (error) {
                showErrorToast({
                    heading: 'Opss..!',
                    text: 'Something went wrong!',
                });
            }
        });
    });

    $("#file_type").change(function (e) {
        var type = $(this).val();

        if(type == "excel") {
            $("#download_sample_file").attr('href', excelUrl);
            $("#import-form").find("#file").attr('accept','.xlsx, .xls');
        } else {
            $("#download_sample_file").attr('href', csvUrl);
            $("#import-form").find("#file").attr('accept','.csv');
        }
    });
});
