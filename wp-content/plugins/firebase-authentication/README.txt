=== Firebase Authentication ===
Contributors: cyberlord92
Donate link: https://miniorange.com
Tags: firebase, authentication, login, sso, jwt, social login, OTP verification, firebase otp, woocommerce, woocommerce integration
Requires at least: 3.0.1
Tested up to: 5.9
Stable tag: 1.5.4
License: MIT/Expat
License URI: https://docs.miniorange.com/mit-license

This plugin allows login into WordPress using Firebase user credentials and maps Firebase user data to WordPress user profile.

== Description ==

This plugin allows you to login or Single Sign-On (SSO) into WordPress site using your Firebase user login credentials or via Social Login.
Firebase authentication works using default WordPress login page. Also, we support <a href="https://plugins.miniorange.com/firebase-woocommerce-integration/" target="_blank">Firebase WooCommerce Integration</a> and other third-party login pages along with custom login forms.

= Features =
*	**Firebase Authentication** : WordPress login / SSO using Firebase user login credentials
*	**Auto Create Users** : After login using Firebase login credentials, new user automatically gets created in WordPress
*	**Configurable login options** :
	Provide option to login with,
	a) Only Firebase credentials
	b) Only WordPress credentials
	c) Both Firebase and WordPress credentials
*	**Auto Register WooCommerce Users to Firebase** : Provide an option to sync a WordPress user to Firebase whenever an end-user registers into the WordPress site via the WooCommerce registration form. User is created in Firebase with only email address and password.
*	**Support for Firebase Phone Authentication method** : Users will be asked to enter OTP provided via Firebase to login into WordPress (Passwordless login).
*	**Support for Firebase Social Login** : Users will be provided an option to login in to WordPress using selected social login providers
	Providers supported are
	1. Google
	2. Facebook
	3. Github
	4. Twitter
	5. Apple
	6. Yahoo
	7. Microsoft
*	**Support for Social Login buttons Shortcode** : Use a shortcode to place Firebase social login buttons anywhere in your Theme or Plugin
*	**Sync Firebase UID to WordPress** : Users can map email, Firebase user-id to their WordPress user profile using this WordPress Firebase Authentication feature.
*	**Custom Redirect Login and Logout URL** : Automatically Redirect users after successful login/logout.
*	**Support for Firebase Login and Registartion form Shortcode** : Using login form shortcode, users can enter their Firebase credentials to login into the WP site, and using the registration form shortcode, users can register into the WordPress site, and that user is also auto created in Firebase with an email address and password.
*	**WP Hooks for Different Events** : Provides support for different hooks for user defined functions.
*	**Firebase WooCommerce Integration** : Integrate WooCommerce with the WordPress Firebase Authentication plugin and allow users to log in to your WooCommerce site using firebase login credentials on WooCommerce Checkout and My account page.

== Installation ==

1. Visit `Plugins > Add New`
2. Search for `firebase authentication`. Find and Install `firebase authentication` plugin by miniOrange
3. Activate the plugin

== Frequently Asked Questions ==
= I need help to configure the plugin? =
Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= I am locked out of my account and can't login with either my WordPress credentials or Firebase credentials. What should I do? =
Firstly, please check if the `user you are trying to login with` exists in your WordPress. To unlock yourself, rename the firebase-authentication plugin name. You will be able to login with your WordPress credentials. After logging in, rename the plugin back to firebase-authentication. If the problem persists, `activate, deactivate, and again activate` the plugin.

= For support or troubleshooting help =
Please email us at info@xecurify.com or <a href="https://miniorange.com/contact" target="_blank">Contact us</a>.

== Screenshots ==

1. Configure Firebase Authentication plugin
2. Option to allow WP Administrators to login
3. The result after successful Test Authentication

== Changelog ==

= 1.5.4 =
* Added compatibility with WP 5.9
* UI changes and minor bug fixes

= 1.5.3 =
* Added functionality for requesting the demo

= 1.5.2 =
* Readme changes
* Minor updates in pricing plans

= 1.5.1 =
* Minor Security Fixes

= 1.5.0 =
* Improvements in the flow of wp-login with firebase credentials
* Minor UI changes

= 1.4.8 =
* Added compatibility with WP 5.8
* Minor UI changes

= 1.4.7 =
* Minor UI changes
* Readme changes

= 1.4.5 =
* Readme changes

= 1.4.4 =
* Added compatibility with WP 5.7

= 1.4.3 =
* UI changes

= 1.4.2 =
* Minor bug fixes
* Small UI changes

= 1.4.1 =
* Minor changes

= 1.4.0 =
* Added compatibility with WP 5.6
* UI changes
* SEO changes

= 1.3.7 =
* Readme changes

= 1.3.6 =
* Added compatibility with WP 5.5

= 1.3.5 =
* Some bug fixes

= 1.3.4 =
* Some bug fixes

= 1.3.3 =
* Readme changes

= 1.3.2 =
* UI changes
* Pricing Plan updates

= 1.3.1 =
* Bug Fixes

= 1.3.0 =
* Added Licensing plans
* Added registration

= 1.2.0 =
* Advertised features on UI
* Added Bug Fixes

= 1.1.4 =
* Added compatibility with WordPress 5.4

= 1.1.3 =
* Added step by step guide link

= 1.1.2 =
* Plugin deactivation form

= 1.1.1 =
* Configurable option to allow WP login only to Administrators

= 1.0.0 =
* Initial release

== Upgrade Notice ==