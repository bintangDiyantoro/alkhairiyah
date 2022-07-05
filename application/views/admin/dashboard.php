<!-- Begin Page Content -->
<div class="container-fluid py-3 d-flex justify-content-center">

  <!-- Content Row -->
  <div class="row">
    <div class="col">
      <div class="jumbotron my-4" style="background-color: transparent;">
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
                    echo" Beristirahat ";
                  }


                  if ($staff && $staff["jenis_kelamin"]) {
                    echo ($staff["jenis_kelamin"] == "L") ? "Ustadz " : "Ustadzah ";
                  } 
                  echo $this->session->userdata('admin') ?>!
        </h1>

        <h5 class="text-center mb-5">Semoga hari ini penuh berkah</h5>

        <h2 class="text-center live-time"></h2>
      </div>
    </div>
  </div>

</div>
<!-- End of Main Content -->