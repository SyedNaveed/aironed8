<?php

namespace Drupal\aco_core\Traits;

use Drupal\Component\Utility\NestedArray;

/**
 * A tempstore trait.
 */
trait TempstoreTrait {

  /**
   * Save values to temporary storage.
   *
   * @param array $values
   *   The values to save.
   */
  protected function saveToTempstore(array $values = []) {
    $tempstore = \Drupal::service('tempstore.private')->get($this->tempstoreId);
    $existing = $tempstore->get($this->tempstoreMachineName);
    $combined = NestedArray::mergeDeepArray([$existing, $values], TRUE);
    $tempstore->set($this->tempstoreMachineName, $combined);
  }

  /**
   * Clear values in temporary storage.
   */
  protected function clearTempstore() {
    $tempstore = \Drupal::service('tempstore.private')->get($this->tempstoreId);
    $tempstore->set($this->tempstoreMachineName, []);
  }

}
