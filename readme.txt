=== Quatriceps ===
Contributors: pmagunia
Tags: math,education,shortcode,arithmetic,learning
Requires at least: 3.9.2
Tested up to: 4.0
License: GPLv2  or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Mathematics problem/solution generator

== Description ==

Quatriceps is a mathematics API for generating basic problems and their solution. The Quatriceps Wordpress plugin allows easy setup of Quatriceps blocks on a Wordpress blog.

Custom problems may be requested by the student or they may be auto-generated. When the student requests the solution, a LaTeX image file is compiled and retrieved from a Tetragy server. Currently, only the four basic arithmetic binary operations are supported. Tetragy welcomes requests for new operations that may be specific to a user or organization. The current version of the plugin provides for the following operations:

- addition
- subtraction
- multiplication
- divivion

Addition is displayed with carries. Displaying carries with subtraction is optional. Multiplication and division are displayed 'longhand'.

== Installation ==

A Tetragy ID is necessary and may be obtained from https://tetragy.com/. Accounts are necessary to allocate resources and prevent abuse of user and network services. Links to the Tetragy Limited privacy policy and terms of service may be found at the bottom of tetragy.com and all subdomains.

1. Download and unzip the Wordpress Quatriceps zip file to your `/wp-content/plugins/` directory.
2. Whitelist your server IP addresses or disable enforcing at `math.tetragy.com/user`.
3. Visit the Quatriceps settings page of your Wordpress site to configure your ID.
4. Use Shortcode in your posts to include a Quatriceps operation. For example: `[quatriceps com="addition"]`.

== Frequently Asked Questions ==

1. How much does it cost ?

$0.00105 per request.

2. Can I try out the service ?

Yes, 250 points are granted with signup, and another 250 points are granted the first of every month. This should be enough for users to take advantage of a particular service without any purchase.

3. How does the point system work ?

Tetragy offers four distinct web services and uses a point system to create a digital currency between services. Points may be used for Caascade computation requests, Quatriceps learning problems, Quadstat statistical operations, or QuatraTeX document compiling.

4. Do I need to install anything else on my server ?

No, Wordpress and the Quatriceps plugin are the only software requirements. Configuring your Tetragy account with a dedicated IP address is recommended to prevent unauthorized use of your Tetragy ID.

5. How do I prevent spam submissions ?

With reCaptcha you can help prevent spam and other abuse of your Tetragy account. Configure the public and private key settings to automatically add a reCaptcha form to all your widgets. This plugin also includes support for choosing a reCaptcha themes.

6. Why is it recommended to whitelist my IP address ?

To prevent unauthorized use of your Tetragy account. If IP enforcing is disabled, all requests made with your numeric ID will be deducted from your account. By default, enforcing is enabled. Login and go to math settings to disable.

7. Where can I try a demo ?

http://wp.tetragy.com/quatriceps/


References

- http://maxima.sourceforge.net
- http://www.latex-project.org
- http://www.ctan.org/pkg/xlop
- http://www.google.com/recaptcha
- https://math.tetragy.com
- http://wp.tetragy.com/quatriceps/

== Screenshots ==

1. Addition operation
2. Subtraction operation
3. Multiplication operation
4. Division operation
5. PDF output

== Changelog ==

= 0.1 =
* Initial commit


== Upgrade Notice ==

