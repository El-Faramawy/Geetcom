<script>
    $(document).on('change','#market_id', function (e){
        e.preventDefault()
        var market_id = $(this).val();
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url("admin/get_market_categories")}}?'+'market_id='+market_id,
            success: function (data) {
                $("#category_id").html(data);
            },
            error: function() {
                console.log(data);
            }
        });
    })
</script>
