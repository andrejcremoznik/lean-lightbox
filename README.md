# Lean Lightbox (WordPress plugin)

Tiny lightbox plugin based on Imgix's [Luminous](https://github.com/imgix/luminous). Opens all links to `*.(jpg|jpeg|png)` in a lightbox. If a link is part of a gallery, the opened lightbox will be a collection that can be navigated.

There are no configuration options. If it doesn't work for your case I recommend forking it and adjusting execution code for Luminous.

Or if you think something should be changed here, submit a pull request.

**Browser compatibility**

The execution coded uses ES2015 which means no Internet Explorer. Works in Edge and everywhere else.


## Features

* No configuration
* Includes 2 independent files from CDN:
  1. **1 kB** CSS in `<head>`
  2. **3.7 kB** JS at the end of `<body>`
* Appends a `<script>` tag at the end of `<body>` that will attach the lightbox to image links.


## Installation

`WP_CONTENT_DIR` is a WordPress variable that points to the directory containing `plugins`, `themes`, `uploads`, etc. Default is `/absolute/path/wordpress/wp-content`.

Download the [zip](https://github.com/andrejcremoznik/lean-lightbox/archive/1.2.zip) and extract it to `WP_CONTENT_DIR/plugins/lean-lightbox`.

**CLI one-liner:**

```
# If WP_CONTENT_DIR/plugins/lean-lightbox doesn't exist, create it first then:

curl -L https://github.com/andrejcremoznik/lean-lightbox/archive/1.2.tar.gz | tar zxf - --strip-components=1 -C WP_CONTENT_DIR/plugins/lean-lightbox/
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


## License

Lean Lightbox is licensed under the MIT license. See LICENSE.md
