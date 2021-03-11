<div class="page-header">
    <h1 class='white'>Pengobatan</h1>
</div>
<div class="panel panel-default">

<table class="table table-bordered table-hover table-striped">
<thead>
    <tr class="nw">
        <th>No</th>
        <th>Kode</th>
        <th>Nama Penyakit</th>
        <th>Pengobatan</th>
    </tr>
</thead>
<?php
$q = esc_field($_GET['q']);
$rows = $db->get_results("SELECT * FROM tb_pengobatan 
    WHERE kode_diagnosa LIKE '%$q%' OR nama_diagnosa LIKE '%$q%' OR pengobatan LIKE '%$q%' 
    ORDER BY kode_diagnosa");
$no=0;

foreach($rows as $row):

    $pengobatans = array (
        $row->pengobatan,
        $row->pengobatan2,
        $row->pengobatan3,
        $row->pengobatan4,
        $row->pengobatan5,
        $row->pengobatan6,
        $row->pengobatan7,
        $row->pengobatan8,
        $row->pengobatan9,
        $row->pengobatan10
      );
    ?>
<tr>
    <td><?=++$no ?></td>
    <td><?=$row->kode_diagnosa?></td>
    <td><?=$row->nama_diagnosa?></td>
    <td>
        <ol>
            <?php for ($i = 0; $i < 10; $i++) 
            {
                if($pengobatans[$i] != null){
                    echo '<li>'; echo $pengobatans[$i]; echo '</li>';
                }
            }?>
        </ol>
    </td>
</tr>
<?php endforeach;
?>
</table>
</div>