<?php 

echo "<pre>";
print_r($proyek_list);
echo "</pre>";

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

<form action="input" method="post">    

<table>
    <tr>
        <td width="70px"><label><b>Periode</b></label> </td>
        <td width="315px">
            <?php echo CHtml::dateField('awal',$awal); ?>
            -
            <?php echo CHtml::dateField('akhir',$akhir); ?>
        </td>
        <td><a class="small-button" href="#" id="buttonCari">Cari</a></td>
    </tr>
</table>

<br><br>        
    
    <table>
        <tr>
            <td width="70px">Nama</td>
            <td width="500px"><?php echo CHtml::dropDownList('nama',0,$karyawan_list,array('id'=>'dropDownListNama')); ?></td>
            <td>
                <input name="proyeks_count" value="<?php echo $proyeks_count; ?>" hidden="true">
        
                <?php 
                
                $times = 1;

                foreach ($proyeks as $proyek) 
                {            
                    ?><input name="proyeks[<?php echo $times; ?>]" value="<?php echo $proyek; ?>"><?php

                    $times++;
                } ?>

                <label><b>Proyek</b></label>
                &nbsp;
                        
                <?php 
                echo CHtml::dropDownList('proyek','___',$proyek_list,array('id'=>'dropDownProyek')); 
                ?>
                <input name="action" id="actionField">        
                <input name="action" id="counterField" hidden>        

                <button id="buttonHapus" hidden="true"></button>
                <button id="buttonTambah" hidden="true"></button>

                <a class="small-button" href="#" id="buttonLinkHapus">Hapus Proyek</a>
                <a class="small-button" href="#" id="buttonLinkTambah">Tambah Proyek</a>
            </td>            
        </tr>
    </table>    

    <div class="overflow-scroll-x">

    <table class="tg">    

    <tr>
        <th class="tg-bsv2" rowspan="2"></th>
        <th class="tg-bsv2" rowspan="2">NIK</th>
        <th class="tg-bsv2" rowspan="2">Nama</th>                    
        <?php foreach ($proyeks as $proyek){
            ?><th class="tg-bsv2" colspan="3"><?php echo $proyek; ?></th><?php
        } ?>        
    </tr>    
    <tr>
        <?php foreach ($proyeks as $proyek){
            ?>
            <th class="tg-bsv2">Gaji Pokok</th>
            <th class="tg-bsv2">Tunjangan Jabatan</th>
            <th class="tg-bsv2">Pendapatan Intern</th>
            <?php
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
                    <td class="tg-031e"><input name="mark_nik" type="radio" value="<?php echo $karyawan->NIK_Absen; ?>"></td>
                    <td class="tg-031e">
                        <input name="nik_absens[<?php echo $karyawan->NIK_Absen; ?>]" value="<?php echo $karyawan->NIK_Absen; ?>" hidden>
                        <?php echo $karyawan->NIK_Absen; ?>
                    </td>
                    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>                        

                    <?php 
                        $times = 1;

                        foreach ($proyeks as $proyek){                        
                            $gaji_pokok         = '';
                            $tunjangan_jabatan  = '';
                            $pendapatan_intern  = '';

                            if(isset($isis[$karyawan->NIK_Absen][$proyek])){                                
                                $gaji_pokok         = $isis[$karyawan->NIK_Absen][$proyek]->gaji_pokok;
                                $tunjangan_jabatan  = $isis[$karyawan->NIK_Absen][$proyek]->tunjangan_jabatan;
                                $pendapatan_intern  = $isis[$karyawan->NIK_Absen][$proyek]->pendapatan_intern;
                            }                                                                                    

                            ?>
                            <td class="tg-031e">
                                <input name="gaji_pokok[<?php echo $karyawan->NIK_Absen; ?>][<?php echo $times; ?>]" value="<?php echo $gaji_pokok; ?>">
                            </td>
                            <td class="tg-031e">
                                <input name="tunjangan_jabatan[<?php echo $karyawan->NIK_Absen; ?>][<?php echo $times; ?>]" value="<?php echo $tunjangan_jabatan; ?>">
                            </td>
                            <td class="tg-031e">
                                <input name="pendapatan_intern[<?php echo $karyawan->NIK_Absen; ?>][<?php echo $times; ?>]" value="<?php echo $pendapatan_intern; ?>">
                            </td>
                            <?php
                            $times++;
                        } 
                    ?>                                       
                </tr>

                <?php } 
            }            
        }        
    }    

    ?>

        <tr>
        <td class="tg-bsv2"></td>
        <td class="tg-bsv2"></td>
        <td class="tg-bsv2">Total</td>        
        <?php foreach ($proyeks as $proyek){ ?>
            <td class="tg-bsv2"><?php echo $total_gaji_pokok; ?></td>
            <td class="tg-bsv2"><?php echo $total_tunjangan_jabatan; ?></td>
            <td class="tg-bsv2"><?php echo $total_pendapatan_intern; ?></td>        
        <?php } ?>        
        </tr>
      
    </table>

    </div>

    <br>

    <input name="jumlah_karyawan" value="<?php echo $jumlah_karyawan; ?>" hidden>

    <input name="proyeks_count" value="<?php echo $proyeks_count; ?>" hidden>

    <input name="is_save" id="is_save" hidden>

    <button id="buttonSubmit" hidden="true"></button>

<a class="small-button" id="buttonSubmitLink" href="#">Submit</a>
<a class="small-button" href="#">Edit</a>
<a class="small-button" id="buttonHapusLink" href="#">Hapus</a>
<a class="small-button" href="<?php echo $url; ?>">Cancel</a>

</form>

<?php $this->renderPartial('_proyek'); ?>

<script>

  $('#buttonLinkHapus').click(function(){
        $('#buttonHapus').click();        
    });  

  $('#buttonLinkTambah').click(function(){
        $('#buttonTambah').click();        
    });  

  $('#buttonSubmitLink').click(function(){
    $('#is_save').val('true');    
    $('#buttonSubmit').click();
  });

  $('#buttonTambah').click(function(){
    $('#actionField').val('tambah');
  }); 

  $('#buttonHapus').click(function(){
    $('#actionField').val('hapus');
  });

  $('#buttonCari').click(function(){    
    $('#actionField').val('cari');
    $('#buttonSubmit').click();
  })

  $('#buttonHapusLink').click(function(){
    $('#actionField').val('hapus_karyawan');
    $('#buttonSubmit').click();
  });

  $('#dropDownListNama').change(function(){
    $('#buttonSubmit').click();
  });

  $('#dropDownProyek').change(function(){
    if($(this).val()=='add'){
        $('#proyekDiv').fadeToggle('fast');  
        $(this).val($('#counterField').val());
    }
    else{
        $('#counterField').val($(this).val());
    }
    
    // alert($(this).val());
  });

  $('#closeProyek').click(function(){
    $('#proyekDiv').fadeToggle('fast');    
  });

  $('#buttonProyek').click(function(){
    url     = $('#urlTambah').val();
    name    = $('#nameInput').val();
    wage    = $('#wageInput').val();

    $.post(url,{name:name,wage:wage},function(json){
        // alert(json);

        var result = JSON.parse(json);              
        
        $('#errorCell').text(result.error);

        if(result.error==''){
            $('#dropDownProyek option[value="add"]').before('<option value="'+result.name+'">'+result.name+'</option>');
            $('#nameInput').val('');
            $('#wageInput').val('');
            $('#closeProyek').click();      
        }
    });

    // window.location.href = url;
});

</script>