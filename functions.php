<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);
session_start();
$config["server"]='localhost';
$config["username"]='root';
$config["password"]='';
$config["database_name"]='sp_ds';

include'includes/ez_sql_core.php';
include'includes/ez_sql_mysqli.php';
$db = new ezSQL_mysqli($config['username'], $config['password'], $config['database_name'], $config['server']);
include'includes/general.php';
include'includes/paging.php';
    
$mod = $_GET['m'];
$act = $_GET['act']; 

function CF_get_diagnosa_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_diagnosa, nama_diagnosa FROM tb_diagnosa ORDER BY kode_diagnosa");
    foreach($rows as $row){
        if($row->kode_diagnosa==$selected)
            $a.="<option value='$row->kode_diagnosa' selected>[$row->kode_diagnosa] $row->nama_diagnosa</option>";
        else
            $a.="<option value='$row->kode_diagnosa'>[$row->kode_diagnosa] $row->nama_diagnosa</option>";
    }
    return $a;
}

function CF_get_gejala_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala ORDER BY kode_gejala");
    foreach($rows as $row){
        if($row->kode_gejala==$selected)
            $a.="<option value='$row->kode_gejala' selected>[$row->kode_gejala] $row->nama_gejala</option>";
        else
            $a.="<option value='$row->kode_gejala'>[$row->kode_gejala] $row->nama_gejala</option>";
    }
    return $a;
}

function DS_gejala(){
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_gejala ORDER BY kode_gejala");
    $data = array();
    foreach($rows as $row){
        $data[$row->kode_gejala]['kode'] = $row->kode_gejala;
        $data[$row->kode_gejala]['nama'] = $row->nama_gejala;
        $data[$row->kode_gejala]['bobot'] = $row->bobot;                
    }
    return $data;
}

function DS_diagnosa(){
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_diagnosa ORDER BY kode_diagnosa");
    $data = array();
    foreach($rows as $row){
        $data[$row->kode_diagnosa]['kode'] = $row->kode_diagnosa;
        $data[$row->kode_diagnosa]['nama'] = $row->nama_diagnosa;    
    }
    return $data;
}

function DS_get_diagnosa($kode){
    global $db;
    $rows = $db->get_results("SELECT kode_diagnosa FROM tb_relasi WHERE kode_gejala='$kode' ORDER BY kode_diagnosa");
    $data = array();
    foreach($rows as $row){
        $data[] = $row->kode_diagnosa;
    }
    return $data;
}

function DS_hitung($unik, $data){
    $arr = array();
    $kosong = DS_total_nilai('', $data);    
    foreach($unik as $key => $val){
        if($key!=''){
            $arr[] = array(
                'arr' => $val,
                'name' => $key,
                'value' =>  DS_total_nilai($key, $data) / (1 - $kosong),
            );    
        }        
    }
    return $arr;
}

function DS_total_nilai($name, $data){
    $arr = 0;
    foreach($data as $val){
        if($val['name']==$name){
            $arr+=$val['value'];
        }
    }
    return $arr;
}