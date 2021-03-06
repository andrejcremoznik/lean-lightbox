# Lean Lightbox (WordPress plugin)

Tiny lightbox plugin based on Imgix's [Luminous](https://github.com/imgix/luminous). Opens all links to `*.(jpg|jpeg|png)` in a lightbox. If a link is part of a gallery, the opened lightbox will be a collection that can be navigated.

There are no configuration options. If it doesn't work for your case I recommend forking it and adjusting execution code for Luminous.

Or if you think something should be changed here, submit a pull request.

**Browser compatibility**

The execution coded uses ES2015 which means no Internet Explorer. Works in Edge and everywhere else.


## Features

* No configuration
* Includes 2 files from a CDN at the end of `<body>`:
  1. **1 kB** CSS
  2. **3.7 kB** JS
* Appends a `<script>` tag at the end of `<body>` that will attach the lightbox to image and gallery links.


## Installation

`WP_CONTENT_DIR` is the directory containing `plugins`, `themes`, `uploads`, etc. Default is `/path/to/wordpress/wp-content`.

Download the [zip](https://github.com/andrejcremoznik/lean-lightbox/archive/2.3.2.zip) and extract it to `WP_CONTENT_DIR/plugins/lean-lightbox`.

**CLI one-liner:**

```
# Change the path at the end:

curl -L https://github.com/andrejcremoznik/lean-lightbox/archive/2.3.2.tar.gz | tar zxf - --transform=s/lean-lightbox-2.3.2/lean-lightbox/ -C /path/to/wordpress/wp-content/plugins/
```


## Implementation Notes

If you have elements with `z-index` > 0 on your website, add the following to your CSS:

```
/* Lean-Lightbox: adjust the z-index value for the lightbox */
.lum-lightbox { z-index: 100; }
```


## Why is this not in the WordPress plugin directory?

Two reasons:

1. I forgot how to use SVN (I don't understand why WP is still using it).
2. It breaks [the guidelines](https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/#8-the-plugin-may-not-send-executable-code-via-third-party-systems) so I don't intend to submit it for review.

The problem is this:

> **8. The plugin may not send executable code via third-party systems.**
> ...
> * Calling third party CDNs for reasons other than font inclusions; all non-service related JavaScript and CSS must be included locally
> ...

The plugin includes Luminous from [cdnjs.com](https://cdnjs.com/libraries/luminous-lightbox). Including this locally would go against everything the word "lean" in the name stands for. The only time you'd include this locally is if you're bundling your Javascript and CSS in a custom template. Otherwise it's an additional HTTP request which may as well go out to a CDN.


## Changelog

### 2.3.2

* Update Luminous to 2.3.2

### 2.3.1

* Update Luminous to 2.3.1

### 2.0

* Update Luminous to 2.0.0

### 1.5

* Move CSS to the end `<body>`.
* Documentation updates

### 1.4

* Use [Subresource Integrity](https://developer.mozilla.org/en-US/docs/Web/Security/Subresource_Integrity) for files loaded from CDN.
* Print resources directly to `wp_head` and `wp_footer` because using the `wp_enqueue_` functions yields zero benefits.

### 1.3

* Initial public release


## License

Lean Lightbox is licensed under the MIT license. See LICENSE.md
