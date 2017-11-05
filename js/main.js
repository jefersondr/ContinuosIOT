
/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
 console.log('teste171');  
$('#delete-modal').on('show.bs.modal', function (event) {
console.log('teste');  
  var button = $(event.relatedTarget);
  var id = button.data('customer');
  
  var modal = $(this);
  modal.find('.modal-title').text('Excluir Cliente #' + id);
  modal.find('#confirm').attr('href', 'delete_usuario.php?id=' + id);
})
