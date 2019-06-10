const onSubmitForm = () => {
  $('#subscribe').submit(() => {
    debugger
    $.ajax({
      url : "/backend/repositories/Subscribe.php",
      type : 'post',
      data : {
        name: $('#name').val(),
        email: $('#email').val()
      },
      beforeSend : () => {$('#btn').html('Cadastrando...')},
      success: () => {
        $('#btn').html('enviar');
        alert('Cadastrado com sucesso');
        $('#name').val('');
        $('#email').val('');
      },
      error: () => {alert('erro')}
    });
    return false;
  });
}

$(document).ready(() => {
  onSubmitForm();
});

