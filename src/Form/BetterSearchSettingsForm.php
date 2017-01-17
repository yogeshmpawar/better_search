<?php

namespace Drupal\better_search\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Displays the better_search settings form.
 */
class BetterSearchSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['better_search.settings'];
  }

  /**
   * Implements \Drupal\Core\Form\FormInterface::getFormID().
   */
  public function getFormId() {
    return 'better_search_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['text'] = array(
      '#type' => 'fieldset',
      '#title' => t('Better Search Text Options'),
    );

    $form['text']['placeholder_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Placeholder Text'),
      '#description' => t('Enter the text to be displayed in the search field (placeholder text)'),
      '#default_value' => $this->config('better_search.settings')->get('placeholder_text'),
      '#size' => 30,
      '#maxlength' => 60,
      '#required' => TRUE,
    );

    $form['theme'] = array(
      '#type' => 'fieldset',
      '#title' => t('Better Search Theme Options'),
    );

    $options = array(
      0 => t('Background Fade'),
      1 => t('Expand on Hover'),
      2 => t('Expand Icon on Hover'),
      3 => t('Slide Icon on Hover'),
    );

    $form['theme']['theme'] = array(
      '#type' => 'radios',
      '#title' => t('Select Theme'),
      '#default_value' => $this->config('better_search.settings')->get('theme'),
      '#options' => $options,
      '#description' => t('Select the theme to use for the search block.'),
    );

    $options = array(
      10 => '10',
      12 => '12',
      14 => '14',
      16 => '16',
      18 => '18',
      20 => '20',
      22 => '22',
      24 => '24',
      26 => '26',
      28 => '28',
      30 => '30',
    );

    $form['theme']['size'] = array(
      '#type' => 'select',
      '#title' => t('Search Box Size'),
      '#default_value' => $this->config('better_search.settings')->get('size'),
      '#options' => $options,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('better_search.settings');
    $config->set('placeholder_text', $form_state->getValue('placeholder_text'));
    $config->set('theme', $form_state->getValue('theme'));
    $config->set('size', $form_state->getValue('size'));

    $config->save();

    parent::submitForm($form, $form_state);
  }

}
