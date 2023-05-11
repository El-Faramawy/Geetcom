<script>
    $(document).on('click', '.block', function (e) {
        e.preventDefault();
        // alert(1)
        var id = $(this).data('id');
        var text = $(this).data('text');
        swal.fire({
            title: "هل أنت متأكد من "+ text +" المستخدم؟",
            text: "سيتم "+text+" المستخدم",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "موافق",
            cancelButtonText: "الغاء",
            okButtonText: "موافق",
            closeOnConfirm: false
        }).then((result) => {
            if (!result.isConfirmed) {
                return true;
            }


            var url = '{{ url('admin/block_user') }}/'+id;
            // url = url.replace(':id', id)
            console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function () {
                    $('#global-loader').show()
                },
                success: function (data) {

                    window.setTimeout(function () {
                        $('#global-loader').hide()
                        if (data.code == 200) {
                            my_toaster(data.message, 'info')
                            $('#exportexample').DataTable().ajax.reload(null, false);
                        } else {
                            my_toaster("هناك خطأ", 'error')
                        }

                    }, 1000);
                }, error: function (data) {
                    $('#global-loader').hide()

                    if (data.status === 500) {
                        my_toaster("هناك خطأ", 'error')
                    }


                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);

                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    my_toaster(value, 'error')
                                });

                            } else {

                            }
                        });
                    }
                }

            });
        });
    });
</script>
