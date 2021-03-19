<?php

namespace Drupal\aco_core\Traits;

use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * An add service trait.
 */
trait AddServiceTrait {

  /**
   * The cached values.
   *
   * @var array
   */
  protected $values = [];

  /**
   * The cached travel options.
   *
   * @var array
   */
  protected $travelOptions = [];

  /**
   * The passenger count.
   *
   * @var int
   */
  protected $passengerCount = 0;

  /**
   * Setup form.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   * @param string $step
   *   The current step.
   *
   * @return bool
   *   Success or failure in the setup process.
   */
  protected function setup(array &$form, FormStateInterface $form_state, $step) {
    $values = $form_state->getTemporaryValue('wizard');
    $form_state->set('step', $step);

    // Don't cache forms.
    $form['#cache'] = ['max-age' => 0];

    // If the second to last step is not completed, then check if the user is
    // attempting to skip ahead. If so, redirect to the correct next step.
    if (!empty($values) && $values['last_step'] != (count($this->steps) - 1)) {
      $next_step_index = $values['last_step'] + 1;
      if ($next_step_index < array_search($step, $this->steps)) {
        $response = new RedirectResponse(Url::fromRoute($this->route, [
          'step' => $this->steps[$next_step_index],
        ])->toString());
        $response->send();
        exit();
      }
    }

    $this->fillValues($form_state);

    return TRUE;
  }

}
