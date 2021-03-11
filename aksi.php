<?php
require_once'functions.php';
$demo = false;

/** LOGIN */ 

if($demo && $act != 'login' && $act != 'logout'){
    echo('<script>alert("")</script>');
    if($mod=='diagnosa_tambah' || $mod=='diagnosa_ubah' || $act=='diagnosa_hapus')
        redirect_js("index.php?m=diagnosa");
    if($mod=='gejala_tambah' || $mod=='gejala_ubah' || $act=='gejala_hapus')
        redirect_js("index.php?m=gejala");
    if($mod=='relasi_tambah' || $mod=='relasi_ubah' || $act=='relasi_hapus')
        redirect_js("index.php?m=relasi");   
    if($mod=='pengobatan_tambah' || $mod=='pengobatan_ubah' || $act=='pengobatan_hapus')
        redirect_js("index.php?m=pengobatan");  
}else{     
    if ($act=='login'){
        $user = esc_field($_POST['user']);
        $pass = esc_field($_POST['pass']);

        if (esc_field($_POST['user']) == 'admin'){
            $leveladmin = $user;
        }

        else{
            $leveluser = $user;
        }

        // var_dump($leveladmin);
        // die();
        $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
     
        if($row && $leveladmin){
            $_SESSION['login'] = $row->user;
            redirect_js("index.php");
        }
        if($row && $leveluser){
            $_SESSION['login'] = $row->user;
            redirect_js("indexuser.php");
        } else{
            print_msg("Salah kombinasi username dan password.");
        }          
    }else if ($mod=='password'){
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $pass3 = $_POST['pass3'];
        
        $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND pass='$pass1'");        
        
        if($pass1=='' || $pass2=='' || $pass3=='')
            print_msg('Field bertanda * harus diisi.');
        elseif(!$row)
            print_msg('Password lama salah.');
        elseif( $pass2 != $pass3 )
            print_msg('Password baru dan konfirmasi password baru tidak sama.');
        else{        
            $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
            print_msg('Password berhasil diubah.', 'success');
        }
    } elseif($act=='logout'){
        unset($_SESSION['login']);
        header("location:login.php");
    }
    
    /** DIAGNOSA */
    elseif($mod=='diagnosa_tambah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $keterangan = $_POST['keterangan'];
        if($kode=='' || $nama=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_diagnosa WHERE kode_diagnosa='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("INSERT INTO tb_diagnosa (kode_diagnosa, nama_diagnosa, keterangan) VALUES ('$kode', '$nama', '$keterangan')");                       
            redirect_js("index.php?m=diagnosa");
        }
    } else if($mod=='diagnosa_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $keterangan = $_POST['keterangan'];
        if($kode=='' || $nama=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_diagnosa SET nama_diagnosa='$nama', keterangan='$keterangan' WHERE kode_diagnosa='$_GET[ID]'");
            redirect_js("index.php?m=diagnosa");
        }
    } else if ($act=='diagnosa_hapus'){
        $db->query("DELETE FROM tb_diagnosa WHERE kode_diagnosa='$_GET[ID]'");
        $db->query("DELETE FROM tb_relasi WHERE kode_diagnosa='$_GET[ID]'");
        header("location:index.php?m=diagnosa");
    } 
    
    /** GEJALA */    
    if($mod=='gejala_tambah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $bobot = $_POST['bobot'];
        
        if(!$kode || !$nama || !$bobot)
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_gejala WHERE kode_gejala='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("INSERT INTO tb_gejala (kode_gejala, nama_gejala, bobot) VALUES ('$kode', '$nama', '$bobot')");
            redirect_js("index.php?m=gejala");            
        }                    
    } else if($mod=='gejala_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $bobot = $_POST['bobot'];
        
        if(!$kode || !$nama || !$bobot)
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_gejala SET nama_gejala='$nama', bobot='$bobot' WHERE kode_gejala='$_GET[ID]'");
            redirect_js("index.php?m=gejala");
        }    
    } else if ($act=='gejala_hapus'){
        $db->query("DELETE FROM tb_gejala WHERE kode_gejala='$_GET[ID]'");
        $db->query("DELETE FROM tb_relasi WHERE kode_gejala='$_GET[ID]'");
        header("location:index.php?m=gejala");
    } 
        
    /** RELASI TAMBAH */ 
    else if ($mod=='relasi_tambah'){
        $kode_diagnosa = $_POST['kode_diagnosa'];
        $kode_gejala = $_POST['kode_gejala'];
        
        $kombinasi_ada = $db->get_row("SELECT * FROM tb_relasi WHERE kode_diagnosa='$kode_diagnosa' AND kode_gejala='$kode_gejala'");
        
        if($kode_diagnosa=='' || $kode_gejala=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($kombinasi_ada)
            print_msg("Kombinasi diagnosa dan gejala sudah ada!");
        else{
            $db->query("INSERT INTO tb_relasi (kode_diagnosa, kode_gejala) VALUES ('$kode_diagnosa', '$kode_gejala')");
            redirect_js("index.php?m=relasi");
        }   
    }else if ($mod=='relasi_ubah'){
        $kode_diagnosa = $_POST['kode_diagnosa'];
        $kode_gejala = $_POST['kode_gejala'];
        
        $kombinasi_ada = $db->get_row("SELECT * FROM tb_relasi WHERE kode_diagnosa='$kode_diagnosa' AND kode_gejala='$kode_gejala' AND ID<>'$_GET[ID]'");
        
        if($kode_diagnosa=='' || $kode_gejala=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($kombinasi_ada)
            print_msg("Kombinasi diagnosa dan gejala sudah ada!");
        else{
            $db->query("UPDATE tb_relasi SET kode_diagnosa='$kode_diagnosa', kode_gejala='$kode_gejala' WHERE ID='$_GET[ID]'");
            redirect_js("index.php?m=relasi");
        }  
        header("location:index.php?m=relasi");
    } else if ($act=='relasi_hapus'){
        $db->query("DELETE FROM tb_relasi WHERE ID='$_GET[ID]'");
        header("location:index.php?m=gejala");
    }     

       /** Pengobatan */
       elseif($mod=='pengobatan_tambah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $pengobatan = $_POST['pengobatan'];
        $pengobatan2 = $_POST['pengobatan2'];
        $pengobatan3 = $_POST['pengobatan3'];
        $pengobatan4 = $_POST['pengobatan4'];
        $pengobatan5 = $_POST['pengobatan5'];
        $pengobatan6 = $_POST['pengobatan6'];
        $pengobatan7 = $_POST['pengobatan7'];
        $pengobatan8 = $_POST['pengobatan8'];
        $pengobatan9 = $_POST['pengobatan9'];
        $pengobatan10 = $_POST['pengobatan10'];
        if($kode=='' || $nama=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_pengobatan WHERE kode_diagnosa='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("INSERT INTO tb_pengobatan (kode_diagnosa, nama_diagnosa, pengobatan, pengobatan2, pengobatan3, pengobatan4, pengobatan5, pengobatan6, pengobatan7, pengobatan8, pengobatan9, pengobatan10)
             VALUES ('$kode', '$nama', '$pengobatan', '$pengobatan2', '$pengobatan3', '$pengobatan4', '$pengobatan5', '$pengobatan6', '$pengobatan7', '$pengobatan8', '$pengobatan9', '$pengobatan10')");                       
            redirect_js("index.php?m=pengobatan");
        }
    } else if($mod=='pengobatan_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $pengobatan = $_POST['pengobatan'];
        $pengobatan2 = $_POST['pengobatan2'];
        $pengobatan3 = $_POST['pengobatan3'];
        $pengobatan4 = $_POST['pengobatan4'];
        $pengobatan5 = $_POST['pengobatan5'];
        $pengobatan6 = $_POST['pengobatan6'];
        $pengobatan7 = $_POST['pengobatan7'];
        $pengobatan8 = $_POST['pengobatan8'];
        $pengobatan9 = $_POST['pengobatan9'];
        $pengobatan10 = $_POST['pengobatan10'];
        if($kode=='' || $nama=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_pengobatan SET nama_diagnosa='$nama', pengobatan='$pengobatan', pengobatan2='$pengobatan2', pengobatan3='$pengobatan3', pengobatan4='$pengobatan4', pengobatan5='$pengobatan5', pengobatan6='$pengobatan6', pengobatan7='$pengobatan7', pengobatan8='$pengobatan8', pengobatan9='$pengobatan9', pengobatan10='$pengobatan10'
            WHERE kode_diagnosa='$_GET[ID]'");
            redirect_js("index.php?m=pengobatan");
        }
    } else if ($act=='pengobatan_hapus'){
        $db->query("DELETE FROM tb_pengobatan WHERE kode_diagnosa='$_GET[ID]'");
        header("location:index.php?m=pengobatan");
    } 

}
?>
