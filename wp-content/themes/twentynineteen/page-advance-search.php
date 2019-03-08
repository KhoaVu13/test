<?php
get_header('advance-search');
if (have_posts()) : while (have_posts()) : the_post();
    the_content();
endwhile;
endif;
?>
<div class="advance_search_append">

</div>
<script>
    jQuery(function ($) {
        $(document).on('change', '.advance_selector' ,function (event) {
            event.preventDefault();
            $value = $(this).attr('value');
            $.ajax({
                url: '<?php echo admin_url("admin-ajax.php"); ?>',
                type: 'POST',
                data: {
                    action: 'advance_search',
                    id: 'id',
                    value: $value,
                },
                success: function (data) {
                    $('.advance_search_append').html(data);
                }
            });
        });
    });
</script>



