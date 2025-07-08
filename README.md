phpBB Incubator Extension
=========================

Incubate topics on one board until they're ready to hatch into another.

Install
-------

Download the [latest release][latest-release] and unzip in your `ext/` directory.

[latest-release]: https://raw.githubusercontent.com/chloe-vee/incubator/refs/heads/main/releases/ra-incubator.0.1.2.zip

Usage
-----

* In the ACP under Extensions, there is a settings page for the Incubator module.
* Select the forum you wish to migrate posts from, the forum you wish to
  migrate to, and the number of days before migrating.

Limitations
-----------

* Topics are moved based on the time the topic was **created**, not the last
  time it was moved.
* You can only set up the incubator for one from/to forum combination for now.
* There is no UI for removing or disabling the incubator for now, but clearing
  the config values in the DB should do it.
  `UPDATE phpbb_config SET config_value = '' WHERE config_name = 'incubator_from_forum';` \
  `UPDATE phpbb_config SET config_value = '' WHERE config_name = 'incubator_to_forum';` \
  `UPDATE phpbb_config SET config_value = '' WHERE config_name = 'incubator_days';`
