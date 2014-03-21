Gzip Alternatives EE Plugin
===========================

This plugin allows you to supply alternate paths for gzip enabled and non-gzip capable devices.

Here&#8217;s an example:

	<link rel="stylesheet" href="main.{exp:easy_gzip_alternatives normal='css' gzip='gz.css'}"/>

With gzip support, you’d get

	<link rel="stylesheet" href="main.gz.css"/>

Without gzip support, you’d get

	<link rel="stylesheet" href="main.css"/>
