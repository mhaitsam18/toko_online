<div class="form-group">
	<label>Tgl Pengembalian</label>
	<input type="date" class="form-control form-control-user" id="tgl_pengembalian" name="tgl_pengembalian" placeholder="Tgl berapa barang harus dikembalikan?" value="<?=set_value('tgl_pengembalian')?>" min="<?= $tgl_pengiriman ?>">
	<?= form_error('tgl_pengembalian','<small class="text-danger pl-3">','</small>')?>
</div>