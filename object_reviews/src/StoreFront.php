<?php

namespace Hsa\ObjectReviews;

class StoreFront{

  /**
   * @var string
   */
    protected $name;

    /**
     * @var float
     */
    protected $price;
    /**
     * @var float
     */
    protected $weight;

  /**
   *
   * @var string
   */
  private $type;

  /**
   *
   * @param string $name
   */
  public function __construct(string $name, float $price, float $weight, string $type)
  {
    $this->name = $name;
    $this->price = $price;
    $this->weight = $weight;
    $this->type = $type;
  }

  /**
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   *
   * @param string $name
   */
  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function getType()
  {
    return $this->type;
  }

  public function setType($type)
  {
    $this->type = $type;
  }

  /**
   *
   * @return float
   */
  public function getPrice()
  {
    return $this->price;
  }

  /**
   *
   * @param float $price
   */
  public function setPrice(float $price)
  {
    $this->price = $price;
  }

  /**
   *
   * @return float
   */
  public function getWeight()
  {
    return $this->weight;
  }

  /**
   *
   * @param float $weight
   */
  public function setWeight(float $weight)
  {
    $this->weight = $weight;
  }


}
