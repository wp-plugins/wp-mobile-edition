=== WP Mobile Edition ===
Plugin Name: WP Mobile Edition
Contributors: fdoromo
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BABHNAQX4HLLW
Tags: Sitemap, iPhone, Android, Windows Phone, Blackberry, HTML5, Touch, Mobile detection, Mobile switcher, Mobilize, Switch Theme, Mobile Toolkit, Disqus
Requires at least: 3.0
Tested up to: 3.8
Stable tag: 1.9.2
License: GPLv2 or later

Is a complete toolkit to mobilize your WordPress site. It has a mobile switcher, themes, and mobile XML Sitemap Generator.

== Description ==
Fully optimized for the best performance on smartphones, compatible with: iPhone, Android, Windows Phone, Blackberry. Simple and easy to use: An Intuitive setting page gives you complete control. The pack contains the following functionality:

= Mobile switcher =
* The mobile switcher automatically detects whether the visitor to the site is mobile or not, and switches between the primary WordPress theme (for desktop users) or loads a mobile theme. 

* Includes the ability for visitors to switch between mobile view and your site's regular theme (and remembers their choice).

= Mobile XML Sitemap Generator =

* It will create a mobile xml sitemap, to maximize the mobile version in mobile search engines like google, Bing, and other.


= A standard mobile theme = 
* Was designed to be as lightweight and speedy as possible, while still serving your site's content in a richly presented way, sparing no essential features like search, categories, tags, comments etc.

* Device adaptation, including the rescaling of images, intelligent splitting of articles and posts into multiple pages, the simplifaction styles, and the removal of non-supported media.

* Smart Formatting: It doesn't matter whether users are viewing your site horizontally or vertically, mTheme will re-position all media on the fly.

* Full Comments System: Default wordpressor or DISQUS.

* You can choose from 16 different color schemes in the settings panel.

* Easily customize your mobile theme logo with our easy uploader.

* No SEO Knowledge Needed: mTheme will automatically optimize your site for SEO. You don't need to touch a button, just sit back and watch your rankings rise.

* Equipped with a mobile ad, you can put any ads scripts (Adsense, admob, or banner ads of your own) and it will appear on your mobile version.

