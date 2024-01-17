class user extends core{
    user(){
       this.modal('Tambah User','admin/user/add_user','Tambah','btn btn-primary');
       $('#id').val('');
       $('#username').val('');
       $('#password').val('');
       $('#no_telpon').val('');
       $('#level').val('');
    }
    edit_user(id){
        this.modal('Edit User','admin/user/edit_user','Edit','btn btn-warning');
        $.ajax({
            url:this.url(`admin/user/id_user/${id}`),
            dataType : 'json',
            success: function(data){
                $('#id').val(data.id);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#no_telpon').val(data.no_telpon);
                $('#level').val(data.level);
            }
        })
    }
    delete_user(id){
        this.modal('Hapus User','admin/user/delete_user','Hapus','btn btn-danger');
        $.ajax({
            url: this.url(`admin/user/id_user/${id}`),
            dataType:'json',
            success:function(data){
                $('#id_del').val(data.id);
                $('.dels_user').html(data.username);
            }
        })
    }
}

var User = new user();