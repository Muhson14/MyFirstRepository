<?php
    $row = $db->get_row("SELECT * FROM tb_gejala WHERE kode_gejala='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1 class='white'>Ubah Gejala</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=gejala_ubah&ID=<?=$row->kode_gejala?>">
            <div class="form-group">
                <label class='white'>Kode <span class='white'>*</span></label>
                <input class="form-control" type="text" name="kode" readonly="readonly" value="<?=$row->kode_gejala?>"/>
            </div>
            <div class="form-group">
                <label class='white'>Nama Gejala <span class='white'>*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$row->nama_gejala?>"/>
            </div>
            <div class="form-group">
                <label class='white'>Bobot<span class='white'>*</span></label>
                <input class="form-control" type="text" name="bobot" value="<?=$row->bobot?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=gejala"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>