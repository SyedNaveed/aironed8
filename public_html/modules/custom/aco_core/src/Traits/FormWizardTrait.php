<?php

namespace Drupal\aco_core\Traits;

use Drupal\Core\Form\FormStateInterface;

/**
 * A form wizard trait.
 */
trait FormWizardTrait {

  /**
   * A step submit function to save all values keep track of the last step.
   */
  public function stepSubmit(array &$form, FormStateInterface $form_state) {
    // Backup all values.
    $original_values = $form_state->getValues();
    // Get only the values we care about.
    $values = $form_state->cleanValues()->getValues();
    // Restore original values.
    $form_state->setValues($original_values);
    // Get the currently saved values.
    $cached_values = $form_state->getTemporaryValue('wizard');
    // Merge new values.
    $cached_values = array_merge($cached_values, $values);
    $steps = $this->getOperations($cached_values);
    $step = $form_state->get('step');
    $step_index = array_search($step, array_keys($steps));
    if (!isset($cached_values['last_step']) || $step_index > $cached_values['last_step']) {
      $cached_values['last_step'] = $step_index;
    }
    // Save new values.
    $form_state->setTemporaryValue('wizard', $cached_values);
  }

}
