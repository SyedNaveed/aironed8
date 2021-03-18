<?php

namespace Drupal\airchoice_member\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'UserSwitch' Block.
 *
 * @Block(
 *   id = "user_switch_block",
 *   admin_label = @Translation("User Switch block"),
 *   category = @Translation("Dev"),
 * )
 */
class SwitchUserBlock extends BlockBase {

  protected function blockAccess(AccountInterface $account, $return_as_object = FALSE)
  {
    return AccessResult::forbidden();
    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('Hello, World!'),
    ];
  }

}