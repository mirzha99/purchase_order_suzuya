
<form action="<?=base_url();?>profil/update" method="post">
            <!--start-->
            <label for="nama_suplier">Nama Suplier</label>
            <input type="text" class="form-control" name="nama_suplier" value="<?=$suplier->nama_suplier;?>" placeholder="Nama Suplier" autocomplate="off">
            <p></p>
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?=$suplier->alamat;?>" autocomplate="off">
            <p></p>
            <label for="no_telpon">No Telpon</label>
            <input type="number"" name="no_telpon" class="form-control" placeholder="No Telpon" value="<?=$suplier->no_telpon;?>" autocomplate="off">
            <p></p>
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username" value="<?=$suplier->username;?>" autocomplate="off">
            <p></p>
            <label for="password">Password</label>
            <input type="password" name="password_lama" class="form-control" placeholder="Password Lama">
            <p></p>
            <input type="password" name="password_baru" class="form-control" placeholder="Password Baru">
            <p></p>
        
            <!--end-->
        <button type="sumbit" class="btn btn-primary">Simpan</button>
</form>