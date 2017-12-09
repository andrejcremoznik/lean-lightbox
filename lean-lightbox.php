<?php
/**
 * Plugin Name:       Lean Lightbox
 * Plugin URI:        https://github.com/andrejcremoznik/lean-lightbox
 * Description:       Lean lightbox plugin for single image links and WordPress galleries.
 * Version:           1.2
 * Author:            Andrej Cremoznik
 * Author URI:        https://keybase.io/andrejcremoznik
 * License:           MIT
 */

if (!defined('WPINC')) die();

class LeanLightbox {
  protected $plugin_name;

  public function __construct() {
    $this->plugin_name = 'lean-lightbox';
  }

  public function load_assets() {
    wp_enqueue_style(
      $this->plugin_name,
      'https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/1.0.1/luminous-basic.min.css',
      [],      // No dependencies
      null,    // Version is in URL
      'screen' // Only need the styles for web browsers
    );

    wp_enqueue_script(
      $this->plugin_name,
      'https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/1.0.1/Luminous.min.js',
      [],   // No dependencies
      null, // Version is in URL
      true  // Place the scipt in footer
    );
  }

  public function luminous() {
    $script = [
      '<script>',
        '(function(d){',
          // Find all image links
          'let a=Array.from(d.querySelectorAll(\'a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"]\'));',
          // Find all gallery images links
          'let g=Array.from(d.querySelectorAll(\'.gallery-item a\'));',
          // Get only those image links that aren't part of the gallery
          'let r=a.filter(i=>g.findIndex(gi=>i.offsetTop===gi.offsetTop&&i.offsetLeft===gi.offsetLeft)<0);',
          // Create Lightbox for single image links if we have any
          'if(r.length)r.forEach(s=>new Luminous(s));',
          // Create Lightbox for gallery image links if we have any
          'if(g.length)new LuminousGallery(g);',
        '})(document);',
      '</script>'
    ];

    echo implode('', $script);
  }

  public function run() {
    add_action('wp_enqueue_scripts', [$this, 'load_assets']);
    add_action('wp_footer', [$this, 'luminous'], 21); // 21 = after 'wp_enqueue_scripts'
  }
}

// Run
function run_lean_lightbox() {
  $plugin = new LeanLightbox();
  $plugin->run();
}
run_lean_lightbox();
