<div class="container-fluid">
	<h4>Keranjang Sewaan</h4>

	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Sub-Total</th>
			<th colspan="5">Aksi</th>
		</tr>

		<?php 
		$no=1;
		foreach ($this->cart->contents() as $items) : ?>

			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $items['name'] ?></td>
				<td><?php echo $items['qty'] ?></td>
				<td align="right">Rp. <?php echo number_format($items['price'], 0,',','.')  ?></td>
				<td align="right">Rp. <?php echo number_format($items['subtotal'], 0,',','.')  ?></td>
				<td>
					<!-- <div class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></div> -->
					<?php echo anchor("dashboard/tambah_barang/$items[rowid]/$items[qty]", '<div class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></div>') ?>
				</td>
				<td>
					<!-- <div class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></div> -->
					<?php echo anchor("dashboard/kurang_barang/$items[rowid]/$items[qty]", '<div class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></div>') ?>
				</td>
				<td>
					<!-- <div class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div> -->
					<?php echo anchor("dashboard/hapus_barang/$items[rowid]/", '<div class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div>') ?>
				</td>
			</tr>

		<?php endforeach; ?>

		<tr>
			<td align="right" colspan="5">Rp. <?php echo number_format($this->cart->total(), 0,',','.' ) ?></td>
			<td colspan="5"></td>
			</tr>

	</table>

	<div align="right">
		<a href="<?php echo base_url('dashboard/hapus_keranjang') ?>"><div class="btn btn-sm btn-danger">Hapus Keranjang</div></a>
		<a href="<?php echo base_url('welcome') ?>"><div class="btn btn-sm btn-primary">Lanjutkan Belanja</div></a>
		<a href="<?php echo base_url('dashboard/pembayaran') ?>"><div class="btn btn-sm btn-success">Pembayaran</div></a>
	</div>
</div>