<script>
    $(document).on('change','#category_ids', function (e){
        e.preventDefault()
        // var category_ids = $(this).val();
        var category_ids = $('#category_ids').val();
        // alert(JSON.parse(category_ids) );
        // alert(typeof category_ids);
    $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url("admin/get_market_sub_categories")}}?'+'category_ids='+category_ids,
            success: function (data) {
                $("#sub_categories").html(data);
            },
            error: function() {
                console.log(data);
            }
        });
    })
</script>
