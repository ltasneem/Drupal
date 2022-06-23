<?php

namespace Hsa\ObjectReviews;

use Hsa\ObjectReviews\StoreFront;
use Hsa\ObjectReviews\ShippingServiceInterface;

class SPU implements ShippingServiceInterface {

  /**
   *
   * @var storeFront
   */
  private $storeFront;

  /**
   * @param StoreFront $storeFront
   */
  public function __construct(StoreFront $storeFront)
  {
    $this->storeFront = $storeFront;
  }
  /**
   *
   * @return StoreFront
   */
  public function getStoreFront()
  {
    return $this->storeFront;
  }

  /**
   *
   * @param StoreFront $storeFront
   */
  public function setStoreFront(StoreFront $storeFront)
  {
    $this->storeFront = $storeFront;
  }

  /**
   * @param float $weight
   * @return float
   */
  public function getShippingCost(float $weight){
    return round($weight * 2.5, 2);
  }

  /**
   * @return string
   */
  public function getName(){
    return $this->storeFront->getName();
  }

}
