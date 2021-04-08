<?php

namespace Drupal\airchoice_member\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SiteLogoBlock' block.
 *
 * @Block(
 *  id = "site_logo_block",
 *  admin_label = @Translation("Site logo block"),
 * )
 */
class SiteLogoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    
    
    $build = [];
    $build['#theme'] = 'site_logo_block';

    $build['dashboardlogo'] = [
      '#type' => 'inline_template',
      '#template'=> '<a href="{{ drupal_url("/dashboard") }}"><img src="'.theme_get_setting('logo.url').'" />'
    ];

    return $build;
  }

}
