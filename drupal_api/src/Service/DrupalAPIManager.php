<?php

namespace Drupal\drupal_api\Service;

use GuzzleHttp\Client;
use Drupal\Core\Database\Connection;
use \Drupal\Core\Cache\CacheTagsInvalidatorInterface;


class DrupalAPIManager implements DrupalAPIManagerInterface {


  /**
   * @var \GuzzleHttp\Client
   */
  protected $client;

  /**
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

    /**
   *
   * @var \Drupal\Core\Cache\CacheTagsInvalidatorInterface
   */
  private $cacheTagInvalidator;

  public function __construct(Client $client, Connection $connection, CacheTagsInvalidatorInterface $cacheTagInvalidator) {
    $this->client = $client;
    $this->connection = $connection;
    $this->cacheTagInvalidator = $cacheTagInvalidator;
  }

  /**
   * @return array
   */
  public function getLatestModules() {
    return $this->getLatestProjects('project_module');
  }

  /**
   * @return array
   */
  public function getLatestThemes() {
    return $this->getLatestProjects('project_theme');
  }

  protected function getLatestProjects($type = NULL) {
    $query = $this->connection->select('drupal_api', 'd')
        ->fields('d')
        ->orderBy('created', 'DESC')
        ->range(0, 10);
    if (!empty($type)) {
      $query->condition('type', $type);
    }
    return $query->execute()
        ->fetchAll(\PDO::FETCH_ASSOC);
  }

  /**
   * Fetch the latest projects fro Drupal.org API
   */
  public function fetchLatestProjects() {
    $data = NULL;
    try {
      $response = $this->client->get('https://www.drupal.org/api-d7/node.json?type[]=project_theme&type[]=project_module&limit=100&sort=created&direction=DESC&field_project_type=full');
      if ($response->getStatusCode() == 200) {
        $json = $response->getBody()->getContents();
        $data = json_decode($json);
      }
    } catch (\Exception $ex) {
      watchdog_exception('drupal_api', $ex);
    }
    if (!empty($data)) {
      foreach ($data->list as $project_data) {
        // Checking whether NID is already in the DB.
        $project = $this->connection->select('drupal_api', 'd')
            ->fields('d')
            ->condition('d.id', $project_data->nid)
            ->execute()
            ->fetch();

        if (empty($project)) {
          //import only new projects
          $this->connection->insert('drupal_api')
              ->fields([
                'id' => $project_data->nid,
                'name' => $project_data->title,
                'type' => $project_data->type,
                'created' => $project_data->created,
                'url' => $project_data->url,
                'description' => !empty($project_data->body->value) ? $project_data->body->value : ''
              ])
              ->execute();
        }
      }
    }
    $this->cacheTagInvalidator->invalidateTags(['drupal_api.project.list']);
  }
}
/*namespace Drupal\drupal_api\Service;

use GuzzleHttp\Client;


class DrupalAPIManager implements DrupalAPIManagerInterface
{



  protected $client;

  public function __construct(Client $client)
  {
    $this->client = $client;
  }


  public function getLatestModules()
  {
    $modules = [];
    $data = NULL;
    try {
      $response = $this->client->get('https://www.drupal.org/api-d7/node.json?type=project_module&limit=10&sort=created&direction=DESC&field_project_type=full');
      if ($response->getStatusCode() == 200) {
        $json = $response->getBody()->getContents();
        $data = json_decode($json);
      } else {
        \Drupal::messenger()->addMessage(t('Error retrieving module information.'), 'error');
      }
    } catch (\Exception $ex) {
      \Drupal::messenger()->addMessage(t('Error retrieving module information.'), 'error');
    }
    if (!empty($data)) {
      foreach ($data->list as $module_data) {
        $modules[] = [
          'name' => $module_data->title,
          'created' => $module_data->created,
          'url' => $module_data->url,
          'description' => !empty($module_data->body->value) ? $module_data->body->value : '',
        ];
      }
    }

    return $modules;
  }
}*/
