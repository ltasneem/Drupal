<?php

namespace Hsa\ObjectReviews;

use Hsa\ObjectReviews\StoreFront;

class Shirts extends StoreFront {
  /**
   *
   * @var string
   */
  private $size;


  public function __construct(string $name, float $price, float $weight, string $size)
  {
    parent::__construct($name, $price, $weight, "shirt");
    $this->size = $size;
  }


  /**
   *
   * @return string
   */
  public function getSize()
  {
    return $this->size;
  }

  /**
   *
   * @param string $size
   */
  public function setSize(string $size)
  {
    $this->size = $size;
  }

}
