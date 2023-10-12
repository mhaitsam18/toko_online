<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<?= $this->session->flashdata('message'); ?>
	<form action="<?= base_url('dashboard/administrasi/'.$this->uri->segment(3)) ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" id="id" value="<?= $administrasi['id'] ?>">
		<input type="hidden" name="id_invoice" id="id_invoice" value="<?= $administrasi['id_invoice'] ?>">
		<div class="card w-75 mb-4">
			<div class="card-body">
				<h5 class="card-title">Upload KTP</h5>
				<div class="input-group">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="ktp" name="ktp" aria-describedby="submit_fktp">
						<label class="custom-file-label" for="ktp">Choose file</label>
					</div>
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="submit" id="submit_ktp" name="submit_ktp" value="Submit">Submit</button>
					</div>
					<?php if ($administrasi['ktp'] == ''): ?>
						<i class="fas fa-fw fa-times text-danger" style="font-size: 28pt;"></i>
					<?php else: ?>
						<i class="fas fa-fw fa-check text-success" style="font-size: 28pt;"></i>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="card w-75 mb-4">
			<div class="card-body">
				<h5 class="card-title">Upload MOU</h5>
				<a href="<?= base_url('assets/doc/format_mou.docx') ?>" class="btn btn-outline-info mb-4">Download Template MOU</a>
				<div class="input-group">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="mou" name="mou" aria-describedby="submit_mou">
						<label class="custom-file-label" for="mou">Choose file</label>
					</div>
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="submit" id="submit_mou" name="submit_mou" value="Submit">Submit</button>
					</div>
					<?php if ($administrasi['mou'] == ''): ?>
						<i class="fas fa-fw fa-times text-danger" style="font-size: 28pt;"></i>
					<?php else: ?>
						<i class="fas fa-fw fa-check text-success" style="font-size: 28pt;"></i>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="card w-75 mb-4">
			<div class="card-body">
				<h5 class="card-title">Upload Bukti Pembayaran</h5>
				<div class="input-group">
					<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#buktiBayarModal">Upload Bukti Pembayaran</button>
				</div>
			</div>
		</div>
	</form>
	
</div>
<!-- /.container-fluid -->
<!-- Modal -->
<div class="modal fade" id="buktiBayarModal" tabindex="-1" aria-labelledby="buktiBayarModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="buktiBayarModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('Dashboard/uploadPembayaran') ?>" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="id_invoice" id="id_invoice" value="<?= $administrasi['id_invoice'] ?>">
						<label for="id_rekening_tujuan">Rekening Tujuan</label>
						<select class="form-control" id="id_rekening_tujuan" name="id_rekening_tujuan">
							<option selected disabled>Pilih Rekening</option>
							<?php foreach ($rekening_tujuan as $row): ?>
								<option value="<?= $row['id'] ?>"><?= $row['no_rekening'].' | '.$row['bank'].' | '.$row['atas_nama'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="rekening_pengirim">Rekening Pengirim</label>
						<input type="number" class="form-control" id="rekening_pengirim" name="rekening_pengirim" placeholder="Rekening Pengirim">
					</div>
					<div class="form-group">
						<label for="bank_pengirim">Instansi Bank</label>
						<input type="text" class="form-control" id="bank_pengirim" name="bank_pengirim" placeholder="Bank">
					</div>
					<div class="form-group">
						<label for="nama_pengirim">Nama Pengirim</label>
						<input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="Nama Pengirim">
					</div>
					<div class="form-group">
						<label for="waktu_transfer">Waktu Transfer</label>
						<div class="row">
							<div class="col">
								<input type="date" class="form-control" id="tanggal_transfer" name="tanggal_transfer">
							</div>
							<div class="col">
								<input type="time" class="form-control" id="waktu_transfer" name="waktu_transfer">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="nominal_transfer">Nominal Transfer</label>
						<input type="number" class="form-control" id="nominal_transfer" name="nominal_transfer" placeholder="Nominal Transfer">
					</div>
					<div class="form-group">
						<label for="bukti_pembayaran">Upload Bukti Transfer</label>
						<input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran">
					</div>
					<div class="form-group">
						<label for="catatan">Catatan</label>
						<textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Catatan"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Upload</button>
				</div>
			</form>
		</div>
	</div>
</div>