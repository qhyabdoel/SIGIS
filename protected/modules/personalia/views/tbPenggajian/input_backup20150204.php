<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(

	'Personalia' 		  => array('/site/personalia'),
	'Gaji dan Upah'		=> array('/site/gaji'),
	'Gaji Bulanan' 		=> array('/site/bulanan'),

	'Gaji All PT'	
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
} 

$url = Yii::app()->createUrl('site/bulanan');

?>

<label>
    <b>Periode</b>
</label> 

&nbsp;

<?php echo CHtml::dateField('awal','',array('id'=>'awalField1')); ?>
-
<?php echo CHtml::dateField('akhir','',array('id'=>'akhirField1')); ?>

<br><br>    

<form action="input" method="post">
    <span class="float-right">    
        
        <input name="proyeks_count" value="<?php echo $proyeks_count; ?>" hidden="true">
        
        <?php 
        
        $times = 1;

        foreach ($proyeks as $proyek) 
        {            
            ?><input name="proyeks[<?php echo $times; ?>]" value="<?php echo $proyek; ?>" hidden="true"><?php

            $times++;
        } ?>

        <label><b>Proyek</b></label>
        &nbsp;
                
        <?php 
        echo CHtml::dropDownList('proyek','___',array(
            'SIB'       =>'SIB',
            'SIL'       =>'SIL',
            'PR'        =>'PR',
            'DMR'       =>'DMR',
            "D'LAPAN"   =>"D'LAPAN",
            'SML'       =>'SML'
        )); 
        ?>
        <input name="action" id="actionField" hidden="true">        

    	<button id="buttonHapus" hidden="true"></button>
    	<button id="buttonTambah" hidden="true"></button>

        <a class="small-button" href="#" id="buttonLinkHapus">Hapus Proyek</a>
        <a class="small-button" href="#" id="buttonLinkTambah">Tambah Proyek</a>

    </span>
</form>

<br><br><br>

<form action="input" method="post">    
    
    <input name="is_save" hidden="true" value="true">
    <input name="awal" hidden="true" id="awalField">
    <input name="akhir" hidden="true" id="akhirField">    

    <table class="tg">

    <?php 

    $times = 1;

    foreach ($proyeks as $proyek) 
    {       
        if($times == 1)
        {
            ?>

            <tr>
                <th class="tg-bsv2" rowspan="2">NIK</th>
                <th class="tg-bsv2" rowspan="2">Nama</th>    
                
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

            <?php foreach ($karyawans as $karyawan) 
            { 
                if($karyawan->active!=0)
                { ?>

                <tr>
                    <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
                    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
                    
                    <td class="tg-031e">
                        <input name="gaji_pokok[<?php echo $karyawan->NIK_Absen; ?>][<?php echo $times; ?>]">
                    </td>
                    <td class="tg-031e">
                        <input name="tunjangan_jabatan[<?php echo $karyawan->NIK_Absen; ?>][<?php echo $times; ?>]">
                    </td>
                    <td class="tg-031e">
                        <input name="pendapatan_intern[<?php echo $karyawan->NIK_Absen; ?>][<?php echo $times; ?>]">
                    </td>
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

            <?php foreach ($karyawans as $karyawan) 
            { 
                if($karyawan->active!=0)
                { ?>

                <tr>
                    <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
                    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
                    
                    <td class="tg-031e">
                        <input name="gaji_pokok[<?php echo $karyawan->NIK_Absen; ?>][<?php echo $times; ?>]">
                    </td>
                    <td class="tg-031e">
                        <input name="tunjangan_jabatan[<?php echo $karyawan->NIK_Absen; ?>][<?php echo $times; ?>]">
                    </td>
                    <td class="tg-031e">
                        <input name="pendapatan_intern[<?php echo $karyawan->NIK_Absen; ?>][<?php echo $times; ?>]">
                    </td>
                </tr>

                <?php } 
            }    
        }

        $times++; 

    } ?>

        <tr>
        <td class="tg-bsv2"></td>
        <td class="tg-bsv2">Total</td>
        <td class="tg-bsv2"><?php echo $total_gaji_pokok; ?></td>
        <td class="tg-bsv2"><?php echo $total_tunjangan_jabatan; ?></td>
        <td class="tg-bsv2"><?php echo $total_pendapatan_intern; ?></td>
      </tr>
      
    </table>

    <input name="proyeks_count" value="<?php echo $proyeks_count; ?>" hidden="true">

    <button id="buttonSubmit" hidden="true"></button>

</form>

<a class="small-button" id="buttonSubmitLink" href="#">Submit</a>
<a class="small-button" href="#">Edit</a>
<a class="small-button" href="<?php echo $url; ?>">Cancel</a>

<script>

  $('#buttonLinkHapus').click(function(){
        $('#buttonHapus').click();        
    });  

  $('#buttonLinkTambah').click(function(){
        $('#buttonTambah').click();        
    });  

  $('#buttonSubmitLink').click(function(){
    $('#awalField').val($('#awalField1').val());
    $('#akhirField').val($('#akhirField1').val());
    $('#buttonSubmit').click();
  });

  $('#buttonTambah').click(function(){
    $('#actionField').val('tambah');
  }); 

  $('#buttonHapus').click(function(){
    $('#actionField').val('hapus');
  });

</script>