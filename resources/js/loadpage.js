
    function loadPage(slug) {
        $.ajax({
            url: '/page/' + slug,
            type: 'GET',
            success: function(response) {
                $('#page-content').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar a página:', error);
            }
        });
    }
