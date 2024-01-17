<aside id="aside" class="ui-aside">
	<ul class="nav" ui-nav>
		<li class="nav-head">
			<h5 class="nav-title text-uppercase light-txt">Admin Gudang</h5>
		</li>
		<li>
			<a href="<?=base_url();?>admin"><i class="fa fa-home"></i><span> Dashboard </span></a>
		</li>
		<li>
			<a href="<?=base_url();?>admin/user"><i class="fa fa-user"></i><span> Manajemen User </span></a>
		</li>
		<li class="nav-head">
			<h5 class="nav-title text-uppercase light-txt">Menu</h5>
		</li>
		<li>
			<a href=""><i class="fa fa-cube"></i><span>Barang</span><i class="fa fa-angle-right pull-right"></i></a>
			<ul class="nav nav-sub">
				<li><a href="<?=base_url();?>admin/barang/jenis_barang"><span>Jenis Barang</span></a></li>
				<li><a href="<?=base_url();?>admin/barang/satuan_barang"><span>Satuan Barang</span></a></li>
				<li><a href="<?=base_url();?>admin/barang/"><span>Barang</span></a></li>
			</ul>
		</li>
		<li>
			<a href="<?=base_url();?>admin/suplier"><i class="fa fa-users"></i><span> Suplier </span></a>
		</li>
		<li>
			<a href=""><i class="fa fa-shopping-cart"></i><span>Purchase order</span><i class="fa fa-angle-right pull-right"></i></a>
			<ul class="nav nav-sub">
				<li><a href="<?=base_url();?>admin/po/type_po"><span>Tipe PO</span></a></li>
				<li><a href="<?=base_url();?>admin/po/"><span>PO</span></a></li>
			</ul>
		</li>
		<li>
			<a href="<?=base_url();?>admin/receiving"><i class="fa fa-inbox"></i><span> Receiving </span></a>
		</li>
	</ul>
</aside>
