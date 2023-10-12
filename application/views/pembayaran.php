<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="btn btn-sm btn-success">
				<?php
				$grand_total = 0;
				if ($keranjang = $this->cart->contents())
					{
						foreach($keranjang as $item)
							{
								$grand_total = $grand_total + $item['subtotal'];
							}

							echo "<h4>Total Barang Sewaan Anda: RP. ".number_format($grand_total,0,',','.');
						 ?>
			</div><br><br>

			<h3>Input Alamat Pengiriman dan Pembayaran</h3>

			<form  action="<?php echo base_url('dashboard/proses_pesanan');?>"method="post" enctype="multipart/form-data">

				<div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" name="nama" placeholder="Nama Lengkap" class="form-control">
				</div>

				<div class="form-group">
					<label>Alamat Lengkap</label>
					<input type="text" name="alamat" placeholder="Ke mana barang harus dikirim?" class="form-control">
				</div>

				<div class="form-group">
					<label>No. Telepon</label>
					<input type="text" name="no_telp" placeholder="Nomor telepon" class="form-control">
				</div>

				<div class="form-group">
					<label>Tgl Pengiriman</label>
					<input type="date" class="form-control form-control-user" id="tgl_pengiriman" name="tgl_pengiriman" placeholder="Tgl berapa barang harus dikirim?" value="<?=set_value('tgl_pengiriman')?>" min="<?= date('Y-m-d') ?>">
					<?= form_error('tgl_pengiriman','<small class="text-danger pl-3">','</small>')?>
				</div>
				<div id="ctn">
					<div class="form-group">
						<label>Tgl Pengembalian</label>
						<input type="date" class="form-control form-control-user" id="tgl_pengembalian" name="tgl_pengembalian" placeholder="Tgl berapa barang harus dikembalikan?" value="<?=set_value('tgl_pengembalian')?>" min="<?= date('Y-m-d') ?>">
						<?= form_error('tgl_pengembalian','<small class="text-danger pl-3">','</small>')?>
					</div>
					
				</div>


				<!-- <div class="form-group">
					<label>Jasa Pengiriman</label>
					<select class="form-control">
						<option>Diambil</option>
						<option>Diantar</option>
						<option>Go-Box</option>
						<option>Grab Instant</option>
					</select>
				</div> -->

				<button type="submit" class="btn btn-sm btn-primary mb-3">Pesan</button>
				
			</form>

			<?php 
		} else
		{
			echo "<h4>Keranjang Sewa Anda Masih Kosong";
		}
			?>
		</div>

		<div class="col-md-2"></div>
	</div>
</div>
<script type="text/javascript">
    // ambil elements yg di buutuhkan
    var keyword = document.getElementById('tgl_pengiriman');

    var container = document.getElementById('ctn');
    // var btn = document.getElementById('button-addon2');

    // tambahkan event ketika keyword ditulis

    keyword.addEventListener('change', function () {


        //buat objek ajax
        var xhr = new XMLHttpRequest();

        // cek kesiapan ajax
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                container.innerHTML = xhr.responseText;
            }
        }
        
        xhr.open('GET', '<?= base_url('dashboard/tgl_pengembalian/') ?>' + keyword.value, true);
        xhr.send();

    })
</script>