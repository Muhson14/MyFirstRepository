<?php
    $row = $db->get_row("SELECT * FROM tb_relasi WHERE ID='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1 class='white'>Ubah Relasi</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=relasi_ubah&ID=<?=$row->ID?>">
            <div class="form-group">
                <label class='white'>Penyakit <span class='white'>*</span></label>
                <select class="form-control" name="kode_diagnosa">
                    <option value=""></option>
                    <?=CF_get_diagnosa_option($row->kode_diagnosa)?>
                </select>
            </div>
            <div class="form-group">
                <label class='white'>Gejala <span class='white'>*</span></label>
                <select class="form-control" name="kode_gejala">
                    <option value=""></option>
                    <?=CF_get_gejala_option($row->kode_gejala)?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=relasi"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form><br><br><br>
    </div>
</div>