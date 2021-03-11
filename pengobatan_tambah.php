<div class="page-header">
    <h1 class='white'>Tambah Pengobatan</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=pengobatan_tambah">
            <div class="form-group">
                <label class='white'>Kode Penyakit<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=$_POST['kode']?>"/>
            </div>
            <div class="form-group">
                <label class='white'>Nama Penyakit <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$_POST['nama']?>"/>
            </div><div class="form-group">
                <label class='white'>Pengobatan</label>
                <textarea class="form-control" name="pengobatan"><?=$_POST['pengobatan']?></textarea>
            </div><div class="form-group">
                <label class='white'>Pengobatan 2</label>
                <textarea class="form-control" name="pengobatan2"><?=$_POST['pengobatan2']?></textarea>
            </div><div class="form-group">
                <label class='white'>Pengobatan 3</label>
                <textarea class="form-control" name="pengobatan3"><?=$_POST['pengobatan3']?></textarea>
            </div><div class="form-group">
                <label class='white'>Pengobatan 4</label>
                <textarea class="form-control" name="pengobatan4"><?=$_POST['pengobatan4']?></textarea>
            </div><div class="form-group">
                <label class='white'>Pengobatan 5</label>
                <textarea class="form-control" name="pengobatan5"><?=$_POST['pengobatan5']?></textarea>
            </div><div class="form-group">
                <label class='white'>Pengobatan 6</label>
                <textarea class="form-control" name="pengobatan6"><?=$_POST['pengobatan6']?></textarea>
            </div><div class="form-group">
                <label class='white'>Pengobatan 7</label>
                <textarea class="form-control" name="pengobatan7"><?=$_POST['pengobatan7']?></textarea>
            </div><div class="form-group">
                <label class='white'>Pengobatan 8</label>
                <textarea class="form-control" name="pengobatan8"><?=$_POST['pengobatan8']?></textarea>
            </div><div class="form-group">
                <label class='white'>Pengobatan 9</label>
                <textarea class="form-control" name="pengobatan9"><?=$_POST['pengobatan9']?></textarea>
            </div><div class="form-group">
                <label class='white'>Pengobatan 10</label>
                <textarea class="form-control" name="pengobatan10"><?=$_POST['pengobatan10']?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=pengobatan"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>