
    window.loadPage = (sUrl) => {
        $.ajax({
            url: sUrl,
            type: 'GET',
            success: function(response) {
                $('#page-content').html(response);
                history.pushState({}, '', sUrl)
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar a página:', error);
            }
        });

    }
