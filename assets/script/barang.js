class barang extends core{
//barang
    //jenis barang
    jenis_barang(){
       this.modal('Jenis Barang','admin/barang/add_jenis_barang','Tambah','btn btn-primary');
        $('#id').val('');
        $('#jenis_barang').val('');
    }
    edit_jenis_barang(id){
       this.modal('Edit Jenis Barang','admin/barang/edit_jenis_barang','Edit','btn btn-warning');
       $.ajax({
            url : this.url(`admin/barang/json_jenis_barang/${id}`),
            dataType:'json',
            success: function(data){
                $('#id').val(data.id);
                $('#jenis_barang').val(data.jenis_barang);
            }
       });
    }
    delete_jenis_barang(id){
        this.modal('Hapus Jenis Barang','admin/barang/delete_jenis_barang','Hapus','btn btn-danger');
        $.ajax({
            url : this.url(`admin/barang/json_jenis_barang/${id}`),
            dataType:'json',
            success: function(data){
                $('#id_del').val(data.id);
                $('.dels_jenis_barang').html(data.jenis_barang);
            }
       });
    }
    //satuan_barang
    satuan_barang(){
        this.modal('Satuan Barang','admin/barang/add_satuan_barang','Tambah','btn btn-primary');
        $('#id').val('');
        $('#satuan_barang').val('');
    }
    edit_satuan_barang(id){
        this.modal('Edit Satuan Barang','admin/barang/edit_satuan_barang','Edit','btn btn-warning');
        $.ajax({
            url : this.url(`admin/barang/json_satuan_barang/${id}`),
            dataType :'json',
            success : function(data){
                $('#id').val(data.id);
                $('#satuan_barang').val(data.satuan_barang);
            }
        })
    }
    delete_satuan_barang(id){
        this.modal('Hapus Satuan Barang','admin/barang/delete_satuan_barang','Hapus','btn btn-danger');
        $.ajax({
            url: this.url(`admin/barang/json_satuan_barang/${id}`),
            dataType:'json',
            success: function(data){
                $('#id_del').val(data.id);
                $('.dels_satuan_barang').html(data.satuan_barang);
            }
        })
    }
    //barang
    barang(){
        this.modal('Barang','admin/barang/add_barang','Tambah','btn btn-primary');
        $('#id').val('');
        $('#nama_barang').val('');
        $('#jenis_barang').val('');
        $('#satuan_barang').val('');
        $('#uom').val('');
        $('#harga_beli').val('');
        $('#harga_jual').val('');
        $('#stok_barang').val('');
    }
    edit_barang(id){
        this.modal('Edit Barang','admin/barang/edit_barang','Edit','btn btn-warning');
        $.ajax({
            url: this.url(`admin/barang/json_barang/${id}`),
            dataType:'json',
            success: function(data){
                $('#id').val(data.id);
                $('#nama_barang').val(data.nama_barang);
                $('#jenis_barang').val(data.id_jenis);
                $('#satuan_barang').val(data.id_satuan);
                $('#uom').val(data.uom_order);
                $('#harga_beli').val(data.harga_beli);
                $('#harga_jual').val(data.harga_jual);
                $('#stok_barang').val(data.stok_barang);
            }
        })
    }
    delete_barang(id){
        this.modal('Hapus Barang','admin/barang/delete_barang','Hapus','btn btn-danger');
        $.ajax({
            url: this.url(`admin/barang/json_barang/${id}`),
            dataType: 'json',
            success: function(data){
                $('#id_del').val(data.id);
                $('.nama_del').html(data.nama_barang);
            }
        })
    }
}
var Barang = new barang();