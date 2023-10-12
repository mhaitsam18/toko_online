	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
		<?= $this->session->flashdata('message'); ?>
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Data vendor"></div>
		<?= form_error('vendor','<div class="alert alert-danger" role="alert">','</div>'); ?>
		<div class="row">
			<div class="col-lg-6">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama Lengkap</th>
							<th scope="col">Username</th>
							<th scope="col">Bukti Surat Usaha</th>
							<th scope="col">Status</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						<?php foreach ($vendor as $key): ?>
							<tr>
								<th scope="row"><?= $no ?></th>
								<td><?= $key->nama ?></td>
								<td><?= $key->username ?></td>
								<td><a href="<?= base_url('assets/doc/bukti-surat-usaha/').$key->bukti_surat_usaha ?>" class="btn btn-link"><i class="fas fa-file-pdf"></i></a></td>
								<?php if ($key->is_active == 1): ?>
									<td>diterima</td>
								<?php else: ?>
									<td>-</td>
								<?php endif ?>
								<td>
									<?php if ($key->is_active == 1): ?>
										<a href="<?= base_url("Admin/updateStatusUser/$key->idu/0"); ?>" class="badge badge-danger" data-hapus="vendor">Tolak</a>
									<?php else: ?>
										<a href="<?= base_url("Admin/updateStatusUser/$key->idu/1"); ?>" class="badge badge-success" data-hapus="vendor">Terima</a>
									<?php endif ?>
								</td>
							</tr>
							<?php $no++; ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->