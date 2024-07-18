<?php 
$this->load->view('admin/head');
?>

<!--tambahkan custom css disini-->

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            


            <!-- Default box -->
            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header" >
					<center><h4 class="box-title">Hasil Ujian</h4></center>
                    <?php if (isset($_GET['id'])) {
                        $id = $_GET['id']; 
                    ?>
                    <a href="<?=base_url().'hasil_ujian/print_all?id='.$id ?>" class="btn btn-danger btn-flat" target="_blank"><i class="fa fa-file-pdf-o"></i> Cetak Sesuai Filter</a>
                    <?php } ?>

                    <a href="<?=base_url('hasil_ujian/print_all')?>" class="btn btn-primary btn-flat pull-right" target="_blank"><i class="fa fa-print"></i> Cetak Semua Hasil Ujian</a>
                </div>
              <div class="box-body">
                <table id="data" class="table table-bordered table-striped">                    
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Nama Siswa</th>                            
                            <th>NIS</th>                            
                            <th>Tanggal Ujian</th>
                            <th>Jam Ujian</th>                            
                            <th>Jenis Ujian</th>                            
                            <th>Benar</th>                            
                            <th>Salah</th>                            
                            <th>Nilai</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        foreach($hasil as $d) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>                              
                                <td><?php echo $d->nama_siswa; ?></td>                                
                                <td><?php echo $d->nis; ?></td>                                
                                <td><?php echo date('d-m-Y',strtotime($d->tanggal_ujian)); ?></td>
                                <td><?php echo date('H:i:s',strtotime($d->jam_ujian)); ?></td>
                                <td><?php echo $d->jenis_ujian; ?></td>
                                <td>
                                    <?php
                                    if($d->benar == ''){
                                        echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                    }else {
                                        echo $d->benar;
                                    }
                                    ?>
                                </td>                                
                                <td>
                                    <?php
                                    if($d->salah == ''){
                                        echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                    }else {
                                        echo $d->salah;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($d->nilai == ''){
                                        echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                    }else {
                                        echo $d->nilai;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($d->nilai == ''){
                                        echo "<span class='btn btn-xs btn-default'>Belum Ujian</span>";
                                    }else {
                                        echo "<a href='".'hasil_ujian/cetak/'."$d->id_peserta' class='btn btn-xs btn-success' title='Cetak Hasil Ujian' target='_blank'><span class='fa fa-print'></span></a>";;
                                    }
                                    ?>
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

	$(function(){
		$('#data').dataTable();
        $('.select2').select2();
	});

	$('.alert-message').alert().delay(3000).slideUp('slow');

</script>

<?php
$this->load->view('admin/foot');
?>

