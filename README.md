# Lean Lightbox (WordPress plugin)

Tiny lightbox plugin based on Imgix's [Luminous](https://github.com/imgix/luminous). Opens all links to `*.(jpg|jpeg|png)` in a lightbox. If a link is part of a gallery, the opened lightbox will be a collection that can be navigated.

There are no configuration options. If it doesn't work for your case I recommend forking it and adjusting execution code for Luminous.

Or if you think something should be changed here, submit a pull request.


## Features

* No configuration
* Includes 2 independent files from CDN:
  1. **1 kB** CSS in `<head>`
  2. **3.7 kB** JS at the end of `<body>`
* Appends a `<script>` tag at the end of `<body>` that will attach the lightbox to image links.


## Installation

Same as every other plugin - put it in `CONTENT_DIR/plugins/`.

That is `wp-content/plugins/` by default but if you're a developer, you should really look into a better way to [develop](https://github.com/andrejcremoznik/WordPressBP) or [manage](https://github.com/andrejcremoznik/ManagedWP) WordPress sites.


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


## License

Lean Lightbox is licensed under the MIT license. See LICENSE.md
