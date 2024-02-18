
    window.loadPage = (sUrl, sIdComponente = '#page-content') => {
        $.ajax({
            url: sUrl,
            type: 'GET',
            success: function(response) {
                $(sIdComponente).html(response);
                history.pushState({}, '', sUrl)
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar a página:', error);
            }
        });

    }
