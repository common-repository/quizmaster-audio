=== QuizMaster Audio ===
Contributors: goldhat
Donate link: https://goldhat.ca/donate/
Tags: quizmaster, audio quizzes, quiz audio
Requires at least: 4.0
Tested up to: 4.7
Stable tag: 0.1.1
License: GPLv2 or later

Provides a compact audio player for QuizMaster and enables uploading an audio file as part of a question.

== Description ==

Provides a more compact audio player than the standard WP audio player. Provides an audio upload field for QuizMaster Questions. Audio uploaded to a quiz question is displayed alongside the question text or other question content. A shortcode is provided for additional audio integration. Developers can theme the audio player or move the player to a different part of the quiz question layout.

= Features =

* Player is very compact, takes up minimal horizontal space
* HTML5 compatible so the audio files embedded with this plugin will play on iOS devices
* Player code is based on a stable plugin, Compact Audio Player by Tips and Tricks
* Integrates seamlessly with QuizMaster and QuizMaster Pro (minimum version 0.5.0)
* Audio file upload field provided so that audio files can be defined separately from other question content
* Supports the following filetypes: mp3, mp4, wav, aac, wma
* Provides a shortcode [quizmaster_audio_player] that can be used anywhere

== Installation ==

1. Upload the "quizmaster-audio.zip" file via the WordPress's plugin uploader (Plugins -> Add New -> Upload)
2. Activate the plugin through the "Plugins" menu in Wordpress.

== Usage ==
Use the following shortcode to embed an audio file anywhere on your site

1. Create or edit an existing QuizMaster Question.
2. Upload an audio file at Question > Audio File (below the question content field)
3. Ensure your audio player loads when viewing the questions (if it doesn't see theme integration)

QuizMaster audio should work with any theme, but is only tested with TwentySeventeen. Rendering of the audio player happens through a hook from QuizMaster core, which must be found in your question templates. This would only apply if you've overridden the templates, perhaps using an older version of QuizMaster than did not include the "quizmaster_question_text_before" hook.

== Frequently Asked Questions ==

= Will my audio file work in all major browsers? =
Yes

== Credits ==

QuizMaster Audio Extension is developed by GoldHat Group, the official developer of QuizMaster.

QuizMaster Audio Extension contains code from the plugin Compact Audio Player. Many thanks to the developers at Tips & Tricks (https://www.tipsandtricks-hq.com/).

== Changelog ==

= 0.0.1 =
First release of QuizMaster Audio Extension.
