<?php

namespace Drupal\block_examples\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello User' block.
 *
 * @Block(
 *   id = "block_examples_hello_user",
 *   admin_label = @Translation("Block Example: Hello User"),
 *   category = @Translation("Examples")
 * )
 */
class HelloUserBlock extends BlockBase
{


  protected function blockAccess(\Drupal\Core\Session\AccountInterface $account)
  {
    if ($account->isAnonymous()) {
      return \Drupal\Core\Access\AccessResult::forbidden();
    }

    $route_name = \Drupal::routeMatch()->getRouteName();
    if ($route_name != 'entity.user.canonical') {
      return \Drupal\Core\Access\AccessResult::forbidden();
    }

    $route_account = \Drupal::routeMatch()->getParameter('user');
    if (empty($route_account) || $route_account->id() != $account->id()) {
      return \Drupal\Core\Access\AccessResult::forbidden();
    }

    return parent::blockAccess($account);
  }

  /**
   * {@inheritdoc}
   */
  public function build()
  {
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    $date_formatter = \Drupal::service('date.formatter');
    $regTime = \Drupal::time()->getRequestTime();

    $createTime = \DateTime::createFromFormat('U', $user->getCreatedTime());
    $now = \DateTime::createFromFormat('U', $regTime);
    $interval = $now->diff($createTime);

    return [
      '#markup' => $this->t(
        'Hello %name!!! You logged in at @login  which is @interval ago.',
        [
          '%name' => $user->getDisplayName(),
          '@login' => $date_formatter->format($user->getLastLoginTime(), 'short'),
          '@interval' =>  $interval->format('%y years, %m months, %d days, %h hours, %s seconds'),
        ]
      ),
    ];
  }
}
