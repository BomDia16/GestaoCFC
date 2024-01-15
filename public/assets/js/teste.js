$(document).ready(function(){
    M.AutoInit();

    $('.dropdown-trigger').dropdown({
        alignment: 'right',
        coverTrigger: false,
        constrainWidth: false
    });

    //masks
    $('#cpf').mask('000.000.000-00');
    $('#cnpj').mask('00.000.000/0000-00');
    $('#celular').mask('(00)00000-0000');
    $('#data_nascimento').mask('00/00/0000');
});