<?php
$this->load->view('admin/head');
?>
<!--tambahkan custom css disini-->

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Tampilan untuk alert -->


			<?php foreach ($soal as $s) { ?>
				<!-- TUTUP Tampilan untuk alert -->
				<div class="box box-success" style="overflow-x: scroll;">
					<form action="<?= base_url('soal_ujian/update'); ?>" method="post">
						<div class="box-header">
							<center><h4 class="box-title">Edit Data</h4></center>
							<p>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="form-horizontal">
								<input type="hidden" name="id" value="<?= $s->id_soal_ujian ?>">
								<div class="form-group">
									<label class="col-sm-2 control-label">Type Soal Ujian</label>
									<div class="col-sm-10">
										<select class="form-control" id="type-soal" required name="type">
											<option selected="selected" disabled="" value="">-</option>
											<option value="1" <?= ($s->type==1)?'selected':''; ?>>Pilihan Ganda</option>
											<option value="3" <?= ($s->type==3)?'selected':''; ?>>Esai</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Taksonmi Bloom Level</label>
									<div class="col-sm-10">
										<select class="form-control" id="taxonomy_level" required name="taxonomy_level">
											<option selected="selected" disabled="" value="">-</option>
											<option value="1" <?= ($s->taxonomy_level==1)?'selected':''; ?>>Pengetahuan</option>
											<option value="2" <?= ($s->taxonomy_level==2)?'selected':''; ?>>Pemahaman</option>
											<option value="3" <?= ($s->taxonomy_level==3)?'selected':''; ?>>Penerapan</option>
											<option value="4" <?= ($s->taxonomy_level==4)?'selected':''; ?>>Analisis</option>
											<option value="5" <?= ($s->taxonomy_level==5)?'selected':''; ?>>Evaluasi</option>
											<option value="6" <?= ($s->taxonomy_level==6)?'selected':''; ?>>Membuat</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Tulis Soal Ujian</label>
									<div class="col-sm-10">
										<textarea name="soal" class="soal" required><?= $s->pertanyaan; ?></textarea>
									</div>
								</div>
								<div class="form-group soal-optional">
									<label class="col-sm-2 control-label">Jawaban A</label>
									<div class="col-sm-10">
										<textarea rows="2" style="width: 100%" name="a" required><?= $s->a; ?></textarea>
									</div>
								</div>
								<div class="form-group soal-optional">
									<label class="col-sm-2 control-label">Jawaban B</label>
									<div class="col-sm-10">
										<textarea rows="2" style="width: 100%" name="b" required><?= $s->b; ?></textarea>
									</div>
								</div>
								<div class="form-group soal-optional">
									<label class="col-sm-2 control-label">Jawaban C</label>
									<div class="col-sm-10">
										<textarea rows="2" style="width: 100%" name="c" required><?= $s->c; ?></textarea>
									</div>
								</div>
								<div class="form-group soal-optional">
									<label class="col-sm-2 control-label">Jawaban D</label>
									<div class="col-sm-10">
										<textarea rows="2" style="width: 100%" name="d" required><?= $s->d; ?></textarea>
									</div>
								</div>
								<div class="form-group soal-optional">
									<label class="col-sm-2 control-label">Jawaban E</label>
									<div class="col-sm-10">
										<textarea rows="2" style="width: 100%" name="e" required><?= $s->e; ?></textarea>
									</div>
								</div>
								<div class="form-group soal-optional">
									<label class="col-sm-2 control-label">Kunci Jawaban</label>
									<div class="col-sm-10">
										<select class="form-control" name="kunci">
											<option <?php if ($s->kunci_jawaban == 'A') {
												echo "selected='selected'";
											} ?>>A
											</option>
											<option <?php if ($s->kunci_jawaban == 'B') {
												echo "selected='selected'";
											} ?>>B
											</option>
											<option <?php if ($s->kunci_jawaban == 'C') {
												echo "selected='selected'";
											} ?>>C
											</option>
											<option <?php if ($s->kunci_jawaban == 'D') {
												echo "selected='selected'";
											} ?>>D
											</option>
											<option <?php if ($s->kunci_jawaban == 'E') {
												echo "selected='selected'";
											} ?>>E
											</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-10">
										<button type="button" class="btn btn-default btn-flat" onclick="return history.go(-1)" title="Kembali ke halaman sebelumnya"><span class="fa fa-arrow-left"></span> Kembali</button>
										<button type="submit" class="btn btn-primary btn-flat" title="Tambah Data Soal Ujian"><span class="fa fa-save"></span> Simpan</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-footer -->
						<div class="box-footer">

						</div>
					</form>
				</div>
			<?php } ?>
		</div>
		<!-- /.col-->
	</div>
	<!-- ./row -->
</section><!-- /.content -->

<?php
$this->load->view('admin/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">

	$(function () {
		$('#data-tables').dataTable();
	});
	$('.select2').select2();
	$('.alert-message').alert().delay(3000).slideUp('slow');

</script>

<script type="text/javascript">
	$('#type-soal').on('change', function () {
		if ($(this).val() == 3) {
			$('.soal-optional').hide();
			$('.soal-optional').find('textarea').prop('required', false);
			$('.soal-optional').find('select').prop('required', false);
		} else {
			$('.soal-optional').show();
			$('.soal-optional').find('textarea').prop('required', true);
			$('.soal-optional').find('select').prop('required', true);
		}
	})
	$('#type-soal').trigger('change');

</script>


<?php
$this->load->view('admin/foot');
?>