* Mobile-friendly: an extensible theme that is ready for display on mobile devices. The theme is XHTML-MP compliant and scores highly on [W3C mobileOK Checker](http://validator.w3.org/mobile/). 

= DEMO =
* To see mTheme in action visit [http://m.webmais.com](http://m.webmais.com) on your mobile device.
* Look: Gallery page, Contact form, comments in levels, and all functionality like a theme for desktop.


= Used With Subdomain =
* **Best cookie support:** If you logged into a mobile website but needed to view the desktop website and wanted to switch to that mode, using `"m.domain.com"` would be best so you can stay logged in between both versions.

* **Best SEO:** Allows more pages to be indexed in search engines and it much more easier to find you on internet specially on mobile search engine.

* **Best cache support:** Compatible with all caching plugins. (separately cache: `domain.com/post1/` for dektop and `m.domain.com/post1/` for mobile devices)

> Companies such as : `m.yahoo.com`, `m.twitter.com`, `m.google.com`, `m.youtube.com`, `m.facebook.com`, have adopted this method. 


= Languages Available =
* English (default)
* Brazilian Portuguese (**pt_BR**) translation by **Fabrix DoRoMo**
* Spanish (**es_ES**) translation by **David R. Rojas** 
* Dutch (**nl_NL**) translation by **Bas de Haan**
* Italian (**it_IT**) translation by **Francesco Scotti**
* Russian (**ru_RU**) translation by **Александр Ческов**



= How To Contribute =
We'd love for you to get involved. Whatever your level of skill or however much time you can give, your contribution is greatly appreciated.

* **Users** - download the latest development version of the plugin, and submit bug/feature requests. 
* **Non-English Speaking Users** - Contribute a translation using the GlotPress web interface - no technical knowledge required ([how to](http://translate.fabrix.net/projects/wp-mobile-edition)).
* **Developers** - Fork the development version and submit a pull request. 


== Screenshots ==
1. mTheme options
2. Basic Settings
3. Front end (16 theme options)


== Installation ==
1. Upload the `wp-mobile-edition` folder to your `/wp-content/plugins/` directory
1. Activate the `WP Mobile Edition` plugin in your WordPress admin `Plugins`
1. Submit your subdomain, e select o Mobile Theme (mTheme) Done!

You can install **WP Mobile Edition** directly from the WordPress admin! Visit the Plugins - > Add New page and search for **WP Mobile Edition**. Click to install.

= To add a switch link in your default theme =
`<a href="<?php if( defined('FDX_MLINK') ) { echo FDX_MLINK; } ?>">Mobile Version</a>`


> **IMPORTANT** After upgrade, disable and enable the plugin to update the files of mobile theme (mTheme). **Clear Your Browser's Cache.**



= SETTING UP A SUBDOMAIN IS DONE THROUGH YOUR HOSTING PROVIDER =
You need to create a CName, and unfortunately the way you do this differs from one host to another, with some it's a drop down box and it takes two seconds to do, with others the process will be a little bit more complicated.

If you use an external host somewhere there will be a section where you can edit your DNS details - if your service doesn't allow it then it's probably time to move to another host.

When you create a subdomain, you will need two things, the domain the subdomain is for and the location from which the new subdomain will load it's content.

Type your subdomain (m), that will be your mobile subdomain, then point for your website root. (don't create a extra folder) this plugin will not work if you point it to be different from the directory you installed WordPress.

To confirm that the preocesso was performed correctly visit your full site in `m.yousite.com` (before enable the plugin)

= TESTING YOUR INSTALLATION (after enable the plugin) =
Ideally, use a real mobile device to access your (public) site address and check that the switching and theme work correctly. 

In Firefox Browser, the [User-Agent Switcher](https://addons.mozilla.org/pt-br/firefox/addon/user-agent-switcher/) add-on can be configured to send mobile headers and crudely simulate a mobile device's request.

You can also download a number of mobile emulators that can run on a desktop PC and simulate mobile devices. 

== Frequently Asked Questions ==
= Does this create a mobile admin interface too? =
No, it does not. for this, install ([Mobile Apps](http://wordpress.org/extend/mobile/)).


= How can I submit my mobile sitemap to Google? =
Once you have created your Sitemap, you can submit it to Google using Webmaster Tools.

= Where's the sitemap file stored? =
You can find the `msitemap.xml` file in your blog's root folder.

= I am getting Permission Denied like errors =
It implies that you don't have write permissions on your blog's root folder.  Please use chmod or your FTP manager to set the necessary permissions to 0666.


== Changelog ==
* 1.9.2
    * Adds Italian translation.
    * Adds Russian translation.


* 1.9.1
    * Minor bug fixes

* 1.9
    * Minor bug fixes.
    * Adds Dutch translation.

* 1.8
    * Minor bug fixes
    * Added support for Custom location of WP Core.

* 1.7
    * Replacement of the deactivation, by uninstalling, to reset settings.
    * Improvement of performance 

* 1.6
    * Minor bug fixes
    * Adds Spanish translation.

* 1.5.1
    * Adds Brazilian Portuguese translation.

* 1.5
    * mTheme - Various cosmetic fixes

* 1.4
    * Minor bug fixes
    * Various cosmetic fixes
    * Improvement of performance

* 1.3
    * Added the login page and control panel basics.

* 1.2
    * Minor bug fixes

* 1.1
    * Minor bug fixes

* 1.0
    * Initial release

== Upgrade Notice ==

= 1.8 =
IMPORTANT: After upgrade, Deactivate and Activate the plugin to update the files of mobile theme (mTheme). 
