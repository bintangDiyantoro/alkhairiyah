<!-- Begin Page Content -->
<div class="container-fluid py-3 d-flex justify-content-center">

  <!-- Content Row -->
  <div class="row">
    <div class="col">
      <div class="jumbotron">
        <h1 class="text-center">
          Selamat Datang <?= $this->session->userdata('admin') ?>!
        </h1>
        <?php
        $hour = (int)date('H');
        $day = (int)date('d');

        if ($hour <= 16) {
          $hour += 7;
        } else {
          $hour -= 17;
          $day++;
        }

        ?>
        <h2>
          <?= $day . date('-m-Y') . " " . $hour . date(':i:s') ?></h2>
      </div>
    </div>
  </div>

</div>
<!-- End of Main Content -->