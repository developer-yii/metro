$(document).ready(function () {
    var userDatatable = $("#user-datatable").DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",
        columnDefs: [
            { "width": "150px", "targets": -1 },  // Set the width of the last column to 100 pixels
        ],
        buttons: [
            {
                extend: 'copy',
                filename: 'user_copy',
                title: 'User Data Copy',
                exportOptions: {
                    columns: [0, 1, 2] // Include columns with indexes 0, 1, and 2
                },
            },
            {
                extend: 'csv',
                filename: 'user_csv',
                title: 'User Data CSV',
                exportOptions: {
                    columns: [0, 1, 2] // Include columns with indexes 0, 1, and 2
                },
            },
            {
                extend: 'excel',
                filename: 'user_excel',
                title: 'User Data Excel',
                exportOptions: {
                    columns: [0, 1, 2] // Include columns with indexes 0, 1, and 2
                },
            },
            {
                extend: 'pdf',
                filename: 'user_pdf',
                title: 'User Data PDF',
                exportOptions: {
                    columns: [0, 1, 2] // Include columns with indexes 0, 1, and 2
                },
            },
            {
                extend: 'print',
                filename: 'user_print',
                title: 'User Data Print',
                exportOptions: {
                    columns: [0, 1, 2] // Include columns with indexes 0, 1, and 2
                },
            }
        ],
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

    $("#create-user").click(function () {
        $("#user-form")[0].reset();
        $("#user-form").find('.error').html('');
    });

    $("#user-form").submit(function (e) {
        e.preventDefault();
        var $this = $(this);

        var formData = new FormData($("#user-form")[0]);
        formData.append('_method', 'PUT');

        $.ajax({
            type: 'POST',
            url: addEditUrl,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $($this).find('button[type="submit"]').prop('disabled', true);
            },
            success: function(response) {
                $('.error').html("");
                $($this).find('button[type="submit"]').prop('disabled', false);

                if(response.status == 200) {
                    $('#user-modal').modal('hide');
                    userDatatable.draw();

                    showSuccessToast({
                        text: response.message,
                    });
                }
            },
            error: function(error) {
                $('.error').html("");
                $($this).find('button[type="submit"]').prop('disabled', false);

                /* Show validation error using make UserRequest */
                if (error.status === 422) {
                    var errors = error.responseJSON.errors;

                    $.each(errors, function(key, value) {
                        $("."+key+"Err").text(value);
                    });

                } else {
                    showErrorToast({
                        heading: 'Opss..!',
                        text: 'Something went wrong!',
                    });
                }

            }
        });
    });

    $('body').on('click', '.user-edit', function(e) {
        var userId = $(this).data('id');
        $('.error').html('');
        $('#user-form')[0].reset();

        $.ajax({
            url: detailUrl,
            type: 'POST',
            data: {id: userId},
            success: function (response) {
                if(response.status) {
                    $('#edit-id').val(userId);
                    $('#user-form').find('#name').val(response.data.name);
                    $('#user-form').find('#email').val(response.data.email);

                    $("label[for='password']").find("span.text-danger").remove();
                    $("label[for='password_confirmation']").find("span.text-danger").remove();

                    $('#user-modal').modal('show');
                }
            }
        });

    });

    $('body').on('click', '.user-view', function(e) {
        var userId = $(this).data('id');
        $("#user-view").find('.error').html('');
        $.ajax({
            url: detailUrl,
            type: 'POST',
            data: {id: userId},
            success: function (response) {
                if(response.status) {
                    $('#edit-id').val(userId);
                    $('#user-view').find('#view_name').val(response.data.name);
                    $('#user-view').find('#view_email').val(response.data.email);

                    $('#user-view-modal').modal('show');
                }
            }
        });

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


});
