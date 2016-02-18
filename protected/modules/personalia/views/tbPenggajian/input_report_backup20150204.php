<?php $this->breadcrumbs=array(

	'Personalia' 	=> array('/site/personalia'),
	'Gaji dan Upah'	=> array('/site/gaji'),
	'Gaji Bulanan' 	=> array('/site/bulanan'),

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

$url = Yii::app()->createUrl('/personalia/TbPenggajian/input'); ?>

<label>
    <b>Periode:</b>
</label> 

&nbsp;

<label><?php echo TanggalIndo($awal); ?> s/d <?php echo TanggalIndo($akhir); ?></label>

<br><br><br>

<table class="tg">

<?php $times = 1;

foreach ($proyeks as $proyek) 
{       
    if($times == 1)
    {
        ?>

        <tr>
            <th class="tg-bsv2" rowspan="2" width="20px">NIK</th>
            <th class="tg-bsv2" rowspan="2" width="300px">Nama</th>    
            
            <th class="tg-bsv2" colspan="3">
                <?php echo $proyek; ?>
                <input name="proyeks[<?php echo $times; ?>]" value="<?php echo $proyek; ?>" hidden="true">
            </th>
        </tr>

        <tr>
            <td class="tg-bsv2" width="100px">Gaji Pokok</td>
            <td class="tg-bsv2" width="100px">Tunjangan Jabatan</td>
            <td class="tg-bsv2" width="100px">Pendapatan Intern</td>    
        </tr>  

        <?php foreach ($penggajians as $penggajian) 
        { 
            if($penggajian->proyek==$proyek)
            { $nama = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$penggajian->NIK))->Nama; ?>

            <tr>
                <td class="tg-031e"><?php echo $penggajian->NIK; ?></td>
                <td class="tg-031e"><?php echo $nama; ?></td>
                
                <td class="tg-031e"><?php echo 'Rp '.number_format($penggajian->gaji_pokok,2,",","."); ?></td>
                <td class="tg-031e"><?php echo 'Rp '.number_format($penggajian->tunjangan_jabatan,2,",","."); ?></td>
                <td class="tg-031e"><?php echo 'Rp '.number_format($penggajian->pendapatan_intern,2,",","."); ?></td>
            </tr>

            <?php } 
        }
    }
    else
    {
        ?>

        <tr>
            <th class="tg-bsv2"></th>
            <th class="tg-bsv2"></th>
            
            <th class="tg-bsv2" colspan="3">
                <?php echo $proyek; ?>
                <input name="proyeks[<?php echo $times; ?>]" value="<?php echo $proyek; ?>" hidden="true">
            </th>
        </tr>

        <?php foreach ($penggajians as $penggajian) 
        { 
            if($penggajian->proyek==$proyek)
            { $nama = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$penggajian->NIK))->Nama; ?>

            <tr>
                <td class="tg-031e"><?php echo $penggajian->NIK; ?></td>
                <td class="tg-031e"><?php echo $nama; ?></td>                
                <td class="tg-031e"><?php echo 'Rp '.number_format($penggajian->gaji_pokok,2,",","."); ?></td>
                <td class="tg-031e"><?php echo 'Rp '.number_format($penggajian->tunjangan_jabatan,2,",","."); ?></td>
                <td class="tg-031e"><?php echo 'Rp '.number_format($penggajian->pendapatan_intern,2,",","."); ?></td>
            </tr>

            <?php }
        }    
    }

  $times++; 

} ?>

    <tr>
        <td class="tg-bsv2"></td>
        <td class="tg-bsv2">Total</td>
        <td class="tg-bsv2"><?php echo 'Rp '.number_format($total_gaji_pokok,2,",","."); ?></td>
        <td class="tg-bsv2"><?php echo 'Rp '.number_format($total_tunjangan_jabatan,2,",","."); ?></td>
        <td class="tg-bsv2"><?php echo 'Rp '.number_format($total_pendapatan_intern,2,",","."); ?></td>
    </tr>
  
</table>        

<a class="small-button" href="<?php echo $url; ?>">Close</a>