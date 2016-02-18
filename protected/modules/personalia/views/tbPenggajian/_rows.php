<?php foreach ($karyawans as $karyawan) 
{ 
    if($karyawan->active!=0)
    { ?>

    <tr>
        <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
        <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
        <td class="tg-031e"><input name="gaji_pokok_<?php echo $karyawan->NIK_Absen; ?>"></td>
        <td class="tg-031e"><input name="tunjangan_jabatan_<?php echo $karyawan->NIK_Absen; ?>"></td>
        <td class="tg-031e"><input name="pendapatan_intern_<?php echo $karyawan->NIK_Absen; ?>"></td>
    </tr>

    <?php } 
} ?>  