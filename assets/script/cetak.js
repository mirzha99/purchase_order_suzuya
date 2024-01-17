class cetak {
	//modules
	rp(val) {
		return `Rp. ${val.toLocaleString("id-ID", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2,
		})}`;
	}
	harga_diskon(persendiskon, harga) {
		var diskon = harga * (persendiskon / 100);
		var harga_diskon = harga - diskon;
		return harga_diskon;
	}
	hitungPPN(hargaBarang, ppn) {
		const tarifPPN = ppn; // Tarif PPN standar (misalnya 10%)
		const hasil_ppn = (hargaBarang * tarifPPN) / 100;
		return hasil_ppn;
	}

	hitungPPNBM(hargaBarang, ppn_bm) {
		const tarifPPNBM = ppn_bm; // Tarif PPN BM standar (misalnya 20%)
		const hasil_ppnBM = (hargaBarang * tarifPPNBM) / 100;
		return hasil_ppnBM;
	}
    //script exe
	po() {
		var harga_normal = $("#harga_normal").val();
		var diskon = $("#diskon").val();
		var ppn = $("#ppn").val();
		var ppn_bm = $("#ppn_bm").val();

        var harga_diskon = this.harga_diskon(diskon,harga_normal);
        var harga_ppn = this.hitungPPN(harga_diskon,ppn);
        var harga_ppn_bm = this.hitungPPNBM(harga_diskon,ppn_bm);
        var jumlah_pembelian = harga_diskon + harga_ppn + harga_ppn_bm;
        
        $('#harga_diskon').html(this.rp(harga_diskon));
        $('#harga_ppn').html(this.rp(harga_ppn));
        $('#harga_ppn_bm').html(this.rp(harga_ppn_bm));
        $('#jumlah_pembelian').html(this.rp(jumlah_pembelian));
	}
}

var Cetak = new cetak();

Cetak.po();
