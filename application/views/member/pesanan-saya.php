<div class="container-fluid">
	<h4>Invoice Pemesanan Barang</h4>
	<?= $this->session->flashdata('message'); ?>
	<table class="table table-bordered table-hover table-striped table-responsive" id="dataTable">
		<thead>
			<tr>
				<th>#</th>
				<th>Id Invoice</th>
				<th>Nama Pemesan</th>
				<th>Alamat Pengiriman</th>
				<th>Tanggal Pemesanan</th>
				<th>Batas Pembayaran</th>
				<th>Tanggal Peminjaman</th>
				<th>Tanggal Pengembalian</th>
				<th>Status</th>
				<th>Dokumen</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $n = 1; ?>
			<?php foreach ($invoice as $inv) : ?>
				<tr>
					<th><?= $n++; ?></th>
					<td><?= $inv->id ?></td>
					<td><?= $inv->nama ?></td>
					<td><?= $inv->alamat ?></td>
					<td><?= $inv->tgl_pesan ?></td>
					<td><?= $inv->batas_bayar ?></td>
					<td><?= date('j F Y', strtotime($inv->tgl_pengiriman)); ?></td>
					<td><?= date('j F Y', strtotime($inv->tgl_pengembalian)); ?></td>
					<td><?= $inv->status ?></td>
					<td>
						<?php if (!empty($inv->ktp) && file_exists("./assets/img/invoice/$inv->ktp")): ?>
							<a href="<?= base_url('assets/img/invoice/'.$inv->ktp); ?>" class="btn btn-sm btn-info mb-1 mr-2">KTP</a>
						<?php endif ?>
						<?php if (!empty($inv->mou) && file_exists("./assets/img/invoice/$inv->mou")): ?>
							<a href="<?= base_url('assets/img/invoice/'.$inv->mou); ?>" class="btn btn-sm btn-danger mb-1 mr-2">MOU</a>
						<?php endif ?>
						<?php if (!empty($inv->bukti_transfer) && file_exists("./assets/img/invoice/$inv->bukti_transfer")): ?>
							<a href="<?= base_url('assets/img/invoice/'.$inv->bukti_transfer); ?>" class="btn btn-sm btn-success mb-1 mr-2">Bukti Transfer</a>
						<?php endif ?>
					</td>
					<td>
						<?= anchor('Dashboard/detailPesanan/'.$inv->idi, '<div class="btn btn-sm btn-primary mb-1 mr-2">Detail</div>') ?>
						<?= anchor('Dashboard/administrasi/'.$inv->idi.'', '<div class="btn btn-sm btn-success mb-1 mr-2">Administrasi</div>') ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>