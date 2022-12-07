<div class="container">
    <h2>A. SIKAP</h2>
    <table>
        <thead>
            <tr>
                <td rowspan="2">Semester</td>
                <td>Kelas</td>
                <?php for ($i = 1; $i <= 6; $i++) :
                    $j = 1;
                    foreach ($kelas_siswa as $ks) :
                        if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) : ?>
                            <td>Kelas <?= $ks["class"] ?></td>
                            <?php break;
                        else :
                            if (count($kelas_siswa) == $j) : ?>
                                <td>Kelas ....</td>
                <?php else :
                                $j++;
                            endif;
                        endif;
                    endforeach;
                endfor ?>
            </tr>
            <tr>
                <td>Tahun Pelajaran</td>
                <?php for ($i = 1; $i <= 6; $i++) : ?>
                    <?php
                    $j = 1;
                    foreach ($kelas_siswa as $ks) :
                        if ((int)$ks["id_kelas"] >= $i * 4 - 3 && (int)$ks["id_kelas"] <= $i * 4) : ?>
                            <td><?= explode('/', $ks["tahun"])[0] . "/" . (int)explode('/', $ks["tahun"])[0] + 1 ?></td>
                        <?php break;
                        else : ?>
                            <?php if (count($kelas_siswa) == $j) : ?>
                                <td>..../....</td>
                <?php else :
                                $j++;
                            endif;
                        endif;
                    endforeach;
                endfor ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">Semester I</td>
                <td>Sikap Spiritual</td>
                <?php for ($i = 1; $i <= 6; $i++) :
                    if ($nilai_sikap) :
                        $j = 1;
                        foreach ($nilai_sikap as $ns) :
                            if ((int)$ns["id_kelas"] >= $i * 4 - 3 && (int)$ns["id_kelas"] <= $i * 4 && $ns["id_semester"] == "1" && $ns["id_sikap"] == "1") : ?>
                                <td><?= $ns["nilai"] ?></td>
                                <?php else :
                                if (count($nilai_sikap) == $j) : ?>
                                    <td></td>
                <?php else :
                                    $j++;
                                endif;
                            endif;
                        endforeach;
                    else :
                        echo "<td></td>";
                    endif;
                endfor ?>
            </tr>
            <tr>
                <td>Sikap Sosial</td>
                <?php for ($i = 1; $i <= 6; $i++) :
                    if ($nilai_sikap) :
                        $j = 1;
                        foreach ($nilai_sikap as $ns) :
                            if ((int)$ns["id_kelas"] >= $i * 4 - 3 && (int)$ns["id_kelas"] <= $i * 4 && $ns["id_semester"] == "1" && $ns["id_sikap"] == "2") : ?>
                                <td><?= $ns["nilai"] ?></td>
                                <?php else :
                                if (count($nilai_sikap) == $j) : ?>
                                    <td></td>
                <?php else :
                                    $j++;
                                endif;
                            endif;
                        endforeach;
                    else :
                        echo "<td></td>";
                    endif;
                endfor ?>
            </tr>
            <tr>
                <td rowspan="2">Semester II</td>
                <td>Sikap Spiritual</td>
                <?php for ($i = 1; $i <= 6; $i++) :
                    if ($nilai_sikap) :
                        $j = 1;
                        foreach ($nilai_sikap as $ns) :
                            if ((int)$ns["id_kelas"] >= $i * 4 - 3 && (int)$ns["id_kelas"] <= $i * 4 && $ns["id_semester"] == "2" && $ns["id_sikap"] == "1") : ?>
                                <td><?= $ns["nilai"] ?></td>
                                <?php else :
                                if (count($nilai_sikap) == $j) : ?>
                                    <td></td>
                <?php else :
                                    $j++;
                                endif;
                            endif;
                        endforeach;
                    else :
                        echo "<td></td>";
                    endif;
                endfor ?>
            </tr>
            <tr>
                <td>Sikap Sosial</td>
                <?php for ($i = 1; $i <= 6; $i++) :
                    if ($nilai_sikap) :
                        $j = 1;
                        foreach ($nilai_sikap as $ns) :
                            if ((int)$ns["id_kelas"] >= $i * 4 - 3 && (int)$ns["id_kelas"] <= $i * 4 && $ns["id_semester"] == "2" && $ns["id_sikap"] == "2") : ?>
                                <td><?= $ns["nilai"] ?></td>
                                <?php else :
                                if (count($nilai_sikap) == $j) : ?>
                                    <td></td>
                <?php else :
                                    $j++;
                                endif;
                            endif;
                        endforeach;
                    else :
                        echo "<td></td>";
                    endif;
                endfor ?>
            </tr>
        </tbody>
    </table>
</div>