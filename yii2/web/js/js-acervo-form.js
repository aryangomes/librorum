$('#w6').hide();

$('#w8').hide();
$('#w10').hide();

$('#aquisicao-pessoa_idpessoa').change(function () {
    var tipopessoa = $(this).val();
    
    if (tipopessoa == 1) {
        $('#w8').show();
        $('#w10').hide();
    } else if (tipopessoa == 2) {
        $('#w10').show();
        $('#w8').hide();
    }
});
$('#busca-pessoa').blur(function () {
    var nomepessoa = $(this).val();
    console.log('nomepessoa.:' + nomepessoa.length);
    if (nomepessoa != ' ' && nomepessoa.length > 0) {


        $.get('get-busca-pessoa', {nome: nomepessoa}, function (data) {

            var data = $.parseJSON(data);
          
            if (data != null) { 
                  console.log('busca-pessoa.: ' + data[1]);
                $('#mensagem-busca-pessoa').hide();
                $('#busca-pessoa').val(nomepessoa);
                $('#pessoa-idpessoa').val(data[1].idpessoa);

                if (data[2] == 1) {
                    $('#w8').show();
                    $('#w10').hide();
                    $('#pessoafisica-cpf').val(data[0]);
                    $('#pessoafisica-cpf').show();
                    $('#aquisicao-pessoa_idpessoa').val("1");
                    
                } else {

                    $('#w10').show();
                    $('#w8').hide();
                    $('#pessoajuridica-cnpj').val(data[0]);
                    $('#pessoajuridica-cnpj').show();
                    $('#aquisicao-pessoa_idpessoa').val("2");
                }
                $('#aquisicao-pessoa_idpessoa').change();
                console.log('pessoa tipo.: ' + $('#aquisicao-pessoa_idpessoa').val());
                  console.log('id pessoa tipo.: ' + $('#pessoa-idpessoa').val());
            } else {
                $('#pessoa-nome').val($('#busca-pessoa').val());
                $('#mensagem-busca-pessoa').show();
                $('#mensagem-busca-pessoa').attr('class', 'alert alert-danger');
                $('#mensagem-busca-pessoa').html('Pessoa não encontrada. Para cadastrar uma pessoa, <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalcadastrarpessoa\">Clique aqui</a>');
            }
        });
    }
});

$('#pessoa-cpf-post').hide();
$('#pessoa-cnpj-post').hide();

$('#pessoa-tipo').change(function () {
    var pessoatipo = $(this).val();
    if (pessoatipo == 1) {
        $('#pessoa-cpf-post').show();
        $('#pessoa-cnpj-post').hide();
    } else if (pessoatipo == 2) {
        $('#pessoa-cnpj-post').show();
        $('#pessoa-cpf-post').hide();
    }
});

$('#btCadastrarPessoa').click(function () {



    var pessoaNome = $('#pessoa-nome').val();
    var pessoaTipo = $('#pessoa-tipo').val();
    var pessoaCpf = $('#pessoa-cpf').val();
    var pessoaCnpj = $('#pessoa-cnpj').val();

    var identificacao;
    if (pessoaNome.length > 0 && pessoaTipo > 0) {
        if (pessoaTipo == 1) {
            identificacao = pessoaCpf;
        } else {
            identificacao = pessoaCnpj;
        }

        $.get('../pessoa/create-ajax', {pessoaNome: pessoaNome, pessoaTipo: pessoaTipo
            , identificao: identificacao

        }, function (data) {

            var data = $.parseJSON(data);
            console.log('data: ' + data);
            $('#mensagem-busca-pessoa').show();
            if (data != null) {

                $('#busca-pessoa').val(pessoaNome);
                $('#pessoa-idpessoa').val(data.pessoa_idpessoa);
                if (pessoaTipo == 1) {
                    $('#pessoafisica-cpf').val(data.cpf);
                    $('#aquisicao-pessoa_idpessoa').val(1);
                    $('#w8').show();
                    $('#w10').hide();
                } else {
                    $('#w10').show();
                    $('#w8').hide();
                    $('#pessoajuridica-cnpj').val(data.cnpj);
                    $('#aquisicao-pessoa_idpessoa').val(2);

                }
                $('#modalcadastrarpessoa').modal('hide');
                $('#mensagem-busca-pessoa').attr('class', 'alert alert-success');
                $('#mensagem-busca-pessoa').html('Pessoa cadastrada com sucesso.');

            } else {
                $('#mensagem-busca-pessoa').attr('class', 'alert alert-danger');
                $('#mensagem-busca-pessoa').html('Não foi possível cadastrar\n\
 pessoa. <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalcadastrarpessoa\">Clique aqui</a>, para tentar novamente');

            }

        });
    } else {
        if (pessoaNome.length <= 0) {
            alert('Preencha o campo Nome');
        } else if (pessoaTipo.length <= 0) {
            alert('Escolha o tipo de Pessoa');
        }
    }
});

$('#w18').hide();

$('#w20').hide();


$('#acervo-catalogaracervoexistente').change(function () {
    var catalogaracervoexistente = $(this).val();
    
    if (catalogaracervoexistente == 1) {
        $('#w18').show();
        $('#w20').hide();
    } else if (catalogaracervoexistente == 0) {
        $('#w20').show();
        $('#w18').hide();
    }
});