<?php

include 'vendor/autoload.php';

use Hsa\ObjectReviews\Books;
use Hsa\ObjectReviews\Shirts;

$storeFronts= [];
$storeFronts[] = new Books("A Brief History of Time", 11.11, .712, "Steven Hawkin", 212);
$storeFronts[] = new Shirts("Spinal Tap T-Shirt", 16.06, .5, "X-Large");
$storeFronts[] = new Books("Goodnight Moon", 10.58, .65, "Margaret Wise Brown", 32);
$storeFronts[] = new Books("The Lord of the Rings", 29.07, 4.6, "J.R.R Tolkien", 1178);
$storeFronts[] = new Shirts("Oxford Dress Shirt", 18.47, .837, "Medium");
