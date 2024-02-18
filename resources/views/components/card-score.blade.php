<div class="card">
    <h5 class="card-header">{{ $header }}</h5>
    <div class="card-body">
        <canvas id="npsChart{{ $key }}" width="800" height="50"></canvas>
    </div>
    <x-card-zona
        header="Zona - Nota NPS"
        notaNps="{{ $notaNps }}"
        key="{{ $key }}"
    />
</div>


<script>
    var canvas = document.getElementById('npsChart{{ $key }}');
    var ctx = canvas.getContext('2d');

    // Defina as pontuações NPS
    var npsScores = {
        promoters: {{$promoterPercentage}}, // Porcentagem de promotores
        neutrals: {{$neutralPercentage}}, // Porcentagem de neutros
        detractors: {{$detractorPercentage}} // Porcentagem de detratores
    };

    // Configurações do gráfico
    var chartSettings = {
        lineWidth: 30,
        lineColor: 'lightgray',
        promotersColor: 'Green',
        neutralsColor: 'Yellow',
        detractorsColor: 'Red'
    };

    // Desenhe o gráfico de NPS
    function drawNPSChart() {
        var startX = 30;
        var startY = 30;

        // Desenhe a linha de base
        ctx.beginPath();
        ctx.moveTo(startX, startY);
        ctx.lineTo(startX + 700, startY);
        ctx.lineWidth = chartSettings.lineWidth;
        ctx.strokeStyle = chartSettings.lineColor;
        ctx.stroke();
        ctx.font = "14px Arial black";
        ctx.fillStyle = "Black";

        let widthPromoters = npsScores.promoters / 100 * 700;
        // Desenhe a linha de progresso para promotores
        drawProgressLine(startX, startY, widthPromoters, chartSettings.promotersColor);
        drawProgressLine(startX, 0, 10, chartSettings.promotersColor, 20);
        ctx.fillText("Promotores: " + npsScores.promoters + "%", startX + 15, startY - 20);

        let widthNeutrals = npsScores.neutrals / 100 * 700;
        // Desenhe a linha de progresso para neutros
        drawProgressLine(startX + widthPromoters, startY, npsScores.neutrals / 100 * 700, chartSettings.neutralsColor);
        drawProgressLine(startX + 200 - 15, 0, 10, chartSettings.neutralsColor, 20);
        ctx.fillText("Neutros: " + npsScores.neutrals + "%", startX + 200, 10);

        // Desenhe a linha de progresso para detratores
        drawProgressLine(startX + widthPromoters + widthNeutrals, startY, npsScores.detractors / 100 * 700, chartSettings.detractorsColor);
        drawProgressLine(startX + 400 - 15, 0, 10, chartSettings.detractorsColor, 20);
        ctx.fillText("Detratores: " + npsScores.detractors + "%", startX + 400, 10);
    }

    // Função para desenhar uma linha de progresso
    function drawProgressLine(x, y, length, color, lineWidth = null) {
        ctx.beginPath();
        ctx.moveTo(x, y);
        ctx.lineTo(x + length, y);
        ctx.lineWidth = lineWidth ? lineWidth : chartSettings.lineWidth;
        ctx.strokeStyle = color;
        ctx.stroke();
    }

    // Chame a função para desenhar o gráfico de NPS
    drawNPSChart();
</script>
