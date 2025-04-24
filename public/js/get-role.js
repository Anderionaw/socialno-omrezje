(function($) {
'use strict';

    $(document).on('change', '#role_create', function() {
        var token = $('#token').val();
        $.ajax({
            url : "/admin/get-role-permissions-badge",
            type: 'get',
            data: {
                id : $(this).val(),
                _token : token
            },
            success: function(res)
            {
                $('#permission_create').html(res);
            },
            error: function()
            {
                alert('failed...');

            }
        });
    });

    $(document).on('change', '#role_edit', function() {
        var token = $('#token').val();
        $.ajax({
            url : "/admin/get-role-permissions-badge",
            type: 'get',
            data: {
                id : $(this).val(),
                _token : token
            },
            success: function(res)
            {
                $('#permission_edit').html(res);
            },
            error: function()
            {
                alert('failed...');

            }
        });
    });

    $('select').select2();

})(jQuery);
