<?php

include 'bootstrap.php';

use Hsa\ObjectReviews\Books;
use Hsa\ObjectReviews\Shirts;
use Hsa\ObjectReviews\StoreFront;
use Hsa\ObjectReviews\SPU;
use Hsa\ObjectReviews\ExFed;
?>

<html>

<head>
  <title>Hsa Shop</title>
</head>

<body>
  <h1>Hsa Shop</h1>
  <?php foreach ($storeFronts as $i => $storeFront) : ?>
    <h2><?php print $storeFront->getName();
        $spu = new SPU($storeFront);
        $exFed = new ExFed($storeFront);
        ?></h2>
    <?php if ($storeFront->getType() == 'book') : ?>
      <p><?php
          print "Price: $" . $storeFront->getPrice();
          print "<br />";
          print "Author: " . $storeFront->getAuthor();
          print "<br />";
          print "Number Of Pages: " . $storeFront->getNumOfPages();
          print "<br /><b>Shipping</b><br />";
          print "SPU 3-day: $" . $spu->getShippingCost($storeFront->getWeight());
          print "<br />";
          print "ExFed Overnight: $" . $exFed->getShippingCost($storeFront->getWeight());
          ?></p>
    <?php endif; ?>
    <?php if ($storeFront->getType() == 'shirt') : ?>
      <p><?php
          print "Price: $" . $storeFront->getPrice();
          print "<br />";
          print "Size: " . $storeFront->getSize();
          print "<br /><b>Shipping</b><br />";
          print "SPU 3-day: $" . $spu->getShippingCost($storeFront->getWeight());
          print "<br />";
          print "ExFed Overnight: $" . $exFed->getShippingCost($storeFront->getWeight());
          ?></p>
    <?php endif; ?>
  <?php endforeach; ?>
</body>

</html>
