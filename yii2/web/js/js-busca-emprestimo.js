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

                $('#tableresult-rg').show();
                $('#tbody-result-rg').html('');


                $('#result-messagem-busca-emprestimo-rg').attr('class', 'alert alert-success');
                $('#result-messagem-busca-emprestimo-rg').html('</b>Empréstimo(s) encontrado(s)</b>');
                data.forEach(function (item, index) {

                    $('#tbody-result-rg').append(
                            '<tr><td>' + data[1][index].nome + '</td>' +
                            '<td>' + data[1][index].rg + '</td>' +
                            '<td>' + data[2][index].titulo + '</td>' +
                            '<td>' + data[0][index].dataemprestimo + '</td>' +
                            '<td>' + data[0][index].dataprevisaodevolucao + '</td>' +
                            '<td><a href=\'emprestimo/view/?id=' + data[0][index].idemprestimo + '\'  ' +
                            'class=\'btn btn-success\' id=\'actionbuscar\' > <span class=\'glyphicon glyphicon-ok\'>' +
                            '</span></a ></td></tr>');

                });

            } else {
                data = null;
                $('#tableresult-rg').hide();
                $('#tbody-result-rg').html('');
                $('#result-messagem-busca-emprestimo-rg').attr('class', 'alert alert-danger');
                $('#result-messagem-busca-emprestimo-rg').
                        html('Nenhum empréstimo encontrado');
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
                            '<td>' + data[2][index].titulo + '</td>' +
                            '<td>' + data[0][index].dataemprestimo + '</td>' +
                            '<td>' + data[0][index].dataprevisaodevolucao + '</td>' +
                            '<td><a href=\'emprestimo/view/?id=' + data[0][index].idemprestimo + '\'  ' +
                            'class=\'btn btn-success\' id=\'actionbuscar\' > <span class=\'glyphicon glyphicon-ok\'>' +
                            '</span></a ></td></tr>');

                });

            } else {
                data = null;
                $('#tableresult-emprestimo-exemplar').hide();
                $('#tbody-result-emprestimo-exemplar').html('');
                $('#result-messagem-busca-emprestimo-exemplar').attr('class', 'alert alert-danger');
                $('#result-messagem-busca-emprestimo-exemplar').
                        html('Nenhum empréstimo encontrado');
            }
        });
    }
});