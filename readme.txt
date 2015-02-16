=== Quatriceps ===
Contributors: pmagunia
Tags: math,education,shortcode,arithmetic,learning
Requires at least: 3.9.2
Tested up to: 4.1
License: GPLv2  or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Mathematics problem/solution generator

== Description ==

Quatriceps is a mathematics API for generating solutions to basic arithmetic problems. This plugin allows easy setup of Quatricep blocks on a Wordpress blog for student use.

When a student requests a solution, a LaTeX image file is compiled with the `xlop` package and retrieved from a Tetragy server. Currently, only the four basic binary operations are supported. Tetragy welcomes requests for new operations that may be specific to an organization.

Addition is displayed with carries. Displaying carries with subtraction is optional. Multiplication and division are displayed 'longhand'.

== Installation ==

A Tetragy ID is necessary and may be obtained from https://tetragy.com/. Accounts are necessary to allocate resources and prevent abuse of user and network services.

1. Download and unzip the Wordpress Quatriceps zip file to your `/wp-content/plugins/` directory.
2. Whitelist your server IP addresses or disable enforcing at https://math.tetragy.com/user.
3. Visit the Quatriceps settings page of your Wordpress site to configure your ID.
4. Use Shortcode in your posts to include a Quatriceps operation. For example: `[quatriceps com="addition"]`. For additional information about Shortcode visit http://codex.wordpress.org/Shortcode.

== Frequently Asked Questions ==

= Can I try out the service ? =

Yes, users are alloted free points every month and may purchase additional points if necessary.

= Do I need to install anything else on my server ? =

No, Wordpress and the Quatriceps plugin are the only software requirements.

= How do I prevent spam submissions ? =

With Recaptcha you can help prevent spam and other abuse of your Tetragy account. Configure the public and private key settings to automatically add a Recaptcha form to all your widgets.

= Why is it recommended to whitelist my IP address ? =

To prevent unauthorized use of your Tetragy account. If IP enforcing is disabled, all requests made with your numeric ID will be deducted from your account. By default, enforcing is enabled.

= Where can I try a demo ? =

http://wp.tetragy.com/quatriceps


References

- http://www.latex-project.org
- http://www.ctan.org/pkg/xlop
- http://www.google.com/recaptcha
- https://math.tetragy.com

Attribution

xlop LaTeX package copyrighted by Jean-Come Charpentier

== Screenshots ==

1. Addition operation
2. Subtraction operation
3. Multiplication operation
4. Division operation
5. PDF output
6. Quatriceps UI
7. Quatriceps Shortcode syntax for including operation on a page or post

== Changelog ==

= 1.1.0 =
New operations: lcm
Bug fixes:

= 1.0.0 =
* Override packaged CSS and JS files

= 0.1.1 =
* Cosmetics

= 0.1.0 =
* Initial commit

== Upgrade Notice ==

= 1.1.0 =
New operations

= 1.0.0 =
Allows overriding CSS and JS files. No bug fixes or cosmetic changes.

= 0.1.1 =
No bug fixes, No new features, minor cosmetic changes
