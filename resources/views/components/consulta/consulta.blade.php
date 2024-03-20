@props([
   'url' => ''
])


<div class="container mt-5">
    <h2 class="text-center">Consulta por {{$agrupador['title']}}</h2>

    <!-- Filtro -->
    <div class="row mb-3 d-none" >
        <div class="col-md-6">
            <label for="filtro">Filtrar por:</label>
            <select class="form-control" id="filtro">
                <option value="todos">Todos</option>
                <option value="SC">Promotores</option>
                <option value="PR">Detratores</option>
            </select>
        </div>
    </div>

    <!-- Tabela de Dados
        se ativar o data-side-pagination="server" o filtro deve ser tratado do lado servidor
     -->
    <div class="row">
        <div class="col">
            <table class="table"
                id="table"
                data-filter-control="true"
                data-toggle="table"
                data-flat="true"
                data-url="{{$url}}"
                data-toolbar="#toolbar"
                data-search="true"
                data-show-refresh="true"
                data-show-toggle="true"
                data-show-fullscreen="true"
                data-show-columns="true"
                data-show-columns-toggle-all="true"
                data-detail-view="true"
                data-detail-formatter="consulta.detailFormatter"
                data-show-export="true"
                data-click-to-select="true"
                data-minimum-count-columns="2"
                data-show-pagination-switch="true"
                data-pagination="true"
                data-id-field="geo"
                --data-page-list="[10, 25, 50, 100, all]"
                --data-show-footer="true"
                --data-side-pagination="server"
                data-response-handler="consulta.responseHandler"
                data-locale="pt-br">

                <thead>
                    <tr>
                        <th data-field="agrupador"  data-sortable="true">{{$agrupador['title']}}</th>
                        <th data-field="promotor" data-sortable="true">Promotor</th>
                        <th data-field="neutro" data-sortable="true">Neutro</th>
                        <th data-field="detrator" data-sortable="true">Detrator</th>
                        <th data-field="total_resposta" data-sortable="true">Total de Respostas</th>
                        <th data-field="nota_nps" data-sortable="true">Nota do NPS</th>
                        <th data-field="percentual_nps" data-sortable="true">Percentual NPS</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    var consulta = new function() {
        var selections = [];

        this.getTable = () => $('#table');
        this.getRemove = () => $('#remove');

        this.getIdSelections = () => $.map(this.getTable().bootstrapTable('getSelections'), function (row) {
            return row.id
        });


        this.responseHandler = (res) => {
            $.each(res.rows, function (i, row) {
                row.state = $.inArray(row.id, selections) !== -1
            })
            return res
        }

        this.detailFormatter = function(index, row) {
            oTable = this;
            var html = ['<table class="table"><colgroup><col class="col-md-3"><col class="col-md-2"><col class="col-md-7"></colgroup><tbody>']
            $.each(row, function (key, value) {
                html.push('<tr><td><b>' + getTitleColumn(oTable, key) + '</b></td><td>' + value + '</td><td></td> </tr>')
            })
            html.push('</tbody></table>');
            return html.join('')
        }

        this.getTitleColumn = (table, column) => {
            title = column
            table.columns[0].forEach(element => {
                if(element.field === column) {
                    title = element.title;
                }
            })
            return title
        }

        this.operateFormatter = (value, row, index) => [
            '<a class="like" href="javascript:void(0)" title="Like">',
            '<i class="fa fa-heart"></i>',
            '</a>  ',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash"></i>',
            '</a>'
        ].join('');

        window.operateEvents = {
            'click .like': function (e, value, row, index) {
                alert('You click like action, row: ' + JSON.stringify(row))
            },
            'click .remove': function (e, value, row, index) {
                table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id]
                })
            }
        }

        this.totalTextFormatter = (data) => 'Total';

        this.totalNameFormatter = (data) => data.length;

        this.totalPriceFormatter = (data) => {
            var field = this.field
            return '$' + data.map(function (row) {
                return +row[field].substring(1)
            }).reduce(function (sum, i) {
                return sum + i
            }, 0)
        }

        this.initTable = () => {
            this.getTable().bootstrapTable('destroy').bootstrapTable({

                locale: $('#locale').val(),
                columns: [
                    {
                        title:'{{$agrupador['title']}}',
                        field:'agrupador',
                        align: 'left',
                        sortable: true
                    },{
                        title:'Promotor',
                        field:"promotor",
                        align: 'right',
                        sortable: true
                    },{
                        title:'Respostas Promotor',
                        field:"respostas_promotor",
                        align: 'right',
                        sortable: true,
                        visible: false
                    },{
                        title:'Neutro',
                        field:"neutro",
                        align: 'right',
                        sortable: true
                    },{
                        title:'Respostas Neutro',
                        field:"respostas_neutro",
                        align: 'right',
                        sortable: true,
                        visible: false
                    },{
                        title:'Detrator',
                        field:"detrator",
                        align: 'right',
                        sortable: true
                    },{
                        title:'Respostas Detrator',
                        field:"respostas_detrator",
                        align: 'right',
                        sortable: true,
                        visible: false
                    },{
                        title:'Total de Respostas',
                        field:"total_resposta",
                        align: 'right',
                        sortable: true
                    },{
                        title:'Nota do NPS',
                        field:"nota_nps",
                        align: 'right',
                        sortable: true
                    },{
                        title:'Percentual NPS',
                        field:"percentual_nps",
                        align: 'right',
                        sortable: true
                    }
                ]

            })
        this.getTable().on('check.bs.table uncheck.bs.table ' +
            'check-all.bs.table uncheck-all.bs.table',
            function () {
                 this.getRemove().prop('disabled', !this.getTable().bootstrapTable('getSelections').length)

                // save your data, here just save the current page
                selections = getIdSelections()
                // push or splice the selections if you want to save all data selections
            }
        )
        this.getTable().on('all.bs.table', function (e, name, args) {
                //console.log(name, args)
            })
            this.getRemove().click(function () {
                var ids = getIdSelections()
                this.getTable().bootstrapTable('remove', {
                    field: 'agrupador',
                    values: ids
                })
                this.getRemove().prop('disabled', true)
            })
        }
    }

  </script>
  <script type="module">

    $(function() {
        //consulta.initTable()
        $('#locale').change(consulta.initTable)
    })

  </script>
