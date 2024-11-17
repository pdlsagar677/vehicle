<?php require('includes/header.php') ?>
<?php require('includes/navbar.php') ?>

</div>
<!-- gallery section start -->
<div class="gallery_section layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="gallery_taital">Our best offers</h1>
         </div>
      </div>
      <div class="gallery_section_2">
         <div class="row">
             <?php
             $vehicles = $connection->query("SELECT * FROM vehicles");
             $vehicles = mysqli_fetch_all($vehicles, MYSQLI_ASSOC);
             foreach ($vehicles as $vehicle):
                 if ($vehicle['is_available']):
                     ?>
                     <div class="col-md-4">
                         <div class="gallery_box">
                             <div class="gallery_img"><img src="uploads/<?= $vehicle['image'] ?>"></div>
                             <h3 class="types_text"><?= $vehicle['name'] ?></h3>
                             <p class="looking_text">Start per hour Rs. <?= $vehicle['price_per_hour'] ?></p>
                             <div class="read_bt"><a href="vehicle-detail.php?id=<?= $vehicle['id'] ?>">Book Now</a>
                             </div>
                         </div>
                     </div>
                 <?php
                 endif;
             endforeach;
             ?>
         </div>
      </div>
   </div>
</div>
<!-- gallery section end -->

<?php require('includes/footer.php') ?>