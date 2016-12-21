/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
zz

$(document).ready(function () {

    if ($('#user-password').val().length > 0) {
        $('#btAlterarSenhaDoUsuário').show();
    } else {
        $('#btAlterarSenhaDoUsuário').hide();
    }

    $('#btAlterarSenhaDoUsuário').click(function () {
        $('#user-password').prop('disabled', false);
        $('#user-password').val('');
        $('#user-password_repeat').prop('disabled', false);
        $('#user-password_repeat').val('');
    });



    $('#usuario-nome').blur(function () {
        $('#profile-full_name').val($(this).val());
    });




    var resultadoVerificaCpf = false;
    function verificaCpf(cpf) {
        $.get('verifica-cpf', {cpf: cpf}, function (data) {


            if (data == 'false') {

                resultadoVerificaCpf = false;
            } else {
                resultadoVerificaCpf = true;
            }
        });
    }

    $('#usuario-nome').blur(function () {
        var nome = $(this).val();
        if (nome.length > 0) {

            $.get('verifica-nome', {nome: nome}, function (data) {
                if (data == 'false') {

                    $(':submit').prop('disabled', true);
                    $('#validacao-usuario').attr('class', 'alert alert-danger');
                    $('#validacao-usuario').html
                            ('Nome de Usuário já existe');

                    $('#validacao-usuario').show();
                } else {

                    $(':submit').prop('disabled', false);
                    $('#validacao-usuario').hide();
                }
            });
        }
    });

    $('#usuario-rg').blur(function () {
        var rg = $(this).val();
        if (rg.length > 0) {

            $.get('verifica-rg', {rg: rg}, function (data) {
                if (data == 'false') {

                    $(':submit').prop('disabled', true);
                    $('#validacao-usuario').attr('class', 'alert alert-danger');
                    $('#validacao-usuario').html
                            ('RG já existe');

                    $('#validacao-usuario').show();
                } else {

                    $(':submit').prop('disabled', false);
                    $('#validacao-usuario').hide();
                }
            });
        }
    });

    $('#usuario-cpf').blur(function () {
        var cpf = $(this).val();
        if (cpf.length > 0) {

            $.get('verifica-cpf', {cpf: cpf}, function (data) {
                if (data == 'false') {

                    $(':submit').prop('disabled', true);
                    $('#validacao-usuario').attr('class', 'alert alert-danger');
                    $('#validacao-usuario').html
                            ('CPF já existe');

                    $('#validacao-usuario').show();
                } else {

                    $(':submit').prop('disabled', false);
                    $('#validacao-usuario').hide();
                }
            });
        }
    });

});