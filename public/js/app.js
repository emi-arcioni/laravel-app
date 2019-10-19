$('[data-remove-entry]').click(function() {
    if (!confirm("Are you sure to delete this entry?")) return;
    
    let url = $(this).data("url");
    let token = $(this).data('token');
    let tr = $(this).closest('tr');
    

    $.ajax({
        url: url,
        data: {
            _token: token
        },
        type: 'DELETE',
        success: function(result) {
            tr.remove();
            // Do something with the result
        }
    });
});