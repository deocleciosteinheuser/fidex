<div class="card">
    <h5 class="card-header">{{ $header }}</h5>
    <div class="card-body">
        <canvas id="npsScore{{ $key }}" width="400" height="100"></canvas>
    </div>
</div>
<script>
    var canvasZona = new function() {
        var canvas = null;
        var notaNps = 0;
        var ctx = null;

        // Defina as faixas de pontuação e as cores correspondentes
        this.scoreRanges = [
            { range: [-100, 0], color: 'red'       , legend:"-100 e  0  - Crítica"},
            { range: [1, 50], color: 'orange'      , legend:"   1 e 50  - Aperfeiçoamento"},
            { range: [51, 75], color: 'yellow'     , legend:"  51 e 75  - Qualidade"},
            { range: [76, 90], color: 'lightgreen' , legend:"  76 e 90  - Excelência"},
            { range: [91, 100], color: 'green'     , legend:"  91 e 100 - Encantamento"}
        ];
        // Função para desenhar uma linha , quadrado e retangulo
        this.drawProgressLine = (x, y, length, color, lineWidth = null) => {
            ctx.beginPath();
            ctx.moveTo(x, y);
            ctx.lineTo(x + length, y);
            ctx.lineWidth = lineWidth ? lineWidth : chartSettings.lineWidth;
            ctx.strokeStyle = color;
            ctx.stroke();
        }
        // Desenhe o gráfico de arco
        this.drawNPSChart = () => {
            var centerX = canvas.width - canvas.height;
            var centerY = canvas.height - 10;
            var radius = Math.min(canvas.width, canvas.height) - 20;

            var startAngle = Math.PI; // Ângulo inicial para desenhar o arco (meia lua)
            var endAngle = startAngle; // Ângulo final para desenhar o arco (meia lua)
            this.scoreRanges.forEach(function(range) {
                // Calcular os ângulos inicial e final do arco para esta faixa de pontuação
                startAngle = endAngle;
                endAngle = endAngle + (Math.abs(range.range[1] - range.range[0] + 1) / 201) * Math.PI;
                // Create circle
                var zona = new Path2D();
                zona.arc(centerX, centerY, radius, startAngle, endAngle, false);
                ctx.lineWidth = 10;
                ctx.strokeStyle = range.color;
                ctx.stroke(zona);
            });

            // Escreve o número percentual dentro do arco
            this.scoreRanges.forEach((oRange) => {notaNps >= oRange.range[0] && notaNps <= oRange.range[1] && (ctx.fillStyle = oRange.color);});
            //ctx.fillStyle = '#000'; // Cor do texto
            ctx.font = '50px Arial black'; // Estilo do texto
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(notaNps, centerX, centerY-15);
        }

        this.legenda = () => {
            var yPos = 15;
            this.scoreRanges.forEach((oRenge) => {
                this.drawProgressLine(0, yPos, 10, oRenge.color, 10);
                ctx.font = '12px Courier'; // Estilo do texto
                ctx.fillText(oRenge.legend, 15, yPos+3);
                yPos += 15;
            });
        }

        this.render = (oCanvas, iNotaNps) => {
            canvas = oCanvas;
            notaNps = iNotaNps;
            ctx = canvas.getContext('2d');

            this.legenda();
            // Chame a função para desenhar o gráfico de arco
            this.drawNPSChart();
        }
    }
    canvasZona.render(document.getElementById('npsScore{{ $key }}'), {{ $notaNps}});

</script>
