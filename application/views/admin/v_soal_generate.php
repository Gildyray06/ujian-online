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

			<?= $this->session->flashdata('message'); ?>

			<div class="box box-success">
				<div class="box-header">

					<center>
						<div class="box-title">Generate Soal By AI</div>
					</center>
				</div><!-- /.box-header -->
				<form action="<?= base_url('soal/insert'); ?>" method="post">
					<div class="box-body">
						<div class="form-horizontal">

							<div class="form-group">
								<label class="col-sm-3 control-label">Jumlah Soal Pilihan Ganda</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="jumlah_soal_pilihan" id="jumlah_soal_pilihan" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Jumlah Soal Essai</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="jumlah_soal_essai" id="jumlah_soal_essai" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
									<a href="<?= base_url('soal_ujian') ?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span> Kembali</a>
									<button type="button" class="btn btn-primary btn-flat" id="btn-generate" title="Generate Soal Ujian"><span class="fa fa-refresh"></span> Generate</button>
								</div>
							</div>
						</div>
						<div id="data_table" style="display: none;">
							<table class="table table-bordered table-striped">
								<thead>
								<tr>
									<th width="1%">No</th>
									<th>TYPE</th>
									<th>TAKSONOMI LEVEL</th>
									<th>SOAL UJIAN</th>
									<th>OPSI JAWABAN</th>
									<th width="13%">KUNCI JAWABAN</th>
								</tr>
								</thead>
								<tbody id="response">

								</tbody>
							</table>
							<a href="<?php echo base_url('soal/save') ?>" class="btn btn-warning btn-flat" id="btn-generate" title="Simpan" style="float: right"><span class="fa fa-save"></span> Simpan Soal</a>
						</div>
					</div>
				</form>
			</div>
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
	$(document).ready(function () {
		$("#btn-generate").click(function (event) {
			if ($('#jumlah_soal_pilihan').val() != '' && $('#jumlah_soal_essai').val() != '') {
				let postData = {
					jumlah_soal_pilihan: $('#jumlah_soal_pilihan').val(),
					jumlah_soal_essai: $('#jumlah_soal_essai').val(),
				};
				$('#data_table').hide();
				$("#btn-generate").html('<i class="fa fa-spinner"></i> Loading .....');

				$.ajax({
					url: "<?php echo base_url('soal/run_generate') ?>",
					type: "POST",
					data: postData,
					success: function (response) {
						$('#response').html(response);
						setTimeout(function () {
							$("#btn-generate").html('<span class="fa fa-refresh"></span> Generate');

						}, 100000000000000000);
						$('#data_table').show();
					},
					error: function (xhr, status, error) {
						$('#data_table').hide();
						alert('Terjadi kesalahan, coba lagi!');
						$("#btn-generate").html('<span class="fa fa-refresh"></span> Generate');
					}
				});
			} else {
				alert('Jumlah Soal Wajib Diisi!');
			}
		});
	});
</script>


<?php
$this->load->view('admin/foot');
?>
