<script>
    $(document).ready(function() {
        load_data();

        function load_data() {
            $.ajax({
                url: "fetch-product.php",
                method: "POST",
                success: function(data) {
                    $('#user-data').html(data);
                }
            });
        }
        $("#user_dialog").dialog({
            autoOpen: false,
            width: 600
        });

        $("#add-to-cart").click(function() {
            $('#user_dialog').attr('title', 'Thêm Sản Phẩm');
            $('#action').val('insert');
            $('#form_action').val('Thêm Vào Giỏ');
            $('#form_action').attr('dissabled', false);
            $('#user_form')[0].reset();
            $('#user_dialog').dialog('open');
        });


        $('#add_form').on('submit', function(event) {
            event.preventDefault();
            var product_id = $(this).attr(id);
            var product_quantity = '1';
            if ($('#product-id').val() != '') {

            }
        });
    })
</script>