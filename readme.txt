=== Plugin Name ===
Contributors: anshi
Donate link: http://www.anshisolutions.com/
Tags: category, treeview, mindmap, D3
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.1
Version: 1.0 
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin shows the Wordpress Category or any taxonomy in an interactive & responsive tree layout. 

== Description ==

This plugin shows the Wordpress Category or any taxonomy in an interactive and responsive tree layouts. It can be used to generate mind maps using the Wordpress taxonomy.Just add the shortcode [category-d3tree]  to your post and the plugin will generate the treeview from your category. It uses the D3 javascript library to generate the interactive tree from the taxonomy. A demo of the plugin can be seen here http://wp.anshisolutions.com/category-tree/

This plugin also support addiitonal Force Directed and Radial Layouts for the taxonomy hierarchies. 


== Installation ==

1. Upload `category-d3-tree` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add to any page using short-code [category-d3tree]

== Frequently Asked Questions ==

= How can I show the tree view with a given taxonomy =

You just need to provide the taxonomy name as parameter in the short code like this [category-d3tree taxonomy="taxonomy_name" layout="layout_name"]
We support 3 layoutnames "force", "radial" and "tree"

= Can I create 2 category layouts on one page =

At the moment we support only 1 shortcode on 1 page. You cannot put 2 layouts on a single page


== Screenshots ==

1. This is a hierarchy of Animals as created in taxonomy using Tree Layout.
1. This is a hierarchy of Animals as created in taxonomy using Force Layout.
1. This is a hierarchy of Animals as created in taxonomy using Radial Layout.

== Changelog ==
= 1.1 =
* Added Responsive Layout
= 1.0 =
* Stable Version
= 0.3 =
* Added Radial Layout
= 0.2 =
* Added Force Layout
= 0.1 =
* Initial release


