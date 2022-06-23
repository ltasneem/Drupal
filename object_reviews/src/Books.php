<?php

namespace Hsa\ObjectReviews;

use Hsa\ObjectReviews\StoreFront;

class Books extends StoreFront
{
  /**
   *
   * @var string
   */
  private $author;

  /**
   *
   * @var int
   */
  private $numOfPages;

  public function __construct(string $name, float $price, float $weight, string $author, int $numOfPages)
  {
    parent::__construct($name, $price, $weight, "book");
    $this->author = $author;
    $this->numOfPages = $numOfPages;
  }


  /**
   *
   * @return string
   */
  public function getAuthor()
  {
    return $this->author;
  }

  /**
   *
   * @param string $author
   */
  public function setAuthor(string $author)
  {
    $this->author = $author;
  }

  /**
   *
   * @return int
   */
  public function getNumOfPages()
  {
    return $this->numOfPages;
  }

  /**
   *
   * @param int $numOfPages
   */
  public function setNumOfPages(int $numOfPages)
  {
    $this->numOfPages = $numOfPages;
  }


}
