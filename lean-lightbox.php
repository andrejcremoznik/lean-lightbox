<?php
/**
 * Plugin Name:       Lean Lightbox
 * Plugin URI:        https://github.com/andrejcremoznik/lean-lightbox
 * Description:       Lean lightbox plugin for single image links and WordPress galleries.
 * Version:           2.3.1
 * Author:            Andrej Cremoznik
 * Author URI:        https://keybase.io/andrejcremoznik
 * License:           MIT
 */

if (!defined('WPINC')) die();

class LeanLightbox {
  public function __construct() {
    // Sources from: https://cdnjs.com/libraries/luminous-lightbox
    $this->js_src  = 'https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/2.3.1/luminous.min.js';
    $this->js_sri  = 'sha256-L+jsEsJBRzSB5C59cNukXHjBYdJW8qOu4QeYeYPSmeg=';
    $this->css_src = 'https://cdnjs.cloudflare.com/ajax/libs/luminous-lightbox/2.3.1/luminous-basic.min.css';
    $this->css_sri = 'sha256-v8wMBeXyy3X+k+bM6TcyFGCAOpB/NXSn90LzcyRzWSA=';
  }

  public function add_assets() {
    $script = [
      // Load Luminous script raw (there are too many downsides to wp_enqueue_script)
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
          'const a=Array.from(d.querySelectorAll(\'a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"]\'));',
          // Find all gallery images links
          'const g=Array.from(d.querySelectorAll(\'.gallery-item a\'));',
          // Get only those image links that aren't part of the gallery
          'const r=a.filter(i=>g.findIndex(gi=>i.offsetTop===gi.offsetTop&&i.offsetLeft===gi.offsetLeft)<0);',
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
