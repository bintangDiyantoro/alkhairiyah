<p style="text-align:center;font-size:24px">SD Islam Al-Khairiyah Banyuwangi</p>
<p style="text-align:center;font-size:24px">(* DATA SPP *)</p>
<p style="text-align:center;font-size:16px">Tahun Pelajaran <?= $tahunpelajaran ?></p>
<p>Kelas: <?= $kelas["class"] ?></p>
<table style="border: 1px solid black;">
    <thead>
        <tr>
            <td>No.</td>
            <td>Nama Siswa</td>
            <?php foreach ($bulan_akademik as $ba) : ?>
                <td style="font-size: 12px;" text-rotate="90">Tanggal</td>
                <td text-rotate="90"><?= $ba["nama_bulan"] ?></td>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 1;
        foreach ($siswa as $s) : ?>
            <tr>
                <td><?= $counter ?></td>
                <td <?= ($s["status_spp"] == "3") ? 'style="text-align:left;color:red"' : 'style="text-align:left"' ?>>
                    <?= $s["nama"] ?>
                </td>
                <?php foreach ($bulan_akademik as $ba) : ?>
                    <?php if ($s["status_spp"] == '3') : ?>
                        <td colspan="24" style="color: red"><?= ket_status_spp_siswa_cetak($s["id_siswa"]) ?></td>
                    <?php break;
                    else : ?>
                        <?php $i = 1;
                        foreach ($spp as $sp) : ?>
                            <?php if ($sp["id_siswa"] == $s["id_siswa"] && $sp["bulan"] == $ba["id"]) : ?>
                                <td style="width: 40px;">
                                    <?= (int)explode('-', $sp["tanggal"])[0] . "/" . (int)explode('-', $sp["tanggal"])[1] ?>
                                </td>
                                <td style="width: 67px;"><?= ($sp["nominal"] == '0') ? 'Gratis' : number_format($sp["nominal"], 0, ',', '.') ?></td>
                            <?php break;
                            else : ?>
                                <?php if (count($spp) == $i) : ?>
                                    <td style="width: 40px;"></td>
                                    <td style="width: 67px;"></td>
                                <?php else : $i++; ?>
                                <?php endif ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php endforeach ?>
            </tr>
        <?php $counter++;
        endforeach ?>
    </tbody>
</table>