<?php 

// print_r($proyeks);

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
        <th class="tg-bsv2" rowspan="2">Toal</th>                    
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
    $total_semua     = 0;   

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
                    <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
                    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>                        

                    <?php 
                        $times              = 1;
                        $total_per_karyawan = 0;

                        foreach ($proyeks as $proyek){   
                            if(isset($penggajians['gaji_pokok'][$karyawan->NIK_Absen][$times])){
                                $gaji_pokok = $penggajians['gaji_pokok'][$karyawan->NIK_Absen][$times];
                                $gaji_pokok = str_replace('.', '', $gaji_pokok);
                            }                                
                            else $gaji_pokok = '';

                            if(isset($penggajians['tunjangan_jabatan'][$karyawan->NIK_Absen][$times])){
                                $tunjangan_jabatan = $penggajians['tunjangan_jabatan'][$karyawan->NIK_Absen][$times];                            
                                $tunjangan_jabatan = str_replace('.', '', $tunjangan_jabatan);
                            }                                
                            else $tunjangan_jabatan = '';
                            
                            if(isset($penggajians['pendapatan_intern'][$karyawan->NIK_Absen][$times])){
                                $pendapatan_intern = $penggajians['pendapatan_intern'][$karyawan->NIK_Absen][$times];
                                $pendapatan_intern = str_replace('.', '', $pendapatan_intern);
                            }                                
                            else $pendapatan_intern = '';

                            if($gaji_pokok=='') $gaji_pokok = 0;
                            if($tunjangan_jabatan=='') $tunjangan_jabatan = 0;
                            if($pendapatan_intern=='') $pendapatan_intern = 0;

                            $total_gaji_pokok[$times]           = $total_gaji_pokok[$times]+$gaji_pokok;
                            $total_tunjangan_jabatan[$times]    = $total_tunjangan_jabatan[$times]+$tunjangan_jabatan;
                            $total_pendapatan_intern[$times]    = $total_pendapatan_intern[$times]+$pendapatan_intern;                        

                            $total_per_proyek   = $gaji_pokok+$tunjangan_jabatan;
                            $total_per_karyawan = $total_per_karyawan+$total_per_proyek;

                            ?>
                            <td class="tg-031e"><?php echo 'Rp '.number_format($gaji_pokok,2,",","."); ?></td>
                            <td class="tg-031e"><?php echo 'Rp '.number_format($tunjangan_jabatan,2,",","."); ?></td>
                            <td class="tg-031e"><?php echo 'Rp '.number_format($pendapatan_intern,2,",","."); ?></td>
                            <?php
                            $times++;
                        } 
                    ?>                  
                    <td class="tg-031e"><?php echo 'Rp '.number_format($total_per_karyawan,2,",","."); ?></td>                     
                </tr>

                <?php 

                $total_semua = $total_semua+$total_per_karyawan;

                } 
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
            <td class="tg-bsv2"><?php echo 'Rp '.number_format($total_gaji_pokok[$times],2,",","."); ?></td>
            <td class="tg-bsv2"><?php echo 'Rp '.number_format($total_tunjangan_jabatan[$times],2,",","."); ?></td>            
            <td class="tg-bsv2"><?php echo 'Rp '.number_format($total_pendapatan_intern[$times],2,",","."); ?></td>        
        <?php 
        $times++; } ?>        
        <td class="tg-bsv2"><?php echo 'Rp '.number_format($total_semua,2,",","."); ?></td>
        </tr>
      
    </table>

    </div>

    <br>

    <a class="small-button" href="<?php echo $url; ?>">Close</a>    