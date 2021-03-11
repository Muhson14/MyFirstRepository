<div class="page-header">
    <h1 class='white'>Gejala</h1>
</div>
<div class="panel panel-default">
   
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Gejala</th>
            <th>Bobot</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT * FROM tb_gejala 
    WHERE kode_gejala LIKE '%$q%' OR nama_gejala LIKE '%$q%' 
    ORDER BY kode_gejala");
    $no=0;
    foreach($rows as $row):?>
    <tr>
        <td><?=$row->kode_gejala ?></td>
        <td><?=$row->nama_gejala?></td>
        <td><?=$row->bobot?></td>
    </tr>
    <?php endforeach;
    ?>
    </table>
</div>