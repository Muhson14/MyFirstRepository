<div class="page-header">
    <h1 class='white'>Penyakit</h1>
</div>
<div class="panel panel-default">


<table class="table table-bordered table-hover table-striped">
<thead>
    <tr class="nw">
        <th>No</th>
        <th>Kode</th>
        <th>Nama Penyakit</th>
        <th>Keterangan</th>
        <th>Gambar Penyakit</th>
    </tr>
</thead>
<?php
$q = esc_field($_GET['q']);
$rows = $db->get_results("SELECT * FROM tb_diagnosa 
    WHERE kode_diagnosa LIKE '%$q%' OR nama_diagnosa LIKE '%$q%' OR keterangan LIKE '%$q%' 
    ORDER BY kode_diagnosa");
$no=0;
$imgs=array("cacingan","scabies","mastitis","perutkembung","mencret","sakitmata","orf","kukubusuk"); 
foreach($rows as $index => $row) :?>
<tr>
    <td><?=++$no ?></td>
    <td><?=$row->kode_diagnosa?></td>
    <td><?=$row->nama_diagnosa?></td>
    <td><?=$row->keterangan?></td>
    <td><img src="assets/images/<?=$imgs[$index]?>.jpg" style="width:200px; height:150px;"></td>
</tr>
<?php endforeach;
?>
</table>
</div>