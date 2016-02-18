<?php

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(

	'Personalia'	=> array('/site/personalia'),
	'Gaji dan Upah'	=> array('/site/gaji'),
	'Gaji Bulanan' 	=> array('/site/bulanan'),
    'Pilih Proyek'  => array($url),

	$breadcrumb
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$action = Yii::app()->createUrl('personalia/TbPenggajian/rekapitulasi');
$total  = 0;

?>

<form action="<?php echo $action; ?>" method="post">

<input name="edit" hidden="true" id="editField">
<input name="proyek" hidden="true" value="<?php echo $proyek; ?>">
<input name="action2" hidden="true" value="<?php echo $action2; ?>">

<table>
  <tr>
  
    <td width="50px"><label>Bank</label></td>
    <?php 
    if($karyawans!='' and $edit==''){
        ?>  
        <td><?php echo $bank; ?></td>
        <input name="bank" value="<?php echo $bank; ?>" hidden="true">
        <?php
    }    
    else{
        ?><td><?php echo CHtml::dropDownList('bank',$bank,array('BCA'=>'BCA','BTN'=>'BTN')); ?></td><?php   
    }
    ?>    
  
  </tr>
  <tr>
   
    <td><label>Periode</label></td>
    <?php   
    if($karyawans!='' and $edit==''){
        ?>  
        <td><?php echo Yii::app()->date_ina->getDate(strtotime($awal)).' s/d '.Yii::app()->date_ina->getDate(strtotime($akhir)); ?></td>
        <input name="awal" type="date" value="<?php echo $awal; ?>" hidden="true">
        <input name="akhir" type="date" value="<?php echo $akhir; ?>" hidden="true">
        <?php
    }    
    else{
        ?>
        <td>
            <input name="awal" type="date" value="<?php echo $awal; ?>"> - <input name="akhir" type="date" value="<?php echo $akhir; ?>">
        </td>
        <?php   
    }

    ?>    
  
  </tr>
</table>

<table class="tg">
  <tr>    

    <?php 

    if($action2=='payroll')
    {
    ?>

    <th class="tg-bsv2">No</th>

    <?php
    }

    ?>

    <th class="tg-bsv2">NIK</th>
    <th class="tg-bsv2">Nama</th>    
    <th class="tg-bsv2">Nomor Account</th>
    <th class="tg-bsv2">Nama Account</th>
    <th class="tg-bsv2">Jumlah</th>
  </tr>  
  
  <?php 
    $i = 0;

    if(is_array($karyawans))
    {        

    foreach ($karyawans as $karyawan) 
    {
    ?>

    <tr>    
        <?php 

        $i++;

        if($action2=='payroll')
        {
        ?>

        <td class="tg-031e"><?php echo $i; ?></td>

        <?php
        }

        ?>

        <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
        <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
        <td class="tg-031e"><?php echo $karyawan->No_Rek; ?></td>
        <td class="tg-031e"><?php echo $karyawan->Nama_Rek; ?></td>
        
        <td class="tg-031e">
            <?php 
                $total_gaji = $karyawan->getTotalPenggajian($proyek,$awal,$akhir);
                $total      = $total + $total_gaji;

                echo 'Rp '.number_format($total_gaji,2,",",".");
            ?>
        </td>
    </tr>    

    <?php
    }
    
    }
    else
    {
    ?>

    <tr>    
        <?php 

        $i++;

        if($action2=='payroll')
        {
        ?>

        <td class="tg-031e">-</td>

        <?php
        }

        ?>

        <td class="tg-031e">-</td>
        <td class="tg-031e">-</td>
        <td class="tg-031e">-</td>
        <td class="tg-031e">-</td>
        <td class="tg-031e">-</td>    
    </tr>

    <?php
    }
  ?>

  <tr>    
    <?php    

    if($action2=='payroll'){
        $colspan = 5;
    }else
        $colspan = 4;

    ?>

    <th class="tg-bsv2" colspan="<?php echo $colspan; ?>">Total</th>
    <th class="tg-bsv2"><?php echo 'Rp '.number_format($total,2,",","."); ?></th>
  </tr>
</table>

<button id="submitButton" hidden="true"></button>

</form>

<br>

<?php 

if($action2=='payroll')
{
?>

<div class="span-10" align="center">
  <pre>
    Bandung, <span><?php echo Yii::app()->date_ina->now; ?></span>
    PT. Sanggar Indah Group


    Kiki Abdulloh
  </pre>
</div>

<div class="span-11" align="center">
  <pre>
    Penerima
    Bank Bca


    Kiki Abdulloh
  </pre>
</div>

<?php
}
else
{ ?>

    <div class="span-11 float_right" align="center">
      <pre>
        Bandung, <?php echo Yii::app()->date_ina->now; ?> 


        <?php echo Yii::app()->user->name; ?>
      </pre>
    </div>

<?php

} ?>

<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>

<?php 
if($karyawans!='' and $edit==''){
    ?>
    <a class="small-button" href="#">Print</a>
    <a class="small-button" href="#" id="buttonLinkEdit">Edit</a>
    <?php
}
else{
    ?><a class="small-button" href="#" id="buttonLinkSubmit">Submit</a><?php
}
?>

<a class="small-button" href="<?php echo $url2; ?>">Cancel</a>

<script>

$('#buttonLinkSubmit').click(function(){  
  $('#submitButton').click();
});

$('#buttonLinkEdit').click(function(){  
  $('#editField').val('true');
  $('#submitButton').click();
});

</script>