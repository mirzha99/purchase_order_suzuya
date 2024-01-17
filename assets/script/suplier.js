class suplier extends core{
   suplier(){
        this.modal('Suplier','admin/suplier/add_suplier','Tambah','btn btn-primary');
   }
   edit_suplier(id){
      this.modal('Edit Suplier','admin/suplier/edit_suplier','Edit','btn btn-warning');
      $.ajax({
         url: this.url(`admin/suplier/id_suplier/${id}`),
         dataType:'json',
         success: function(data){
            $('#id').val(data.id);
            $('#nama_suplier').val(data.nama_suplier);
            $('#alamat').val(data.alamat);
            $('#no_telpon').val(data.no_telpon);
            $('#username').val(data.username);
            $('#password').val(data.password);
         }
      })
   }
   delete_suplier(id){
      this.modal('Hapus Suplier','admin/suplier/delete_suplier','Hapus','btn btn-danger');
      $.ajax({
         url: this.url(`admin/suplier/id_suplier/${id}`),
         dataType: 'json',
         success: function(data){
            $('#id_del').val(data.id);
            $('.dels_suplier').html(data.nama_suplier);
         }
      })
   }
}

var Suplier = new suplier();

