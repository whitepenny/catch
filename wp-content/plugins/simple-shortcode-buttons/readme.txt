=== Simple shortcode buttons ===
Contributors: davidpuc
Tags: editor, buttons, shortcode, edit
Requires at least: 4.0.1
Tested up to: 4.3.1
Stable tag: 1.3.2
License: GNU/GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Description ==
Add shortcode buttons to your WordPress editor to make shortcode inserting really easy.

== Installation ==
From your WordPress dashboard

1. Visit ‘Plugins > Add New’
2. Search for ‘Simple shortcode buttons’
3. Activate Simple shortcode buttons from your Plugins page.

From WordPress.org

1. Download Simple shortcode buttons
2. Upload the ‘dp-shortcode-buttons’ directory to your ‘/wp-content/plugins/’ directory, using your favorite method (ftp, sftp, scp, etc…)
3. Activate Simple shortcode buttonsfrom your Plugins page.

== Frequently Asked Questions ==
**Options**

There are various options users can edit when adding new buttons or editing existing ones:

Shortcode – name of your shortcode
Icon – icon that will represent your shortcode in editor
Title – title that will be shown as popup title and hover text when hovering over the button icon
Enclosing shortcode – read more about enclosing shortcodes here.

**Attributes**

Every shortcode can have multiple attributes which you can add by clicking on Add new attribute option. Attribute options are:

Attribute – attribute name
Label – text that will be shown above attribute value input field
Values – values to be selected from. Values can be any post type (eg. ‘post’, ‘page’, ‘custom-post-type’), comma seperated values (eg. option 1, option 2), comma seperated pairs of values and labels, seperated with pipe (eg. 1|label 1, 2|label 2) or free input (leave empty)
Multi – defines if user can select multiple options (not used when free input)
SQL – custom value selected directly from database via SQL. Query result must return value and label fields. SQL query overwrites Values option of attribute.

== Screenshots ==
1. Added buttons - gallery button with custom SQL query and GIF button with thumbnail and GIF image input fields.
2. Gallery and GIF buttons in WP Editor toolbar
3. Inserting gallery shortcode via shortcode button
4. Example gallery shortcode setup

== Changelog ==

= 1.3.2 =
* Fixed a major save bug when no buttons were added

= 1.3.1 =
* Fixed a typo that caused PHP warning

= 1.3 =
* Fixed a bug where activation of the plugin would fail on older PHP servers

= 1.2 =
* Completely rewritten button saving and added Import/Export options. **Important notice for pre 1.2 users:** If you wish to keep your saved buttons, you need to copy the contents of the *shortcodes.js* file in your */wp-content/plugins/simple-shortcode-buttons/* plugin installation location, update the plugin and then import them via **Import buttons** tab in plugin options.
* Input values must now be separated with semilocon (;) instead of comma. **Important notice for pre 1.2 users:** Make sure you edit your  attribute values accordingly to the change.

= 1.1 =
* Fixed number of displayed post when setting attribute value as post type - select input shows all posts of defined post type now

= 1.0 =
* Initial version