<div class="page-header">
    <h1 class='white'>Tambah Penyakit</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=diagnosa_tambah">
            <div class="form-group">
                <label class='white'>Kode <span class="white">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=$_POST['kode']?>"/>
            </div>
            <div class="form-group">
                <label class='white'>Nama Penyakit <span class="white">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$_POST['nama']?>"/>
            </div><div class="form-group">
                <label class='white'>Keterangan</label>
                <textarea class="form-control" name="keterangan"><?=$_POST['keterangan']?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=diagnosa"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>