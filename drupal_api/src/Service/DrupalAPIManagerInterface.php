<?php

namespace Drupal\drupal_api\Service;

interface DrupalAPIManagerInterface
{

  /**
   * @return array
   */
  public function getLatestModules();

  /**
   * @return array
   */
  public function getLatestThemes();

  /**
   * Fetch the latest projects fro Drupal.org API
   */
  public function fetchLatestProjects();
}
