<?php
    $row = $db->get_row("SELECT * FROM tb_pengobatan WHERE kode_diagnosa='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1 class='white'>Ubah Pengobatan</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=pengobatan_ubah&ID=<?=$row->kode_diagnosa?>">
            <div class="form-group">
                <label class='white'>Kode Penyakit<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=$row->kode_diagnosa?>"/>
            </div>
            <div class="form-group">
                <label class='white'>Nama Penyakit<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$row->nama_diagnosa?>"/>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan</label>
                <textarea class="form-control" name="pengobatan"><?=$row->pengobatan?></textarea>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan 2</label>
                <textarea class="form-control" name="pengobatan2"><?=$row->pengobatan2?></textarea>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan 3</label>
                <textarea class="form-control" name="pengobatan3"><?=$row->pengobatan3?></textarea>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan 4</label>
                <textarea class="form-control" name="pengobatan4"><?=$row->pengobatan4?></textarea>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan 5</label>
                <textarea class="form-control" name="pengobatan5"><?=$row->pengobatan5?></textarea>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan 6</label>
                <textarea class="form-control" name="pengobatan6"><?=$row->pengobatan6?></textarea>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan 7</label>
                <textarea class="form-control" name="pengobatan7"><?=$row->pengobatan7?></textarea>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan 8</label>
                <textarea class="form-control" name="pengobatan8"><?=$row->pengobatan8?></textarea>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan 9</label>
                <textarea class="form-control" name="pengobatan9"><?=$row->pengobatan9?></textarea>
            </div>
            <div class="form-group">
                <label class='white'>Pengobatan 10</label>
                <textarea class="form-control" name="pengobatan10"><?=$row->pengobatan10?></textarea>
            </div>
            <div class="page-header">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=pengobatan"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>