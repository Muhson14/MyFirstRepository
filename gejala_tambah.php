<div class="page-header">
    <h1 class='white'>Tambah Gejala</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=gejala_tambah">
            <div class="form-group">
                <label class='white'>Kode <span class='white'>*</span></label>
                <input class="form-control" type="text" id="kode" name="kode" value="<?=$_POST['kode']?>"/>
            </div>
            <div class="form-group">
                <label class='white'>Nama Gejala <span class='white'>*</span></label>
                <input class="form-control" type="text" id="nama" name="nama" value="<?=$_POST['nama']?>"/>
            </div>
            <div class="form-group">
                <label class='white'>Bobot <span class='white'>*</span></label>
                <input class="form-control" type="text" id="bobot" name="bobot" value="<?=$_POST['bobot']?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=gejala"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>