<?php

/**
 * @file
 * Contains Drupal\photoswipe\PhotoswipeAssetsManager.
 */

namespace Drupal\photoswipe;

/**
 * Photoswipe asset manager.
 */
class PhotoswipeAssetsManager implements PhotoswipeAssetsManagerInterface {

  /**
   * Whether the assets were attached somewhere in this request or not.
   */
  protected $attached;

  /**
   * Photoswipe config.
   *
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $config;

  /**
   * Creates a \Drupal\photoswipe\PhotoswipeAssetsManager.
   */
  public function __construct(ConfigFactoryInterface $config) {
    $this->config = $config->get('photoswipe.settings');
  }

  /**
   * {@inheritdoc}
   */
  public function attach(&$element) {
    // We only need to load only once per pace.
    if (!$this->attached) {
      // Add the library of Photoswipe assets
      $attachments['#attached']['library'][] = 'photoswipe/photoswipe';
      // Load initialization file
      $attachments['#attached']['library'][] = 'photoswipe/photoswipe.init';

      // Add photoswipe js settings.
      $attachments['#attached']['drupalSettings']['photoswipe']['options'] = $this->config->get('options');

      $this->attached = TRUE;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function isAttached() {
    return $this->attached;
  }

}
