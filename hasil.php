<div class="page-header">
    <h1 class='white'>Hasil Diagnosis</h1>
</div>
<?php
$selected = (array) $_POST['gejala'];
if(!$selected):
    print_msg('Belum ada gejala terpilih. <a href="?m=konsultasi">Kembali</a>');
else:
    $rows = $db->get_results("SELECT * FROM tb_gejala WHERE kode_gejala IN ('".implode("','", $selected)."')");
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">        
            <h3 class="panel-title">Gejala Terpilih</h3>
        </div>
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Gejala</th>
            </tr>
        </thead>
        <?php
        $no=1;
        foreach($rows as $row):?>
        <tr>
            <td><?=$no++?></td>
            <td><?=$row->nama_gejala?></td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
    <?php
    $GEJALA = DS_gejala();
    $DIAGNOSA = DS_diagnosa();  
            
    $hasil[] = array(
        'arr' => array_keys($DIAGNOSA),
        'name' => implode(',', array_keys($DIAGNOSA)),
        'value' => 1,
    );
    
    
    foreach ($selected as $kode):
        $new_hasil = array();
        $arr_diagnosa = DS_get_diagnosa($kode);                                        
        ?>    
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title"><?=$GEJALA[$kode]['nama'] .' ( ' . implode(', ', $arr_diagnosa) .' )'?></h3></div>
            <table class="table table-bordered table-hover table-striped">
                <thead><tr>
                    <th></th>
                    <th><?=implode(',', $arr_diagnosa) .' &raquo; ' . $GEJALA[$kode]['bobot']?></th>
                    <th>&theta; &raquo; <?=1 - $GEJALA[$kode]['bobot']?></th>
                </tr></thead>
                <?php foreach($hasil as $row): 
                $arr = array_intersect($row['arr'], $arr_diagnosa); 
                $name =  implode(',', $arr);
                $value = $row['value'] * $GEJALA[$kode]['bobot'];
                $new_hasil[] = array(
                    'arr' => $arr,
                    'name' => $name,
                    'value' => $value,
                );
                
                $arr2 = array_intersect($row['arr'], array_keys($DIAGNOSA)); 
                $name2 =  implode(',', $arr2);
                $value2 = $row['value'] * (1 - $GEJALA[$kode]['bobot']);
                
                $new_hasil[] = array(
                    'arr' => $arr2,
                    'name' => $name2,
                    'value' => $value2,
                );
                
                $hasil = $new_hasil;
                ?>
                <tr>
                    <td><?=$row['name']?> &raquo; <?=round($row['value'], 3)?></td>
                    <td><?=$name?> &raquo; <?=round($value, 3)?></td>
                    <td><?=$name2?> &raquo; <?=round($value2, 3)?></td>
                </tr>
                <?php endforeach;?>
            </table>
            <?php            
            $unik = array();
            foreach($hasil as $row){
                $unik[$row['name']] = $row['arr'];
            }              
                
            $new_hasil = DS_hitung($unik, $hasil);
            $hasil = $new_hasil;
            ?>
            <div class="panel-body">            
                <table class="table table-bordered aw">
                    <tr>
                        <th>Kombinasi Diagnosis</th>
                        <th>Rumus</th>
                        <th>Nilai</th>
                    </tr>
                    <?php foreach($hasil as $key => $val):
                   
                    ?>
                    <tr>
                        <td><?=$val['name']?></td>
                        <td>&Sigma;<?=$val['name']?> / (1 - (<i>k</i>))</td>
                        <td>: <?=round($val['value'], 3)?></td>
                    </tr>
                    <?php endforeach?>
                </table>
            </div>
        </div>
    <?php endforeach;
       
    function DS_get_best($hasil){
        $num = 0;
        $max = array();
        foreach($hasil as $val){
            if($val['value'] > $num){
                $num = $val['value'];
                $max = $val;
            }
        }
        return $max;
    }
    
    $best = DS_get_best($hasil);

    $hasil2 = $hasil;

    $keys = array_column($hasil2, 'value');
    array_multisort($keys, SORT_DESC, $hasil2);

    $c = count($hasil2);
    

    if ($c < 3):{
        $best1 = $hasil2[1];
    }

    elseif ($c == 3):{
        $best0 = $hasil2[0];
        $best1 = $hasil2[1];
        $best2 = $hasil2[2];
        $best3 = $hasil2[3];
    }

    else:{
        $best0 = $hasil2[0];
        $best1 = $hasil2[1];
        $best2 = $hasil2[2];
        $best3 = $hasil2[3];
        $best4 = $hasil2[4];
    }

    endif;

    // var_dump($hasil2);
    // die();

    $diags = array();
    $diags2 = array();
    
    foreach($best['arr'] as $val){
        $diags[] = $DIAGNOSA[$val]['nama'];
    }

    ?>
    <div class="panel panel-primary">

        <div class="panel-heading"><h3 class="panel-title">Kesimpulan</h3></div>
        <div class="panel-body">
                <p>Berdasarkan gejala yang terpilih maka diagnosis paling akurat adalah sebagai berikut : <br> <strong>
                <?php if ($c < 3):{

                    foreach($best1['arr'] as $val){
                        $diags1[] = $DIAGNOSA[$val]['nama'];
                    }

                    echo '</strong> 1.  <strong> ';

                    if( implode(', ', $diags) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da = implode(', ', $diags1); echo $da;} 
                    else:{$da2 = implode(', ', $diags0); echo $da2;}
                    endif;

                    echo ' </strong> dengan kemungkinan <strong> ';

                    if ( implode(', ', $diags) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai2 = round(($best1['value'] * 100),1); echo $nilai2;} 
                    else:{$nilai = round(($best['value'] * 100),1); echo $nilai;} endif;

                    echo '%. <br>';

                }
                elseif ($c == 3):{
                    foreach($best0['arr'] as $val){
                        $diags0[] = $DIAGNOSA[$val]['nama'];
                    }

                    foreach($best1['arr'] as $val){
                        $diags1[] = $DIAGNOSA[$val]['nama'];
                    }

                    foreach($best2['arr'] as $val){
                        $diags2[] = $DIAGNOSA[$val]['nama'];
                    } 

                    echo '</strong> 1.  <strong> ';

                    if( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da = implode(', ', $diags1); echo $da;} 
                    else:{$da2 = implode(', ', $diags0); echo $da2;}
                    endif;

                    echo ' </strong> dengan kemungkinan <strong> ';

                    if ( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai2 = round(($best1['value'] * 100),1); echo $nilai2;} 
                    else:{$nilai = round(($best['value'] * 100),1); echo $nilai;} endif;

                    echo '%. <br>';

                    echo '</strong> 2.  <strong> ';

                    if( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da = implode(', ', $diags2); echo $da;} 
                    elseif( implode(', ', $diags2) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da2 = implode(', ', $diags1); echo $da2;}
                    else:{$da2 = implode(', ', $diags2); echo $da2;} 
                    endif;

                    echo ' </strong> dengan kemungkinan <strong> ';

                    if ( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best2['value'] * 100),1); echo $nilai;} 
                    elseif( implode(', ', $diags2) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best1['value'] * 100),1); echo $nilai;}
                    else:{$nilai = round(($best2['value'] * 100),1); echo $nilai;} 
                    endif;

                    echo '%. <br>';
                }
                else:{
                    foreach($best0['arr'] as $val){
                        $diags0[] = $DIAGNOSA[$val]['nama'];
                    }

                    foreach($best1['arr'] as $val){
                        $diags1[] = $DIAGNOSA[$val]['nama'];
                    }

                    foreach($best2['arr'] as $val){
                        $diags2[] = $DIAGNOSA[$val]['nama'];
                    } 

                    foreach($best3['arr'] as $val){
                        $diags3[] = $DIAGNOSA[$val]['nama'];
                    } 

                    echo '</strong> 1.  <strong> ';

                    if( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da = implode(', ', $diags1); echo $da;} 
                    else:{$da2 = implode(', ', $diags0); echo $da2;}
                    endif;

                    echo ' </strong> dengan kemungkinan <strong> ';

                    if ( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai2 = round(($best1['value'] * 100),1); echo $nilai2;} 
                    else:{$nilai = round(($best['value'] * 100),1); echo $nilai;} endif;

                    echo '%. <br>';

                    echo '</strong> 2.  <strong> ';

                    if( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da = implode(', ', $diags2); echo $da;} 
                    elseif( implode(', ', $diags1) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da2 = implode(', ', $diags2); echo $da2;}
                    elseif( implode(', ', $diags2) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da3 = implode(', ', $diags1); echo $da3;}
                    elseif( implode(', ', $diags3) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da4 = implode(', ', $diags1); echo $da4;}
                    else:{$da5 = implode(', ', $diags1); echo $da5;} 
                    endif;


                    echo ' </strong> dengan kemungkinan <strong> ';

                    if ( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best2['value'] * 100),1); echo $nilai;} 
                    elseif( implode(', ', $diags1) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best2['value'] * 100),1); echo $nilai;}
                    elseif( implode(', ', $diags2) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best1['value'] * 100),1); echo $nilai;}
                    elseif( implode(', ', $diags3) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best1['value'] * 100),1); echo $nilai;}
                    else:{$nilai = round(($best1['value'] * 100),1); echo $nilai;} 
                    endif;

                    echo '%. <br>';

                    echo '</strong> 3.  <strong> ';

                    if( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da = implode(', ', $diags3); echo $da;} 
                    elseif( implode(', ', $diags1) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da2 = implode(', ', $diags3); echo $da2;}
                    elseif( implode(', ', $diags2) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da2 = implode(', ', $diags3); echo $da2;}
                    elseif( implode(', ', $diags3) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$da2 = implode(', ', $diags2); echo $da2;}
                    else:{$da2 = implode(', ', $diags2); echo $da2;} 
                    endif;

                    echo ' </strong> dengan kemungkinan <strong> ';

                    if ( implode(', ', $diags0) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best3['value'] * 100),1); echo $nilai;} 
                    elseif( implode(', ', $diags1) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best3['value'] * 100),1); echo $nilai;}
                    elseif( implode(', ', $diags2) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best3['value'] * 100),1); echo $nilai;}
                    elseif( implode(', ', $diags3) ==  
                    'Cacingan, Kudis / Scabies, Mastitis, Perut Kembung, Mencret / Diare, Sakit Mata, Orf, Kuku Busuk'):
                    {$nilai = round(($best2['value'] * 100),1); echo $nilai;}
                    else:{$nilai = round(($best2['value'] * 100),1); echo $nilai;} 
                    endif;

                    echo '%. <br>';
                }
                
                endif;?>
        </div>
    </div>
<?php endif;?>
