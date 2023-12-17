<hr><h3 align="center"><b>PAKET KAMI</b></h3><hr>
<div class="row">
  <?php foreach($paket_new as $paket){ ?>
    <div class="col-lg-4">
      <div class="thumbnail">
        <?php
        if(empty($paket->foto)) {echo "<img class='card-img-top' src='".base_url()."assets/images/no_image_thumb.png'>";}
        else { echo "<img src='".base_url()."assets/images/paket/".$paket->foto."'> ";}
        ?>
        <div class="caption">
          <p class="card-text"><b><?php echo $paket->nama_paket ?></b></p>
          <hr>
          <a href="<?php echo base_url('cart/buy/').$paket->id_paket ?>">
            <button class="btn btn-sm btn-primary"><i class="fa fa-shopping-cart"></i> Booking Sekarang!</button>
          </a>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
