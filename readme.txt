=== Longer Login ("Remember Me" Extension) ===
Contributors: jtmorris
Donate link: http://longer-login.johnmorris.me/
Tags: login, remember, cookie, expiration, remember me
Requires at least: 4.1
Tested up to: 4.2.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Longer Login allows customizing the length of WordPress' "Remember Me" length. No more automatic
logouts every few days!


== Description ==
Do you use the "Remember Me" feature when logging in to your WordPress site? I know I do. 

Do you find it annoying when WordPress stops remembering you after a few days? I know I do.

Longer Login is a simple WordPress plugin that remedies this.  By default, WordPress automatically
forgets users after 14 days.  This plugin adds an option in your website's General Settings that
can change this expiration date.  There are numerous options ranging from 1 day to 1 year.

Change the setting, and the next time you, or any user on your site logs in with "Remember Me" checked,
WordPress will keep them logged in for that specified time.




= How Does It Work? =
To remember users, websites store a small piece of information in your web browser's memory.
This token of information is called an [HTTP cookie](wikipedia.org/wiki/HTTP_cookie). These 
cookies have an expiration date specified by the website.

By default, WordPress websites have their persistent login cookies expire after 14 days. This plugin
changes the length of time the cookie will survive. Instead of 14 days after login, you can make the
cookie live for as long as 1 year after login.


== Installation ==
= Using WordPress.org's Plugin Repository (recommended) =
1. Search for "Longer Login" in your WordPress "Add New" plugin section of your dashboard.
1. Install and activate the "[Longer Login](http://wordpress.org/plugins/longer-login/)" plugin by John Morris.


= Manually =
1. Download the latest version of Longer Login and upload the `longer-login.zip` file
in the Add New plugin section of your dashboard.
1. Activate the plugin through the "Plugins" menu in your WordPress admin section.


= From Source =
1. Visit the plugin's [GitHub repository](https://github.com/jtmorris/longer-login-plugin).
1. Select the branch you want to download (choosing a version branch is highly recommended (e.g. v1.0.0)).
1. Click the download ZIP button on the lower right side of the page.
1. Upload the contents of the longer-login-plugin-**branch name** directory to a directory
named 'longer-login' in your WordPress site's './wp-content/plugins/' directory.
1. Visit your WordPress site's Plugins menu in the admin section, and activate the newly listed
Longer Login plugin.


== Screenshots ==
1. Settings Page




== Changelog == 
= 1.0.0 =
* Initial version. No changes to report.


== Upgrade Notice ==
= 1.0.0 =
* Initial version. No changes to report.
