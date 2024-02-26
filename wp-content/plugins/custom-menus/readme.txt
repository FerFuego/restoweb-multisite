=== Menus ===
Contributors: dsader
Donate link: http://dsader.snowotherway.org
Tags: menus, administration menus, admin menus, multisite, toggle admin menus
Requires at least: 3.7.1
Tested up to: 4.6
Stable tag: Trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A Multisite Network plugin to toggle administration menus for the entire network of sites.

== Description ==
Enable or disable WordPress [Multisite](http://codex.wordpress.org/Create_A_Network) backend menus. Adds options to toggle administration menus at Network Admin->Settings page under "Menu Settings". WP already toggles the Plugins menu, I've added a bunch more in the same/similar way.

I use the plugin to simplify the menus available to the entire network of sites. I use this plugin in a Multisite installation to disable the Delete Blog, Permalinks, Import, Add Users and Theme customizer menus.

The plugin also removes some of the admin bar menu items as well.


== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin to your blog, Network Activate it
2. Set multisite "Menu Settings" options at Network->Settings page

== Frequently Asked Questions ==

* Will this plugin also hide menus added by plugins? Maybe, if the parent page is hidden. Snoop into the code to see how to add your own remove_menu_page items.
* Will this plugin hide the corresponding items from the admin head favourites and toolbar? Yes. The +New and a couple others can be toggled
* Will this plugin disable media uploads? Yes. Well, from the Media menus at least. 
* Will this plugin hide the media upload buttons? No. The Media Upload Buttons in the edit post/page form can be removed with my Toggle Meta Boxes Sitewide plugin.
* Can I have different menus for different roles of users on different blogs? No, this plugin toggles menus for all users and all blogs regardless of Cap/Role (only SuperAdmin can override the limits of the plugin however).

== Screenshots ==

1. Menu Settings: Enable Administration Menus
2. Admin Bar Dropdown Shortcuts

== Changelog ==
= 4.6 =
* WP 4.6 tests OK, cleanup php notices

== Upgrade Notice ==
= 4.6 =
* WP 4.6 tests OK, cleanup php notices