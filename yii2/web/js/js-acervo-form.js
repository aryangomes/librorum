$('#busca-pessoa').blur(function () {
    var nomepessoa = $(this).val();
    console.log('nomepessoa.:' + nomepessoa.length);
    if (nomepessoa != ' ' && nomepessoa.length > 0) {


        $.get('get-busca-pessoa', {nome: nomepessoa}, function (data) {

            var data = $.parseJSON(data);
            console.log('busca-pessoa.: '+data);
            if (data != null) {
                $('#tableresult').show();
                $('#tbody-result').html('');

                $('#usuario-rg').val(data.rg);
                $('#result-messagem-busca-usuario').attr('class', 'alert alert-success');
                $('#result-messagem-busca-usuario').html('</b>Matrículas encontradas</b>');
                data.forEach(function (item) {
                    console.log('rg.:' + item.rg);
                    $('#tbody-result').append(
                        '<tr><td>' + item.nome + '</td><td>' + item.rg + '</td><td><a href=\'#\' onclick=\'actionSelecionarUsuario(\"' + item.rg + '\")\' class=\'btn btn-success\' id=\'actionbuscar\' > <span class="glyphicon glyphicon-ok"></span></a ></td></tr>');
                });

            } else {
                $('#mensagem-busca-pessoa').show();
                $('#mensagem-busca-pessoa').attr('class', 'alert alert-danger');
                $('#mensagem-busca-pessoa').html('Pessoa não encontrada. Para cadastrar uma pessoa, <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalcadastrarpessoa\">Clique aqui</a>');
            }
        });
    }
});

$('#pessoa-cpf-post').hide();
$('#pessoa-cnpj-post').hide();

$('#pessoa-tipo').change(function(){
    var pessoatipo = $(this).val();
    if(pessoatipo == 1){
        $('#pessoa-cpf-post').show();
        $('#pessoa-cnpj-post').hide();                    
    }else if(tipopessoa == 2){
        $('#pessoa-cnpj-post').show();
        $('#pessoa-cpf-post').hide();
    }
});