$('[data-remove-entry]').click(function() {
    if (!confirm("Are you sure to delete this entry?")) return;
    
    let url = $(this).data("url");
    let token = $(this).data('token');
    let entry = $(this).closest('.entry');
    

    $.ajax({
        url: url,
        data: {
            _token: token
        },
        type: 'DELETE',
        success: function(result) {
            entry.remove();
        }
    });
});

$('[data-hide-tweet-btn]').click(function() {
    let url = $(this).data("url");
    let token = $(this).data('token');
    let action = $(this).data('action');

    let card = $(this).closest('.card');

    $.ajax({
        url: url,
        data: {
            api_token: token
        },
        type: action,
        success: function(result) {
            if (action == 'POST') {
                card.addClass('hidden');
            } else if (action == 'DELETE') {
                card.removeClass('hidden');
            }
        }
    });
});