$('.field-acervo-codigoinicio').hide();
$('.field-acervo-codigofim').hide();
$('#acervo-catalogaracervoexistente').change(function () {
    var catalogaracervoexistente = $(this).val();
    
    if (catalogaracervoexistente == 1) {
        $('.field-acervo-quantidadeexemplar').hide();
        $('.field-acervo-codigoinicio').show();
        $('.field-acervo-codigofim').show();
    } else if (catalogaracervoexistente == 0) {
        $('.field-acervo-quantidadeexemplar').show();
        $('.field-acervo-codigoinicio').hide();
        $('.field-acervo-codigofim').hide();
    }
});

$('#btGerarNovoCodigoExemplar').click(function () {
    var codigoinicio = $('#acervo-codigoinicio').val();
    var codigofim = $('#acervo-codigofim').val();

    if(codigoinicio > codigofim){
        alert('Código Inicio deve ser menor que Código Fim');
    }else{
        $("form").submit();
    }
});