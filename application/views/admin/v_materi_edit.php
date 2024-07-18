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
			<div class="box box-success" style="overflow-x: scroll;">
				<div class="box-header with-border">
					<center><h4 class="box-title">Edit Data</h4></center>
				</div>
				<!-- /.box-header -->
				<?php foreach ($materi as $a) { ?>
					<!-- form start -->
					<form action="<?= base_url('materi/update'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-2 control-label">Nama Materi</label>
								<input type="hidden" name="id" value="<?= $a->id_materi; ?>">
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nama" value="<?= $a->nama_materi; ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Upload PDF</label>
								<div class="col-sm-10">
									<input type="file" class="form-control" name="file_pdf" >
									<a target="_blank" style="margin-top:10px;display: block" href="<?=  base_url('uploads/'.$a->pdf_materi)?>">Download : <?= $a->pdf_materi ?></a>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
									<a href="<?= base_url('materi') ?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span> Batal</a>
									<button type="submit" class="btn btn-primary btn-flat" title="Simpan Data Pengawas"><span class="fa fa-save"></span> Simpan</button>
								</div>
							</div>

						</div>


						<!-- /.box-body -->

						<!-- /.box-footer -->
					</form>
				<?php } ?>
			</div>
		</div>
	</div>

</section><!-- /.content -->

<?php
$this->load->view('admin/js');
?>
<!--tambahkan custom js disini-->

<script type="text/javascript">
	$(document).ready(function () {
		$('#data').dataTable();
	});

	$('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>
