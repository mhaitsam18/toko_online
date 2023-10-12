	<div class="container-fluid">
		<h4>Laporan Penjualan</h4>
		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>ID BARANG</th>
					<th>TANGGAL TRANSAKSI</th>
					<th>NAMA BARANG</th>
					<th>JUMLAH PESANAN</th>
					<th>HARGA SATUAN</th>
					<th>SUB-TOTAL</th>
				</tr>
			</thead>
				
			<?php if ($pesanan): ?>
				<?php $total = 0; ?>
				<tbody>
					<?php foreach ($pesanan as $psn) :
						$subtotal = $psn->jumlah * $psn->harga;
						$total += $subtotal;
					?>
					 <tr>
					 	<td><?php echo $psn->id_brg ?></td>
					 	<td><?php echo date('j F Y',strtotime($psn->tgl_pesan)) ?></td>
					 	<td><?php echo $psn->nama_brg ?></td>
					 	<td><?php echo $psn->jumlah ?></td>
					 	<td>Rp. <?php echo number_format($psn->harga,2,',','.') ?></td>
					 	<td>Rp. <?php echo number_format($subtotal,2,',','.') ?></td>
					 </tr>

					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5" align="right">Grand Total</td>
						<td>Rp. <?php echo number_format($total,2,',','.')  ?></td>
					</tr>
				</tfoot>
			<?php else: ?>
				<tbody>
					<tr>
						<td colspan="6" class="text-center">PESANAN TIDAK TERSEDIA CMIWWW :3</td>
					</tr>
				</tbody>
			<?php endif ?>

			
		</table>
	</div>
</div>

<script type="text/javascript">
    // var css = '@page { size: landscape; }',
    // head = document.head || document.getElementsByTagName('head')[0],
    // style = document.createElement('style');

    // style.type = 'text/css';
    // style.media = 'print';

    // if (style.styleSheet){
    //   style.styleSheet.cssText = css;
    // } else {
    //   style.appendChild(document.createTextNode(css));
    // }

    // head.appendChild(style);

    window.print();
</script>