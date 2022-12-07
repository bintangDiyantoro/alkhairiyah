<div class="container">
    <h3>B. Pengetahuan dan Keterampilan</h3>
    <table class="pengket">
        <thead>
            <tr>
                <th colspan="2">Kelas</th>
                <?php for ($i = 1; $i <= 6; $i++) :
                    $j = 1;
                    foreach ($kelas_siswa as $ks) :
                        if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) : ?>
                            <th colspan="4">Kelas <?= $ks["class"] ?></th>
                            <?php break;
                        else :
                            if (count($kelas_siswa) == $j) : ?>
                                <th colspan="4">Kelas ....</th>
                <?php else :
                                $j++;
                            endif;
                        endif;
                    endforeach;
                endfor ?>
            </tr>
            <tr>
                <th colspan="2">Tahun Pelajaran</th>
                <?php for ($i = 1; $i <= 6; $i++) :
                    $j = 1;
                    foreach ($kelas_siswa as $ks) :
                        if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) : ?>
                            <td colspan="4" style="text-align: center;"><?= explode('/', $ks["tahun"])[0] . "/" . (int)explode('/', $ks["tahun"])[0] + 1 ?></td>
                            <?php break;
                        else :
                            if (count($kelas_siswa) == $j) : ?>
                                <th colspan="4">..../....</th>
                <?php else :
                                $j++;
                            endif;
                        endif;
                    endforeach;
                endfor ?>
            </tr>
            <tr>
                <th colspan="2">Semester</th>
                <?php for ($i = 1; $i <= 6; $i++) : ?>
                    <th colspan="2">S1</th>
                    <th colspan="2">S2</th>
                <?php endfor ?>
            </tr>
            <tr>
                <th colspan="2">KKM Satuan Pendidikan</th>
                <?php for ($i = 1; $i <= 6; $i++) :
                    if ($kkm) :
                        $j = 1;
                        $l = 1;
                        foreach ($kkm as $k) :
                            if ((int)$k["id_kelas"] >= $i * 4 - 3 && (int)$k["id_kelas"] <= $i * 4 && $k["id_semester"] == "1") : ?>
                                <td style="text-align: center;" colspan="2"><?= $k["kkm"] ?></td>
                                <?php break;
                            else :
                                if (count($kkm) == $j) : ?>
                                    <td style="text-align: center;" colspan="2"></td>
                                <?php else :
                                    $j++;
                                endif;
                            endif;
                        endforeach;
                        $l = 1;
                        foreach ($kkm as $k) :
                            if ((int)$k["id_kelas"] >= $i * 4 - 3 && (int)$k["id_kelas"] <= $i * 4 && $k["id_semester"] == "2") : ?>
                                <td style="text-align: center;" colspan="2"><?= $k["kkm"] ?></td>
                                <?php break;
                            else :
                                if (count($kkm) == $l) : ?>
                                    <td style="text-align: center;" colspan="2"></td>
                        <?php else :
                                    $l++;
                                endif;
                            endif;
                        endforeach;
                        ?>
                    <?php else : ?>
                        <td style="text-align: center;" colspan="2"></td>
                        <td style="text-align: center;" colspan="2"></td>
                    <?php endif; ?>
                <?php endfor ?>
            </tr>
            <tr>
                <th colspan="2">Muatan Pelajaran</th>
                <?php for ($i = 1; $i <= 12; $i++) : ?>
                    <th>KI3</th>
                    <th>KI4</th>
                <?php endfor ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($muatan_pelajaran as $mp) : ?>
                <tr>
                    <td style="text-align:center"><?= $i ?></td>
                    <td><?= $mp["muatan_pelajaran"] ?></td>
                    <?php for ($j = 1; $j <= 6; $j++) : ?>
                        <?php if ($nilai_mapel) : ?>
                            <?php
                            $k = 1;
                            $l = 1;
                            $m = 1;
                            $n = 1;
                            foreach ($nilai_mapel as $nm) :
                                if ($mp["id"] == $nm["id_mapel_induk"] && (int)$nm["id_kelas"] >= $j * 4 - 3 && (int)$nm["id_kelas"] <= $j * 4 && $nm["id_semester"] == "1" && $nm["id_kompetensi_inti"] == "1") : ?>
                                    <td style="text-align: center;"><?= $nm["nilai"] ?></td>
                                    <?php break;
                                else :
                                    if ($k == count($nilai_mapel)) : ?>
                                        <td></td>
                                    <?php else :
                                        $k++;
                                    endif;
                                endif;
                            endforeach;
                            foreach ($nilai_mapel as $nm) :
                                if ($mp["id"] == $nm["id_mapel_induk"] && (int)$nm["id_kelas"] >= $j * 4 - 3 && (int)$nm["id_kelas"] <= $j * 4 && $nm["id_semester"] == "1" && $nm["id_kompetensi_inti"] == "2") : ?>
                                    <td style="text-align: center;"><?= $nm["nilai"] ?></td>
                                    <?php break;
                                else :
                                    if ($l == count($nilai_mapel)) : ?>
                                        <td></td>
                                    <?php else :
                                        $l++;
                                    endif;
                                endif;
                            endforeach;
                            foreach ($nilai_mapel as $nm) :
                                if ($mp["id"] == $nm["id_mapel_induk"] && (int)$nm["id_kelas"] >= $j * 4 - 3 && (int)$nm["id_kelas"] <= $j * 4 && $nm["id_semester"] == "2" && $nm["id_kompetensi_inti"] == "1") : ?>
                                    <td style="text-align: center;"><?= $nm["nilai"] ?></td>
                                    <?php break;
                                else :
                                    if ($m == count($nilai_mapel)) : ?>
                                        <td></td>
                                    <?php else :
                                        $m++;
                                    endif;
                                endif;
                            endforeach;
                            foreach ($nilai_mapel as $nm) :
                                if ($mp["id"] == $nm["id_mapel_induk"] && (int)$nm["id_kelas"] >= $j * 4 - 3 && (int)$nm["id_kelas"] <= $j * 4 && $nm["id_semester"] == "2" && $nm["id_kompetensi_inti"] == "2") : ?>
                                    <td style="text-align: center;"><?= $nm["nilai"] ?></td>
                                    <?php break;
                                else :
                                    if ($n == count($nilai_mapel)) : ?>
                                        <td></td>
                            <?php else :
                                        $n++;
                                    endif;
                                endif;
                            endforeach;
                        else : ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    <?php endif;
                    endfor ?>
                </tr>
            <?php $i++;
            endforeach ?>
        </tbody>
    </table>
    <h3>C. Ekstrakurikuler</h3>
    <table class="ekskul">
        <thead>
            <tr>
                <th rowspan="2">Semester</th>
                <th rowspan="2">Jenis Ekstrakurikuler</th>
                <?php for ($i = 1; $i <= 6; $i++) :
                    $j = 1;
                    foreach ($kelas_siswa as $ks) :
                        if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) : ?>
                            <th>Kelas <?= $ks["class"] ?></th>
                            <?php break;
                        else :
                            if ($j == count($kelas_siswa)) : ?>
                                <th>Kelas ....</th>
                <?php else :
                                $j++;
                            endif;
                        endif;
                    endforeach;
                endfor; ?>
            </tr>
            <tr>
                <?php for ($i = 1; $i <= 6; $i++) :
                    $j = 1;
                    foreach ($kelas_siswa as $ks) : ?>
                        <?php if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) : ?>
                            <td style="text-align:center"><?= explode('/', $ks["tahun"])[0] . "/" . (int)explode('/', $ks["tahun"])[0] + 1 ?></td>
                        <?php break;
                        else : ?>
                            <?php if ($j == count($kelas_siswa)) : ?>
                                <th>..../....</th>
                    <?php else :
                                $j++;
                            endif;
                        endif;
                    endforeach; ?>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($smt = 1; $smt <= 2; $smt++) :
                $smtRom = ($smt == 1) ? 'I' : 'II';
                if ($nilai_ekskul) :
                    $neThisSmt = [];
                    foreach ($nilai_ekskul as $ne) {
                        if ((int)$ne["id_semester"] == $smt) {
                            if (!in_array($ne["id_ekskul"], $neThisSmt)) {
                                $neThisSmt[] = $ne["id_ekskul"];
                            }
                        }
                    }
                    if ($neThisSmt) :
                        $itter = 1;
                        foreach ($neThisSmt as $nts) :
                            if ($itter <= 3) :
                                foreach ($nilai_ekskul as $ne) :
                                    if ($ne["id_ekskul"] == $nts) : ?>
                                        <tr>
                                            <?= ($itter == 1) ? '<th rowspan="3">Semester ' . $smtRom . '</th>' : '' ?>
                                            <td style="text-align: left;"><?= $itter ?>. <?= $ne["ekskul"] ?></td>
                                            <?php for ($i = 1; $i <= 6; $i++) :
                                                $k = 1;
                                                foreach ($nilai_ekskul as $ne2) :
                                                    if ($ne2["nilai"] && (int)$ne2["id_kelas"] >= $i * 4 - 3 && (int)$ne2["id_kelas"] <= $i * 4 && (int)$ne2["id_semester"] == $smt && $ne2["id_ekskul"] == $ne["id_ekskul"]) : ?>
                                                        <td style="text-align: center;"><?= $ne2["nilai"] ?></td>
                                                        <?php break;
                                                    else :
                                                        if ($k == count($nilai_ekskul)) : ?>
                                                            <td></td>
                                            <?php else :
                                                            $k++;
                                                        endif;
                                                    endif;
                                                endforeach;
                                            endfor; ?>
                                        </tr>
                                <?php break;
                                    endif;
                                endforeach;
                                $itter++;
                            endif;
                        endforeach;
                        if ($itter <= 3) :
                            for ($j = 1; $j <= (4 - $itter); $j++) : ?>
                                <tr>
                                    <?= ($itter == 1) ? '<th rowspan="3">Semester ' . $smtRom . '</th>' : '' ?>
                                    <td style="text-align: left;"><?= $j + $itter - 1 ?>. </td>
                                    <?php for ($i = 1; $i <= 6; $i++) : ?>
                                        <td></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor;
                        endif;
                    else :
                        for ($itter = 1; $itter <= 3; $itter++) : ?>
                            <tr>
                                <?= ($itter == 1) ? '<th rowspan="3">Semester ' . $smtRom . '</th>' : '' ?>
                                <td style="text-align: left;"><?= $itter ?>. </td>
                                <?php for ($i = 1; $i <= 6; $i++) : ?>
                                    <td></td>
                                <?php endfor; ?>
                            </tr>
                        <?php endfor;
                    endif;
                else :
                    for ($itter = 1; $itter <= 3; $itter++) : ?>
                        <tr>
                            <?= ($itter == 1) ? '<th rowspan="3">Semester ' . $smtRom . '</th>' : '' ?>
                            <td style="text-align: left;"><?= $itter ?>. </td>
                            <?php for ($i = 1; $i <= 6; $i++) : ?>
                                <td></td>
                            <?php endfor; ?>
                        </tr>
            <?php endfor;
                endif;
            endfor; ?>
        </tbody>
    </table>
    <h3>D. Ketidakhadiran</h3>
    <table class="absensi">
        <thead>
            <tr>
                <th>Kelas</th>
                <?php for ($i = 1; $i <= 6; $i++) :
                    $j = 1;
                    foreach ($kelas_siswa as $ks) :
                        if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) : ?>
                            <th colspan="2">Kelas <?= $ks["class"] ?></th>
                            <?php break;
                        else :
                            if ($j == count($kelas_siswa)) : ?>
                                <th colspan="2">Kelas ....</th>
                <?php else : $j++;
                            endif;
                        endif;
                    endforeach;
                endfor; ?>
            </tr>
            <tr>
                <th>Tahun Pelajaran</th>
                <?php for ($i = 1; $i <= 6; $i++) : ?>
                    <?php $j = 1;
                    foreach ($kelas_siswa as $ks) : ?>
                        <?php if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) : ?>
                            <td style="text-align: center;" colspan="2"><?= explode('/', $ks["tahun"])[0] . '/' . (int)explode('/', $ks["tahun"])[0] + 1 ?></td>
                        <?php break;
                        else : ?>
                            <?php if ($j == count($kelas_siswa)) : ?>
                                <th colspan="2">..../....</th>
                        <?php else : $j++;
                            endif;
                        endif; ?>
                    <?php endforeach; ?>
                <?php endfor ?>
            </tr>
            <tr>
                <th>Semester</th>
                <?php for ($i = 1; $i <= 6; $i++) : ?>
                    <th>S1</th>
                    <th>S2</th>
                <?php endfor ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ketidakhadiran as $kt) : ?>
                <tr>
                    <th><?= $kt["ketidakhadiran"] ?></th>
                    <?php for ($i = 1; $i <= 6; $i++) :
                        if ($jumlah_absensi) :
                            $j = 1;
                            foreach ($jumlah_absensi as $ja) :
                                if ((int)$ja["id_kelas"] >= $i * 4 - 3 && (int)$ja["id_kelas"] <= $i * 4 && $ja["id_ketidakhadiran"] == $kt["id"] && $ja["id_semester"] == "1") : ?>
                                    <td style="text-align: center;"><?= $ja["jumlah"] ?></td>
                                    <?php break;
                                else :
                                    if ($j == count($jumlah_absensi)) : ?>
                                        <td></td>
                            <?php else :
                                        $j++;
                                    endif;
                                endif;
                            endforeach;
                        else : ?>
                            <td></td>
                            <td></td>
                            <?php endif;
                        $k = 1;
                        foreach ($jumlah_absensi as $ja) :
                            if ((int)$ja["id_kelas"] >= $i * 4 - 3 && (int)$ja["id_kelas"] <= $i * 4 && $ja["id_ketidakhadiran"] == $kt["id"] && $ja["id_semester"] == "2") : ?>
                                <td style="text-align: center;"><?= $ja["jumlah"] ?></td>
                                <?php break;
                            else :
                                if ($k == count($jumlah_absensi)) : ?>
                                    <td></td>
                    <?php else :
                                    $k++;
                                endif;
                            endif;
                        endforeach;
                    endfor ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3>E. Keterangan</h3>
    <table class="naiklulus">
        <tbody>
            <tr>
                <th>Keterangan</th>
                <?php for ($i = 2; $i <= 6; $i++) :
                    $j = 1;
                    foreach ($kelas_siswa as $ks) :
                        if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) : ?>
                            <td>Naik/<strike>Tidak Naik</strike></td>
                            <?php break;
                        else :
                            if ($j == count($kelas_siswa)) : ?>
                                <td>Naik/Tidak Naik</td>
                <?php else : $j++;
                            endif;
                        endif;
                    endforeach;
                endfor; ?>
                <?= cekKelulusan($kelas_siswa) ?>
            </tr>
        </tbody>
    </table>
    <p>Catatan: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; S1 = Semester I&emsp;&emsp;&emsp;&ensp;&nbsp; S2 = Semester II&emsp;&emsp;&emsp;&ensp;KI3 = Kompetensi Inti 3 (Pengetahuan)&emsp;&emsp;&emsp;&emsp;&ensp;KI4 = Kompetensi Inti 4 (Keterampilan)</p>
</div>