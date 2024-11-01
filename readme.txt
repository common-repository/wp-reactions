=== wp-reactions ===
Contributors: flyingdev
Tags: feedback, polls
Requires at least: 2.7
Tested up to: 2.7.1
Stable tag: 0.6.6

wp-reactions is a plugin that allows blog authors to gather a reader's gut reaction after reading a post.

== Description ==

At it's core, wp-reactions is designed to encourage readers to leave some sort of feedback after reading a post on your blog. Instead/as well as leaving a comment, Reactions gives readers the option of providing their 'gut reaction' to a post by providing a form consisting of a list of author-specified terms that the user can choose from.

The list of terms that a user can choose from to describe their reaction can be modified by the author to fit the needs of the blog. As a specific example, the author of a link-blog may choose to get feedback on whether readers have already seen the content elsewhere. This information could then be used to determine 'freshness' of the links.

== Installation ==

1. unzip the plugin archive to your `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php the_reactions(); ?>` in your post template

== Frequently Asked Questions ==

= When I click one of the reaction checkboxes, nothing happens! What's wrong? =
This is probably occuring because the javascript that handles the click event hasn't been included. wp-reactions relies on the wp_head hook in order to include the javascript file. To remedy this, make sure that the code `<?php wp_head(); ?>` is included in before the `</head>` tag in your theme's `header.php` file.

== Screenshots ==

1. This is how the reactions appear on blog posts. The reactions are displayed alongside the number of times that reaction has been given.
2. This is the admin page for the reactions. Here you can add and remove reactions.

== Release Notes ==

* **0.6.6**: Fixed a bug where creating reactions on a fresh install would fail.
* **0.6.5**: Added pre-reaction text option to the admin page. Tidied up the form markup. Tweaked the retroactive updating (It won't run if no changes have been made to the reactions).
* **0.6**: Added CSS classes to reactions markup to allow easy styling. Saving plugin options now applies the changes to all posts retroactively.
* **0.5.1, 0.5.2**: Bug fixing to get the initial release to actually work.
* **0.5**: Initial public release. Basic functionality has been implemented.
