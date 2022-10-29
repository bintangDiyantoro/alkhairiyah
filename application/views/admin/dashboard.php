<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center">

  <!-- Content Row -->
  <div class="row">
    <div class="col">
      <div class="jumbotron my-2" style="background-color: transparent;">
        <h1 class="text-center mt-3 mx-5">
          Selamat <?php
                  $hour = (int)date('H');
                  $day = (int)date('d');

                  if ($hour <= 16) {
                    $hour += 7;
                  } else {
                    $hour -= 17;
                    $day++;
                  }

                  if ($hour >= 5 && $hour < 11) {
                    echo " Pagi ";
                  } elseif ($hour >= 11 && $hour < 15) {
                    echo " Siang ";
                  } elseif ($hour >= 15 && $hour < 18) {
                    echo " Sore ";
                  } elseif ($hour >= 18) {
                    echo " Malam ";
                  } else {
                    echo " Beristirahat ";
                  }


                  if ($staff && $staff["jenis_kelamin"]) {
                    echo ($staff["jenis_kelamin"] == "L") ? "Ustadz " : "Ustadzah ";
                  }
                  echo $this->session->userdata('admin') ?>!
        </h1>

        <h5 class="text-center mb-5">Semoga hari ini penuh berkah</h5>

        <h2 class="text-center live-time mb-5">
          <img src="<?= base_url('assets/img/greenloading.gif') ?>" height="126.5">
        </h2>
        <div class="d-flex justify-content-center mb-5">
          <button type="button" class="btn btn-success px-5" data-toggle="modal" data-target="#ModalForHadith" style="border-radius: 50px;">
            Baca Hadits Nabi
          </button>
        </div>
        <h5 class="text-center"><strong>Humor Receh:</strong></h5>
        <div class="text-center" style="font-size: 18px;"><i><?= $jokes ?></i></div>
      </div>
    </div>
  </div>
</div>

</div>
<!-- End of Main Content -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="ModalForHadith" tabindex="-1" role="dialog" aria-labelledby="ModalForHadithTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title px-3" id="ModalForHadithTitle"><strong>Hadits Nabi</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-right p-3" style="font-size: 18px;font-family: 'Amiri';line-height: 2;"><strong><?= $hadits["arab"] ?></strong></div><br>
        <div class="p-3" style="font-size: 15px;"><i><?= $hadits["id"] ?><br><br><strong><?= "HR. " . $hadits["name"] . " No. " . $hadits["number"] ?></i></strong></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>