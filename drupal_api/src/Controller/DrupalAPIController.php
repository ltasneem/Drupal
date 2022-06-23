<?php

namespace Drupal\drupal_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\drupal_api\Service\DrupalAPIManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Cache\CacheableMetadata;


class DrupalAPIController extends ControllerBase {

  /**
   *
   * @var \Drupal\drupal_api\Service\DrupalAPIManagerInterface
   */
  protected $apiManager;



  /**
   * @param \Drupal\drupal_api\Service\DrupalAPIManagerInterface $apiManager
   */
  function __construct(DrupalAPIManagerInterface $apiManager) {
    $this->apiManager = $apiManager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('drupal_api.manager')
    );
  }


  public function latestModules() {
    $build = [];

    foreach ($this->apiManager->getLatestModules() as $project) {
      $build[] = [
        '#theme' => 'drupal_api_project',
        '#name' => $project['name'],
        '#url' => $project['url'],
        '#created' => $project['created'],
        '#description' => $project['description'],
      ];
    }

    /*$build['#cache'] = [
      'tags' => ['drupal_api.project.list'],
    ];*/

    $cache_metadata = new CacheableMetadata();
    $cache_metadata->addCacheTags(['drupal_api.project.list']);
    $cache_metadata->addCacheContexts(['timezone']);
    $cache_metadata->applyTo($build);

    return $build;
   }

   public function latestThemes() {
    $build = [];

    foreach ($this->apiManager->getLatestThemes() as $project) {
      $build[] = [
        '#theme' => 'drupal_api_project',
        '#name' => $project['name'],
        '#url' => $project['url'],
        '#created' => $project['created'],
        '#description' => $project['description'],
      ];
    }

    /*$build['#cache'] = [
      'tags' => ['drupal_api.project.list'],
    ];*/

    $cache_metadata = new CacheableMetadata();
    $cache_metadata->addCacheTags(['drupal_api.project.list']);
    $cache_metadata->addCacheContexts(['timezone']);
    $cache_metadata->applyTo($build);

    return $build;
   }
  }

/*namespace Drupal\drupal_api\Controller;

use \Drupal\Core\Controller\ControllerBase;


class DrupalAPIController extends ControllerBase
{


  public function latestModules()
  {
    return [
      '#markup' => $this->t('<div class="module">
<h2><a href="https://example.com">Module #1</a></h2>
<div class="created">2018-05-24 12:00:00</div>
<div class="description">This is module #1</div>
</div>

<div class="module">
<h2><a href="https://example.com">Module #2</a></h2>
<div class="created">2018-05-23 12:00:00</div>
<div class="description">This is module #2</div>
</div>

<div class="module">
<h2><a href="https://example.com">Module #3</a></h2>
<div class="created">2018-05-22 12:00:00</div>
<div class="description">This is module #3</div>
</div>'),
    ];
  }
}*/
