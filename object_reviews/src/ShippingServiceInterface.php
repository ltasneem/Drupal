<?php

namespace Hsa\ObjectReviews;

interface ShippingServiceInterface
{
  /**
   * @param float $weight
   * @return float
   */
  public function getShippingCost(float $weight);

  /**
   * @return string
   */
  public function getName();
}
