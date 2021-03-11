<div class="page-header">
    <h1 class='white'>Relasi</h1>
</div>
<div class="panel panel-default">

<table class="table table-bordered table-hover table-striped">
<thead>
    <tr class="nw">
        <th>No</th>
        <th>Penyakit</th>
        <th>Gejala</th>
        <th>Bobot</th>
    </tr>
</thead>
<?php
$q = esc_field($_GET['q']);
$rows = $db->get_results("SELECT r.ID, r.kode_gejala, d.kode_diagnosa, g.nama_gejala, d.nama_diagnosa, g.bobot
    FROM tb_relasi r INNER JOIN tb_diagnosa d ON d.`kode_diagnosa`=r.`kode_diagnosa` INNER JOIN tb_gejala g ON g.`kode_gejala`=r.`kode_gejala`
    WHERE r.kode_gejala LIKE '%$q%'
        OR r.kode_diagnosa LIKE '%$q%'
        OR g.nama_gejala LIKE '%$q%'
        OR d.nama_diagnosa LIKE '%$q%' 
    ORDER BY r.kode_diagnosa, r.kode_gejala");
$no=0;

foreach($rows as $row):?>
<tr>
    <td><?=++$no ?></td>
    <td>[<?=$row->kode_diagnosa . '] ' . $row->nama_diagnosa?></td>
    <td>[<?=$row->kode_gejala . '] ' . $row->nama_gejala?></td>
    <td><?=$row->bobot?></td>
</tr>
<?php endforeach;
?>
</table>
</div>