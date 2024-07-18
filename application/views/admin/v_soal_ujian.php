<?php
$this->load->view('admin/head');
?>

<!--tambahkan custom css disini-->

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<!-- Content Header (Page header) -->



<!-- /. modal tambah data siswa  -->
<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Generate Soal by AI</h4>
			</div>
			<!-- /.form dengan modal -->
			<div class="modal-body">
				<div id="modal-data-body">
					<form action="" method="post" class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">Jumlah Soal</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="nama" required="">
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-flat pull-right" title="Simpan Data">Simpan</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?= $this->session->flashdata('message'); ?>
            <!-- Default box -->
             <div class="box box-success" style="overflow-x: scroll;">
            <div class="box-header">
				<center><h4 class="box-title">Daftar Soal Ujian</h4></center>
                
                <a href="<?= base_url('soal') ?>"><button type="button" class="btn btn-primary btn-flat" ><span class="fa fa-plus"></span> Tambah</button></a>
				<a href="<?= base_url('soal/generate') ?>"><button type="button" class="btn btn-primary btn-flat" ><span class="fa fa-plus"></span> AI Generate</button></a>
            </div>

                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
								<th width="10%">TYPE </th>
								<th width="10%">TAKSONIMI LEVEL </th>
                                <th width="10%">KODE </th>
                                <th>SOAL UJIAN</th>
                                <th width="13%">KUNCI JAWABAN / KEYWORD</th>
                                <th width="8%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($soal_ujian as $d) {
								if($d->type==1){
									$code='S';
									$type='Soal Pilihan Ganda';
								}elseif ($d->type==2){
									$code='AI';
									$type='AI Pilihan Ganda';
								}elseif ($d->type==3){
									$code='S';
									$type='Soal Esai';
								}elseif ($d->type==4){
									$code='AI';
									$type='AI Esai';
								}

								$taksonomi_level = [
										'Pengetahuan',
										'Pemahaman',
										'Penerapan',
										'Analisis',
										'Evaluasi',
										'Membuat',
								];

								?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
									<td><?php echo $type; ?></td>
									<td><?php echo ($d->taxonomy_level)? $taksonomi_level[($d->taxonomy_level-1)]:'-'; ?></td>
                                    <td><?php echo $code ?><?php echo $d->id_soal_ujian; ?></td>
                                    <td>
                                        <?php echo $d->pertanyaan; ?>
										<?php if($d->type!=3 and $d->type!=4){ ?>
                                        	<ol type="A">
                                            <li>
                                                <?php if ('A'== $d->kunci_jawaban) {
                                                    echo "<b>";
                                                    echo $d->a;
                                                    echo "</b>";
                                                } else {
                                                    echo $d->a;
                                                }
                                                 ?>                                                                
                                            </li>
                                            <li>
                                                <?php if ('B'== $d->kunci_jawaban) {
                                                    echo "<b>";
                                                    echo $d->b;
                                                    echo "</b>";
                                                } else {
                                                    echo $d->b;
                                                }
                                                 ?>    
                                            </li>
                                            <li>
                                                <?php if ('C'== $d->kunci_jawaban) {
                                                    echo "<b>";
                                                    echo $d->c;
                                                    echo "</b>";
                                                } else {
                                                    echo $d->c;
                                                }
                                                 ?>    
                                            </li>
                                            <li>
                                                <?php if ('D'== $d->kunci_jawaban) {
                                                    echo "<b>";
                                                    echo $d->d;
                                                    echo "</b>";
                                                } else {
                                                    echo $d->d;
                                                }
                                                 ?>    
                                            </li>
                                            <li>
                                                <?php if ('E'== $d->kunci_jawaban) {
                                                    echo "<b>";
                                                    echo $d->e;
                                                    echo "</b>";
                                                } else {
                                                    echo $d->e;
                                                }
                                                 ?>    
                                            </li>
                                        </ol>
										<?php } ?>
                                    </td>
                                    <td>
										<b><?php echo $d->kunci_jawaban; ?></b>
									</td>
                                    <td>
                                        <a href="<?= base_url() . 'soal_ujian/edit/' . $d->id_soal_ujian; ?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-edit" title="Ubah"></span></a> |
                                        <a href="<?= base_url() . 'soal_ujian/hapus/' . $d->id_soal_ujian; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" onclick="return confirm('Apakah yakin data soal ini akan di hapus?')" title="Hapus"></span></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
    $(function() {
        $('#data').dataTable();
    });
    $('.select2').select2();
    $('.alert-message').alert().delay(3000).slideUp('slow');
    $('.alert-dismissible').alert().delay(3000).slideUp('slow');
</script>
<?php
$this->load->view('admin/foot');
?>
