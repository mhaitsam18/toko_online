<div class="container-fluid">
	<h4>Detail Pesanan <div class="btn btn-sm btn-success">No. Invoice: <?php echo $invoice->id ?></div> </h4>

	<table class="table table-bordered table-hover table-striped">

		<tr>
			<th>ID BARANG</th>
			<th>NAMA BARANG</th>
			<th>JUMLAH PESANAN</th>
			<th>HARGA SATUAN</th>
			<th>SUB-TOTAL</th>
		</tr>
		<?php if ($pesanan): ?>
			<?php 
			$total = 0;
			foreach ($pesanan as $psn) :
				$subtotal = $psn->jumlah * $psn->harga;
				$total += $subtotal;
			?>

			 <tr>
			 	<td><?php echo $psn->id_brg ?></td>
			 	<td><?php echo $psn->nama_brg ?></td>
			 	<td><?php echo $psn->jumlah ?></td>
			 	<td><?php echo number_format($psn->harga,0,',','.') ?></td>
			 	<td><?php echo number_format($subtotal,0,',','.') ?></td>
			 </tr>

			<?php endforeach; ?>
			<tr>
				<td colspan="4" align="right">Grand Total</td>
				<td align="right">Rp. <?php echo number_format($total,0,',','.')  ?></td>
			</tr>
		<?php else: ?>
			<tr>
				<td colspan="5" class="text-center">PESANAN TIDAK TERSEDIA CMIWWW :3</td>
			</tr>
		<?php endif ?>

		
	</table>

	<a href="<?php echo base_url('vendor/invoice') ?>"><div class="btn btn-sm btn-primary">Kembali</div></a>
</div>