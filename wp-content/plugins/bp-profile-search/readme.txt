=== BP Profile Search ===
Contributors: dontdream
Tags: buddypress, directory, members, users, profile, search, filter
Requires at least: 4.6
Tested up to: 5.0
Requires PHP: 5.3
Stable tag: 4.9.7

Custom members search forms and results pages, and custom members directories for your BuddyPress site.

== Description ==

With BP Profile Search you can build custom Members search forms, and custom Members directories or search results pages.

You can search BuddyPress profile fields, the *users* and *usermeta* tables (including roles), and user taxonomies (including BP member types).

To build a search form, use the form settings, and select the form's search results page among the existing Members directories.

You can display a search form:

* in its Members directory, using the option *Add to Directory* in the form settings
* in a sidebar or widget area, using the widget *Profile Search*
* in a post or page, using the shortcode<br><code>[bps_form id='id of your form']</code>

To build a Members directory, use the shortcode <code>[bps_directory]</code>, see the [Custom Directories](http://dontdream.it/bp-profile-search/custom-directories/) tutorial.

A detailed documentation is available on the [BP Profile Search](http://www.dontdream.it/bp-profile-search/) page.

Requires at least BuddyPress 2.4 -- Tested up to BuddyPress 4.1.0

== Installation ==

See the standard installation procedure, in [Managing Plugins](https://codex.wordpress.org/Managing_Plugins).

== Screenshots ==

1. The Profile Search Forms admin page
2. The Edit Form admin page
3. Configuration of a Profile Search widget
4. The Members directory page with a Profile Search widget
5. The Members directory page with search results

== Changelog ==

= 4.9.7 =
* Fixed workaround to prevent a theme conflict
= 4.9.6 =
* Minor adjustment to the bps-form-default template
* Workaround to prevent a plugin conflict
= 4.9.5 =
* Restored the bps-form-nouveau template, following user requests
= 4.9.4 =
* Fixed CSS bug with bps-form-default
* Fixed bug with the Member Type search field
= 4.9.3 =
* Added support for AND and OR expressions in search fields
* Retired the bps-form-nouveau template, replaced by bps-form-default
= 4.9.2 =
* Fixed bug introduced in 4.9.1 affecting older form templates
* Added admin error notice when BuddyPress with *Extended Profiles* is not active
= 4.9.1 =
* Fixed PHP Warnings in form templates
* Fixed bug in WPML support
= 4.9 =
* Introduced a new default form template, to gradually replace older templates
* See [Form Templates](http://dontdream.it/bp-profile-search/form-templates/) for details
= 4.8.6 =
* Added search by user taxonomies (including BP member types)
* Added column in the *Search Forms* page showing the current template and its location
= 4.8.5 =
* Added choice of jQuery UI theme for the bps-form-nouveau template
= 4.8.4 =
* Added ability to search by data in the *usermeta* table
* See [BP Profile Search 4.8.4](http://dontdream.it/bp-profile-search-4-8-4/) for details
= 4.8.3 =
* Added a new form template compatible with BuddyPress Nouveau
* Revised the plugin's contextual help
* The shortcode [bps_directory] still doesn't work with BuddyPress Nouveau
* See [BP Profile Search 4.8.3](http://dontdream.it/bp-profile-search-4-8-3/) for details
= 4.8.2 =
* Fixed issue when calling a template inside a template
= 4.8.1 =
* Added ability to search by data in the *users* table
* Added option to enable or disable *persistent search*
* Removed the old interface for custom field types
* See [BP Profile Search 4.8.1](http://dontdream.it/bp-profile-search-4-8-1/) for details
= 4.8 =
* Introduced *hidden filters* for custom directories, see [Custom Directories](http://dontdream.it/bp-profile-search/custom-directories/)
* Developers: please switch to the [new interface for custom field types](http://dontdream.it/bp-profile-search/custom-profile-field-types/)
= 4.7.9 =
* Introduced new search mode *is one of*
= 4.7.8 =
* Improved display of the active filters
* For developers: [new interface for custom field types](http://dontdream.it/bp-profile-search/custom-profile-field-types/)
= 4.7.7 =
* No longer clears the search when leaving the members directory
* Removed PHP Warning during first activation
* Added HTML class to forms in form templates
* Added configuration file for WPML
= 4.7.6 =
* Fixed bug with custom field types introduced in 4.7.5
= 4.7.5 =
* Moved the search mode selection to the field level
= 4.7.4 =
* Fixed bugs in WPML support
= 4.7.3 =
* Added filter to change the cookie name
= 4.7.2 =
* Fixed bug with custom field types introduced in 4.7.1
= 4.7.1 =
* Modified the *Form Fields* settings UI to enable further development
= 4.7 =
* Added ability to sort a Members directory using a profile field
* See [BP Profile Search 4.7](http://dontdream.it/bp-profile-search-4-7/) for details
= 4.6.3 =
* Added support for WPGlobus
* Updated templates for the *Twenty Seventeen* theme
* Added the plugin icon - by Alexei Ryazancev
= 4.6.2 =
* Added ability to search for member types
* Added the filters *bps_clear_search* and *bps_match_all*
= 4.6.1 =
* Added support for member-type directories
* Updated templates to allow member-type directories as results pages
= 4.6 =
* Removed insecure code - thanks to Robert Rowley at pagely.com
= 4.5.3 =
* Fixed hardcoded strings in a form template
= 4.5.2 =
* Fixed bug in *Age Range* display introduced in version 4.5
* Fixed bug in label display introduced in version 4.5.1
= 4.5.1 =
* Fixed order of search conditions in directory pages
* Improved support for WPML
= 4.5 =
* Added generic search field to search every profile field
= 4.4.4 =
* Added basic support for WPML
= 4.4.3 =
* Fixed the *Form Action (Results Directory)* drop down list
= 4.4.2 =
* Fixed bug with member-type specific fields
= 4.4.1 =
* Fixed bug in wildcard searching
= 4.4 =
* Updated to use WP language packs
= 4.3.1 =
* Fixed rendering of hidden fields in form templates
= 4.3 =
* Updated templates to better support custom field types
* Updated [documentation](http://dontdream.it/bp-profile-search/custom-profile-field-types/) for custom field types authors
= 4.2.4 =
* Updated for WordPress 4.3
= 4.2.3 =
* Restricted capability to create forms to admin only
* Added the filters *bps_form_order* and *bps_form_caps*
* Changed the name of a few functions
= 4.2.2 =
* Updated templates to work in member-type directories
= 4.2.1 =
* Fixed bug when searching in a *multiselectbox* profile field type
= 4.2 =
* Added ability to use form templates
= 4.1.1 =
* Fixed bug with field labels containing quotes
= 4.1 =
* Added ability to create custom Members directory pages
* Added ability to use them as custom search results pages
= 4.0.3 =
* Fixed PHP fatal error when BP component *Extended Profiles* was not active
* Replaced deprecated like_escape()
= 4.0.2 =
* Fixed PHP warning when using the *SAME* search mode
= 4.0.1 =
* Fixed bug with field options not respecting sort order
* Fixed bug with search strings containing ampersand (&)
= 4.0 =
* Added support for multiple forms
* Added ability to export/import forms
* Added selection of the form *method* attribute
* Updated Italian and Russian translations
= 3.6.6 =
* Added French translation
= 3.6.5 =
* Fixed bug when searching in a *number* profile field type
= 3.6.4 =
* Added support for custom profile field types, see [documentation](http://dontdream.it/bp-profile-search/custom-profile-field-types/)
= 3.6.3 =
* Reduced the number of database queries
= 3.6.2 =
* Updated for the *number* profile field type (BP 2.0)
= 3.6.1 =
* Fixed PHP warnings after upgrade
= 3.6 =
* Redesigned settings page, added Help section
* Added customization of field label and description
* Added *Value Range Search* for multiple numeric fields
* Added *Age Range Search* for multiple date fields
* Added reordering of form fields
* Updated Italian translation
* Updated Russian translation
= 3.5.6 =
* Replaced deprecated $wpdb->escape() with esc_sql()
* Added *Clear* link to reset the search filters
= 3.5.5 =
* Fixed the CSS for widget forms and shortcode generated forms
= 3.5.4 =
* Added Serbo-Croatian translation
= 3.5.3 =
* Added Spanish, Russian and Italian translations
= 3.5.2 =
* Fixed a pagination bug introduced in 3.5.1
= 3.5.1 =
* Fixed a few conflicts with other plugins and themes
= 3.5 =
* Added the *Add to Directory* option
* Fixed a couple of bugs with multisite installations
* Ready for localization
* Requires BuddyPress 1.8 or higher
= 3.4.1 =
* Added *selectbox* profile fields as candidates for the *Value Range Search*
= 3.4 =
* Added the *Value Range Search* option - thanks to Florian Shießl
= 3.3 =
* Added pagination for search results
* Added searching in the *My Friends* tab of the Members directory
* Removed the *Filtered Members List* option in the *Advanced Options* tab
* Requires BuddyPress 1.7 or higher
= 3.2 =
* Updated for BuddyPress 1.6
* Requires BuddyPress 1.6 or higher
= 3.1 =
* Fixed the search when field options contain trailing spaces
* Fixed the search when field type is changed after creation
= 3.0 =
* Added the *Profile Search* widget
* Added the [bp_profile_search_form] shortcode
= 2.8 =
* Fixed the *Age Range Search*
* Fixed the search form for required fields
* Removed field descriptions from the search form
* Requires BuddyPress 1.5 or higher
= 2.7 =
* Updated for BuddyPress 1.5 multisite
* Requires BuddyPress 1.2.8 or higher
= 2.6 =
* Updated for BuddyPress 1.5
= 2.5 =
* Updated for BuddyPress 1.2.8 multisite installations
= 2.4 =
* Added the *Filtered Members List* option in the *Advanced Options* tab
= 2.3 =
* Added the choice between *Partial match* and *Exact match* for text searches
= 2.2 =
* Added the *Age Range Search* option
= 2.1 =
* Added the *Toggle Form* option to show/hide the search form
* Fixed a bug where no results were found in some installations
= 2.0 =
* Added support for *multiselectbox* and *checkbox* profile fields
* Added support for % and _ wildcard characters in text searches
= 1.0 =
* First version released to the WordPress Plugin Directory

== Upgrade Notice ==

= 4.6 =
Security release, please update immediately!

= 4.3 =
Note: If you, or your theme, are using a modified 4.2.x template, you have to edit and update it to the current template structure before upgrading. If you haven't modified the built-in templates instead, you can upgrade safely.

= 4.1 =
Note: If you are upgrading from version 4.0.x, you have to update your existing forms adding your directory page selection. Go to *Users -> Profile Search*, *Edit* each form, select its *Form Action (Results Directory)* and *Update*.

= 4.0 =
Note: BP Profile Search version 4 is not compatible with version 3. When you first upgrade to version 4, you have to reconfigure your BP Profile Search forms and widgets, and modify any BP Profile Search shortcodes and *do_action* codes you are using.
In a multisite installation, the BP Profile Search settings page is in the individual Site Admin(s), and no longer in the Network Admin.
