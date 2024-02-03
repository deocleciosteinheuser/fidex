<div class="card text-black bg-light" style="max-width: 21rem;">
    <div class="card-header">
        <span class="badge text-dark fs-4">{{ $username }}</span>
    </div>
    <div class="card-body">
        <table class="table-light text-black bg-light" style="max-width: 28rem;">
            <tbody>
                <tr>
                    <td>
                        <canvas id="npsCanvas{{ $key }}" width="100" height="100"></canvas>
                    </td>
                    <td>
                        <table class="table-light bg-light">
                            <tr>
                                <td>
                                    <span class="badge bg-danger d-flex">Detrator</span>
                                </td>
                                <td>
                                    <span class="badge bg-danger d-flex">{{ $detractorCount }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-danger d-flex">{{ $detractorPercentage }}%</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="badge bg-warning d-flex">Neutro</span>
                                </td>
                                <td>
                                    <span class="badge bg-warning d-flex">{{ $neutralCount }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-warning d-flex">{{ $neutralPercentage }}%</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="badge bg-success d-flex">Promotor</span>
                                </td>
                                <td>
                                    <span class="badge bg-success d-flex">{{ $promoterCount }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-success d-flex">{{ $promoterPercentage }}%</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table-light">
                            <tr>
                                <td>
                                    <span class="badge bg-dark">Total</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="badge bg-dark" style="border-radius: 50%; width: 40px; height: 40px; justify-content: center; align-items: center; display: flex;">
                                        <span class="fs-6">{{ $totalCount }}</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    var canvas = document.getElementById('npsCanvas{{ $key }}');
    var ctx = canvas.getContext('2d');

    var centerX = canvas.width / 2;
    var centerY = canvas.height / 2;
    var radius = 40;
    var lineWidth = 20;

    var detratores = {{$detractorPercentage}};
    var neutros = {{$neutralPercentage}};
    var promotores = {{$promoterPercentage}};

    // Função para desenhar um segmento do anel
    function drawSegment(startAngle, endAngle, color) {
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, startAngle, endAngle);
        ctx.lineWidth = lineWidth;
        ctx.strokeStyle = color;
        ctx.stroke();
    }

    // Função para converter percentual para radianos
    function percentToRadians(percent) {
        return percent / 100 * (2 * Math.PI);
    }

    // Desenha o anel de detratores
    drawSegment(0, percentToRadians(detratores), '#dc3545'); // laranja

    // Desenha o anel de neutros
    drawSegment(percentToRadians(detratores), percentToRadians(detratores + neutros), '#ffc107'); // verde

    // Desenha o anel de promotores
    drawSegment(percentToRadians(detratores + neutros), percentToRadians(100), '#198754'); // azul

    // Escreve o número percentual dentro do círculo
    ctx.fillStyle = '#000'; // Cor do texto
    ctx.font = '30px Arial black'; // Estilo do texto
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText({{ $notaNps}}, centerX, centerY);

</script>

