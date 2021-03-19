<?php

namespace Drupal\aco_core\Utility;

/**
 * Common form fields.
 */
class Fields {

  /**
   * Create name field.
   *
   * @param string|\Drupal\Core\StringTranslation\TranslatableMarkup $label
   *   The label to use.
   * @param string $default
   *   The default value to use.
   * @param bool $required
   *   If the field should be required.
   *
   * @return array
   *   Render array.
   */
  public static function nameField($label, $default = '', $required = TRUE) {
    $args = ['@label' => $label];
    return [
      '#type' => 'textfield',
      '#title' => $label,
      '#title_display' => 'invisible',
      '#placeholder' => $required ? t('@label *', $args) : t('@label', $args),
      '#default_value' => $default,
      '#maxlength' => 50,
      '#required' => $required,
    ];
  }

  /**
   * Create email field.
   *
   * @param string|\Drupal\Core\StringTranslation\TranslatableMarkup $label
   *   The label to use.
   * @param string $default
   *   The default value to use.
   *
   * @return array
   *   Render array.
   */
  public static function emailField($label, $default = '') {
    return [
      '#type' => 'email',
      '#title' => $label,
      '#title_display' => 'invisible',
      '#placeholder' => t('@label *', ['@label' => $label]),
      '#default_value' => $default,
      '#maxlength' => 128,
      '#required' => TRUE,
    ];
  }

  /**
   * Create phone field.
   *
   * @param string|\Drupal\Core\StringTranslation\TranslatableMarkup $label
   *   The label to use.
   * @param string $default
   *   The default value to use.
   *
   * @return array
   *   Render array.
   */
  public static function phoneField($label, $default = '') {
    return [
      '#type' => 'textfield',
      '#title' => $label,
      '#title_display' => 'invisible',
      '#placeholder' => t('@label *', ['@label' => $label]),
      '#default_value' => $default,
      '#maxlength' => 16,
      '#required' => TRUE,
      '#attributes' => [
        'title' => t('Format: 555-555-5555'),
        'pattern' => INTELIYSYS_PHONE_PATTERN,
      ],
    ];
  }

}
