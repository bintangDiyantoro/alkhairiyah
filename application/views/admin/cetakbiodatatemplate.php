<h3 class="page-title">IDENTITAS PESERTA DIDIK</h3>
<ol style="list-style: upper-alpha;">
    <li>
        <h4>
            KETERANGAN MURID
            <div style="width:31%;float:left">
                <ol class="labels">
                    <li>NOMOR INDUK</li>
                    <li>NISN</li>
                    <li>Nama Peserta Didik</li>
                    <li>Tempat, Tanggal Lahir</li>
                    <li>Jenis Kelamin</li>
                    <li>Agama</li>
                    <li>Pendidikan Sebelumnya</li>
                    <li>Alamat Peserta Didik</li>
                </ol>
            </div>
            <div style="padding-left:-40px;float:right;width:75%;">
                <div style="width:70%;float:left">
                    <ul class="labels" style="list-style: none;">
                        <li>: <?= $biodata["nomor_induk"] ?></li>
                        <li>: <?= $biodata["nisn"] ?></li>
                        <li>: <?= $biodata["nama"] ?></li>
                        <li>: <?= $biodata["ttl"] ?></li>
                        <li>: <?= ($biodata["jenis_kelamin"] == "L") ? "Laki-Laki" : "Perempuan" ?></li>
                        <li>: <?= $biodata["agama"] ?></li>
                        <li>: <?= $biodata["pendidikan_sebelumnya"] ?></li>
                        <li>: <?= $biodata["alamat"] ?></li>
                    </ul>
                </div>
                <div class="foto">
                    <p>
                        FOTO (3x4)
                    </p>
                </div>
            </div>
        </h4>
    </li>
    <li>
        <h4>
            KETERANGAN ORANG TUA / WALI MURID
        </h4>
        <div>
            <div style="width:82%;float:left">
                <ol class="labels">
                    <li>
                        Nama Orang Tua
                        <div style="width:155px;float:left">
                            <ol style="list-style: lower-alpha;">
                                <li>Ayah</li>
                                <li>Ibu</li>
                            </ol>
                        </div>
                        <div style="width:77%;float:right;padding-left:-40px">
                            <ol style="list-style: none;">
                                <li>: <?= $biodata["nama_ayah"] ?></li>
                                <li>: <?= $biodata["nama_ibu"] ?></li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        Pekerjaan Orang Tua
                        <div style="width:155px;float:left">
                            <ol style="list-style: lower-alpha;">
                                <li>Ayah</li>
                                <li>Ibu</li>
                            </ol>
                        </div>
                        <div style="width:77%;float:right;padding-left:-40px">
                            <ol style="list-style: none;">
                                <li>: <?= $biodata["pekerjaan_ayah"] ?></li>
                                <li>: <?= $biodata["pekerjaan_ibu"] ?></li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        Alamat Orang Tua
                        <div style="width:155px;float:left">
                            <ol style="list-style: lower-alpha;">
                                <li>Jalan</li>
                                <li>Kelurahan/Desa</li>
                                <li>Kecamatan</li>
                                <li>Kabupaten/Kota</li>
                                <li>Propinsi</li>
                            </ol>
                        </div>
                        <div style="width:77%;float:right;padding-left:-40px">
                            <ol style="list-style: none;">
                                <li>: <?= $biodata["alamat_ortu"] ?></li>
                                <li>: <?= $biodata["kelurahan_ortu"] ?></li>
                                <li>: <?= $biodata["kecamatan_ortu"] ?></li>
                                <li>: <?= ($biodata["kabupaten_ortu"]) ? str_ireplace("KABUPATEN ", "", $biodata["kabupaten_ortu"]) : '' ?></li>
                                <li>: <?= $biodata["provinsi_ortu"] ?></li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        Wali Peserta Didik
                        <div style="width:155px;float:left">
                            <ol style="list-style: lower-alpha;">
                                <li>Nama</li>
                                <li>Pekerjaan</li>
                            </ol>
                        </div>
                        <div style="width:77%;float:right;padding-left:-40px">
                            <ol style="list-style: none;">
                                <li>: <?= $biodata["nama_wali"] ?></li>
                                <li>: <?= $biodata["pekerjaan_wali"] ?></li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        Alamat Wali Peserta Didik
                        <div style="width: 155px;float:left;">
                            <ol style="list-style: lower-alpha;">
                                <li>Jalan</li>
                                <li>Kelurahan/Desa</li>
                                <li>Kecamatan</li>
                                <li>Kabupaten/Kota</li>
                                <li>Propinsi</li>
                            </ol>
                        </div>
                        <div style="width: 77%;float:right;padding-left:-40px;">
                            <ol style="list-style: none;">
                                <li>: <?= $biodata["alamat_wali"] ?></li>
                                <li>: <?= $biodata["kelurahan_wali"] ?></li>
                                <li>: <?= $biodata["kecamatan_wali"] ?></li>
                                <li>: <?= ($biodata["kabupaten_wali"]) ? str_ireplace("KABUPATEN ", "", $biodata["kabupaten_wali"]) : "" ?></li>
                                <li>: <?= $biodata["provinsi_wali"] ?></li>
                            </ol>
                        </div>
                    </li>
                </ol>
            </div>
            <div style="float:right;height:45%">
                <div class="foto1">
                    <p>
                        FOTO (3x4)
                    </p>
                </div>
                <div class="foto2">
                    <p>
                        FOTO (3x4)
                    </p>
                </div>
            </div>
        </div>
    </li>
</ol>