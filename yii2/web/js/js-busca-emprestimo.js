/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#tableresult-rg').hide();

$('#btPesquisarPorRG').click(function () {
    var
        rg = $('#rgusuario').val();

    if (rg.length > 0) {


        $.get('emprestimo/get-busca-emprestimo-rg', {rg: rg}, function (data) {

            var
                data = $.parseJSON(data);
            if (data != null) {
                console.log(data);

                $('#view-exemplaresemprestados').html('');

                $('#tableresult-rg').show();
                $('#tbody-result-rg').html('');


                $('#result-messagem-busca-emprestimo-rg').attr('class', 'alert alert-success');

                $('#result-messagem-busca-emprestimo-rg').html('</b>Empréstimo(s) encontrado(s)</b>');



                data.forEach(function (item, index) {

                    console.log('item ' + item);


                    $('#tbody-result-rg').append(
                        '<tr><td>' + data[1][index].nome + '</td>' +
                        '<td>' + data[1][index].rg + '</td>' +
                        '<td>' + data[0][index].dataemprestimo + '</td>' +
                        '<td>' + data[0][index].dataprevisaodevolucao + '</td>' +
                        '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"' +
                        ' onclick="carregarDadosModalEmprestimo('+data[0][index].idemprestimo +')">Visualizar detalhes do Empréstimo ' +
                        '<span class=\'glyphicon glyphicon-search\'>' +
                        '</span></button>'
                        + '</td>' +
                        '</tr>');


                });

            } else {
                data = null;
                $('#tableresult-rg').hide();
                $('#tbody-result-rg').html('');
                $('#result-messagem-busca-emprestimo-rg').attr('class', 'alert alert-danger');
                $('#result-messagem-busca-emprestimo-rg').html('Nenhum empréstimo encontrado');
            }
        });
    }
});


$('#tableresult-emprestimo-exemplar').hide();
$('#btPesquisarExemplar').click(function () {
    var
        codigoExemplar = $('#codigoexemplar').val();

    if (codigoExemplar.length > 0) {


        $.get('emprestimo/get-busca-emprestimo-codigo-exemplar',
            {codigoExemplar: codigoExemplar}, function (data) {

                var
                    data = $.parseJSON(data);
                console.log(data);
                if (data != null) {


                    $('#tableresult-emprestimo-exemplar').show();
                    $('#tbody-result-emprestimo-exemplar').html('');


                    $('#result-messagem-busca-emprestimo-exemplar').attr('class', 'alert alert-success');
                    $('#result-messagem-busca-emprestimo-exemplar').html('</b>Empréstimo(s) encontrado(s)</b>');
                    data.forEach(function (item, index) {


                        $('#tbody-result-emprestimo-exemplar').append(
                            '<tr><td>' + data[1][index].nome + '</td>' +
                            '<td>' + data[1][index].rg + '</td>' +
                            '<td>' + data[0][index].dataemprestimo + '</td>' +
                            '<td>' + data[0][index].dataprevisaodevolucao + '</td>' +
                            '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"' +
                            ' onclick="carregarDadosModalEmprestimo('+data[0][index].idemprestimo +')">Visualizar detalhes do Empréstimo ' +
                            '<span class=\'glyphicon glyphicon-search\'>' +
                            '</span></button>'
                            + '</td>' +
                            '</tr>');

                    });

                } else {
                    data = null;
                    $('#tableresult-emprestimo-exemplar').hide();
                    $('#tbody-result-emprestimo-exemplar').html('');
                    $('#result-messagem-busca-emprestimo-exemplar').attr('class', 'alert alert-danger');
                    $('#result-messagem-busca-emprestimo-exemplar').html('Nenhum empréstimo encontrado');
                }
            });
    }
});

function carregarDadosModalEmprestimo(id) {
    console.log(id);

    $.get('emprestimo/get-busca-emprestimo', {id: id}, function (data) {

        var
            data = $.parseJSON(data);
        if (data != null) {
            console.log(data);

            $('#view-exemplaresemprestados').html('');

            data.forEach(function (item, index) {
                console.log('item2 ' + item);


                $('.view-idemprestimo').html(data[index].idemprestimo);

                $('.view-dataemprestimo').html(data[index].dataemprestimo);

                $('.view-dataprevisaoemprestimo').html(data[index].dataprevisaodevolucao);

                if(data[index].datadevolucao != null){
                    $('.view-datadevolucaoemprestimo').html(data[index].datadevolucao);
                }else {
                    $('.view-datadevolucaoemprestimo').html('Não devolvido');
                }


                $('.view-emprestimousuario').html(data[1][index].nome);

                $('.view-rgusuarioemprestimo').html(data[1][index].rg);

                console.log('tam data[2].:  '+ data[2].length);


                $.each(data[2], function (index, element) {

                    $('#view-exemplaresemprestados').append(
                        '<tr>' +
                        '<td>' + element[1].titulo + '</td>' +
                        '<td>' + element[1].autor + '</td>' +
                        '<td>' + element[0].codigo_livro + '</td>' + +'</tr>'
                    );

                });

                $('#view-gerarcomprovanteemprestimo').attr('href',
                    '/librorum/yii2/web/emprestimo/gerar-comprovante-emprestimo?id='+
                    data[index].idemprestimo);

                $('#view-formrenovar').attr('action',
                    '/librorum/yii2/web/emprestimo/renovar?id='+
                    data[index].idemprestimo);

                $('#w1').attr('action',
                    '/librorum/yii2/web/emprestimo/devolucao?id='+
                    data[index].idemprestimo);

                $('#view-btncancelar').attr('href',
                    '/librorum/yii2/web/emprestimo/delete?id='+
                    data[index].idemprestimo);

                data[3].forEach(function (item,index) {
                    if(item> 0){
                        console.log(item);
                        $('.view-avisoemprestimo').html('' +
                            'O exemplar já está emprestado a <strong>'+item+'</strong> dia(s).');
                    }else{
                        $('.view-avisoemprestimo').html('' +
                            'O exemplar foi emprestado hoje.');
                    }
                });




            });

        }
    });

    $.get('emprestimo/get-data-previsao-devolucao', function (data) {
        console.log('previsao.: ' + data);
        var data = $.parseJSON((data));

        if (data != null) {
            console.log('dapr'+data);
            $('#emprestimo-dataprevisaodevolucao').val(data[0]);
            $('#emprestimo-dataprevisaodevolucaolabel').val(data[1]);


        }


    });

}