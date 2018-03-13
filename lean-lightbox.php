<?php
/**
 * Plugin Name:       Lean Lightbox
 * Plugin URI:        https://github.com/andrejcremoznik/lean-lightbox
 * Description:       Lean lightbox plugin for single image links and WordPress galleries.
 * Version:           1.5
 * Author:            Andrej Cremoznik
 * Author URI:        https://keybase.io/andrejcremoznik
 * License:           MIT
 */

if (!defined('WPINC')) die();

class LeanLightbox {
  public function __construct() {
    // Sources from: https://cdnjs.com/libraries/luminous-lightbox
    $this->js_src  = 'https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/1.0.1/Luminous.min.js';
    $this->js_sri  = 'sha256-EzO28u8m/P+Z+eQCVS4kSkt1zjFLpxmCxydymMaRONs=';
    $this->css_src = 'https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/1.0.1/luminous-basic.min.css';
    $this->css_sri = 'sha256-uCdaKiNzZUXz+QXd2W48tXdSDRmaWc7SxYe1xTc3A94=';
  }

  public function add_assets() {
    $script = [
      // Load Luminous script (there are too many downsides to wp_enqueue_script)
      sprintf(
        '<script src="%s" integrity="%s" crossorigin="anonymous"></script><link rel="stylesheet" href="%s" integrity="%s" crossorigin="anonymous" media="screen">',
        $this->js_src,
        $this->js_sri,
        $this->css_src,
        $this->css_sri
      ),
      // Find image links and apply Luminous
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
    add_action('wp_footer', [$this, 'add_assets'], 21); // 21 = after 'wp_enqueue_scripts'
  }
}

// Run
function run_lean_lightbox() {
  $plugin = new LeanLightbox();
  $plugin->run();
}
run_lean_lightbox();
