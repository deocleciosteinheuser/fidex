<div class="d-flex flex-wrap">
    <script>
          var cardNps = new function() {
            var canvas;
            var detratores = 0;
            var neutros = 0;
            var promotores = 0;
            var ctx = null;
            var centerX = 0;
            var centerY = 0;
            var radius = 40;
            var lineWidth = 20;


            // Função para desenhar um segmento do anel
            this.drawSegment = (startAngle, endAngle, color) => {
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, startAngle, endAngle);
                ctx.lineWidth = lineWidth;
                ctx.strokeStyle = color;
                ctx.stroke();
            }

            // Função para converter percentual para radianos
            this.percentToRadians = (percent) => {
                return percent / 100 * (2 * Math.PI);
            }

            this.render = (oCanvas, iDetratores, iNeutros, iPromotores, iNotaNps) => {
                canvas = oCanvas;
                detratores = iDetratores;
                neutros = iNeutros;
                promotores = iPromotores;
                ctx = canvas.getContext('2d');
                centerX = canvas.width / 2;
                centerY = canvas.height / 2;
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                // Desenha o anel de detratores
                this.drawSegment(0, this.percentToRadians(detratores), '#dc3545'); // laranja

                // Desenha o anel de neutros
                this.drawSegment(this.percentToRadians(detratores), this.percentToRadians(detratores + neutros), '#ffc107'); // verde

                // Desenha o anel de promotores
                this.drawSegment(this.percentToRadians(detratores + neutros), this.percentToRadians(100), '#198754'); // azul

                // Escreve o número percentual dentro do círculo
                ctx.fillStyle = '#000'; // Cor do texto
                ctx.font = '30px Arial black'; // Estilo do texto
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(iNotaNps, centerX, centerY);
            }
        }
    </script>
    @foreach ($dados as $key => $oDado)
    <div class="card text-black bg-light" style="max-width: 21rem;" wire:key="card-nps-{{ $key }}">
        <h5 class="card-header">{{ $oDado->agrupador }}</h5>
        <div class="card-body">
            <table class="table-light text-black bg-light" style="max-width: 28rem;">
                <tbody>
                    <tr>
                        <td>
                            <span id="npsCanvas{{ $key }}-nota_nps" class="visually-hidden">{{ $oDado->nota_nps }}</span>
                            <canvas id="npsCanvas{{ $key }}" width="100" height="100"
                                x-data="{
                                    initialize: () => {
                                        cardNps.render(
                                            document.getElementById('npsCanvas{{ $key }}'),
                                            parseInt(document.getElementById('npsCanvas{{ $key }}-detrator').textContent),
                                            parseInt(document.getElementById('npsCanvas{{ $key }}-neutro').textContent),
                                            parseInt(document.getElementById('npsCanvas{{ $key }}-promotor').textContent),
                                            parseInt(document.getElementById('npsCanvas{{ $key }}-nota_nps').textContent)
                                        );
                                        return true;
                                    }
                                }"

                                x-show="initialize()"
                            ></canvas>
                        </td>
                        <td>
                            <table class="table-light bg-light">
                                <tr>
                                    <td>
                                        <span class="badge bg-danger d-flex">Detrator</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger d-flex">{{ $oDado->respostas_detrator }}</span>
                                    </td>
                                    <td>
                                        <span id="npsCanvas{{ $key }}-detrator" class="badge bg-danger d-flex">{{ $oDado->detrator }}%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge bg-warning d-flex">Neutro</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning d-flex">{{ $oDado->detrator }}</span>
                                    </td>
                                    <td>
                                        <span id="npsCanvas{{ $key }}-neutro" class="badge bg-warning d-flex">{{ $oDado->neutro }}%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge bg-success d-flex">Promotor</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success d-flex">{{ $oDado->respostas_promotor }}</span>
                                    </td>
                                    <td>
                                        <span id="npsCanvas{{ $key }}-promotor" class="badge bg-success d-flex">{{ $oDado->promotor }}%</span>
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
                                            <span class="fs-6">{{ $oDado->total_resposta }}</span>
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
    @endforeach
</div>
