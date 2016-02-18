<?php 

// print_r($penggajians);die();

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(

    'Personalia'          => array('/site/personalia'),
    'Gaji dan Upah'     => array('/site/gaji'),
    'Gaji Bulanan'      => array('/site/bulanan'),

    'Gaji All PT'   
);

function TanggalIndo($date)
{
    $BulanIndo = array(

        "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    );

    $tahun  = substr($date, 0, 4);
    $bulan  = substr($date, 5, 2);
    $tgl    = substr($date, 8, 2);
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;   

    return($result);
}

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
} 

$url = Yii::app()->createUrl('/personalia/TbPenggajian/input');

$total_gaji_pokok           = array();
$total_tunjangan_jabatan    = array();
$total_pendapatan_intern    = array();

?>

<table>
    <tr>
        <td width="70px"><label><b>Periode</b></label> </td>
        <td>
            <label><?php echo TanggalIndo($awal); ?> s/d <?php echo TanggalIndo($akhir); ?></label>
        </td>
    </tr>
</table>

<br><br>                

    <div class="overflow-scroll-x">

    <table class="tg">    

    <tr>
        <th class="tg-bsv2" rowspan="2">NIK</th>
        <th class="tg-bsv2" rowspan="2">Nama</th>                    
        <?php foreach ($proyeks as $proyek){
            ?><th class="tg-bsv2" colspan="3"><?php echo$proyek; ?></th><?php
        } ?>        
    </tr>    
    <tr>
        <?php 
        $times = 1;

        foreach ($proyeks as $proyek){            
            $total_gaji_pokok[$times] = 0;
            $total_tunjangan_jabatan[$times] = 0;
            $total_pendapatan_intern[$times] = 0;
            ?>
            <th class="tg-bsv2">Gaji Pokok</th>
            <th class="tg-bsv2">Tunjangan Jabatan</th>
            <th class="tg-bsv2">Pendapatan Intern</th>
            <?php
            $times++; 
        } ?>                        
    </tr>

    <?php 

    // print_r($nik_absens);

    // echo count($nik_absens);
    // die();

    $jumlah_karyawan = 0;

    if(count($nik_absens)!=0){
        foreach ($nik_absens as $nik_absen) 
        { 
            $karyawan = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$nik_absen));

            // print_r($karyawan);
            // die();
            if(count($karyawan)!=0){
                if($karyawan->active!=0)
                { 
                $jumlah_karyawan++;
                ?>

                <tr>
                    <td class="tg-031e">                        
                        <?php echo $karyawan->NIK_Absen; ?>
                    </td>
                    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>                        

                    <?php 
                        $times = 1;

                        foreach ($proyeks as $proyek){   
                        $total_gaji_pokok[$times] = $total_gaji_pokok[$times]+$penggajians['gaji_pokok'][$karyawan->NIK_Absen][$times];
                        $total_tunjangan_jabatan[$times] = $total_tunjangan_jabatan[$times]+$penggajians['tunjangan_jabatan'][$karyawan->NIK_Absen][$times];
                        $total_pendapatan_intern[$times] = $total_pendapatan_intern[$times]+$penggajians['pendapatan_intern'][$karyawan->NIK_Absen][$times];
                        ?>
                        <td class="tg-031e"><?php echo 'Rp '.number_format($penggajians['gaji_pokok'][$karyawan->NIK_Absen][$times],2,",","."); ?></td>
                        <td class="tg-031e"><?php echo 'Rp '.number_format($penggajians['tunjangan_jabatan'][$karyawan->NIK_Absen][$times],2,",","."); ?></td>
                        <td class="tg-031e"><?php echo 'Rp '.number_format($penggajians['pendapatan_intern'][$karyawan->NIK_Absen][$times],2,",","."); ?></td>
                        <?php
                        $times++;
                    } ?>                                       
                </tr>

                <?php } 
            }            
        }        
    }    

    ?>

        <tr>
        <td class="tg-bsv2"></td>
        <td class="tg-bsv2">Total</td>        
        <?php 
        $times = 1;

        foreach ($proyeks as $proyek){ ?>
            <td class="tg-bsv2"><?php echo $total_gaji_pokok[$times]; ?></td>
            <td class="tg-bsv2"><?php echo $total_tunjangan_jabatan[$times]; ?></td>            
            <td class="tg-bsv2"><?php echo $total_pendapatan_intern[$times]; ?></td>        
        <?php 
        $times++; } ?>        
        </tr>
      
    </table>

    </div>

    <br>

    <a class="small-button" href="<?php echo $url; ?>">Close</a>    