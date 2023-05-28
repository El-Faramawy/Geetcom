<script>
    $(document).on('change','#category_id', function (e){
        e.preventDefault()
        var market_id = $('#market_id').val();
        var category_id = $(this).val();
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url("admin/get_market_sub_categories")}}?'+'market_id='+market_id+'&category_id='+category_id,
            success: function (data) {
                $("#sub_category_id").html(data);
            },
            error: function() {
                console.log(data);
            }
        });
    })
</script>
