const onSubmitForm = () => {
  $('#subscribe').submit(() => {
    debugger
    $.ajax({
      url : "/backend/repositories/subscribe.php",
      type : 'post',
      data : {
        name: $('#name').val(),
        email: $('#email').val()
      },
      beforeSend : () => {},
      success: () => {},
      error: () => {alert('erro')}
    });
    return false;
  });
}

$(document).ready(() => {
  onSubmitForm();
});

