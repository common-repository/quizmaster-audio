<?php
/*
Plugin Name: QuizMaster Audio
Plugin URI: http://wordpress.org/extend/plugins/quizmaster-audio
Description: Provides better audio support for questions including compact audio player
Version: 0.1.0
Author: GoldHat Group
Author URI: https://goldhat.ca
Copyright: GoldHat Group, Tips and Tricks HQ
Text Domain: quizmaster-audio
*/

define( 'QUIZMASTER_AUDIO_VERSION', '0.1.1' );
define( 'QUIZMASTER_AUDIO_TEMPLATES_PATH', plugin_dir_path( __FILE__ ) . "templates/" );
define( 'QUIZMASTER_AUDIO_ASSETS_PATH', plugin_dir_path( __FILE__ ) . "assets/" );
define( 'QUIZMASTER_AUDIO_ASSETS_URL', plugin_dir_url( __FILE__ ) . "assets/" );

class QuizMaster_Audio_Plugin {

	public function __construct() {
		$this->init();
	}

	public function init() {

		add_filter('quizmaster_extension_registry', array( $this, 'registerExtension' ));
		add_action('init', array( $this, 'load'), 12);
		add_action('quizmaster_question_text_before', array( $this, 'renderAudio' ));

	}

	public function renderAudio( $question ) {
		if( is_array( $question->audioFile )) {
			print do_shortcode( '[quizmaster_audio_player fileurl="' . $question->audioFile['url'] . '"]' );
		}
	}

	public function load() {

		require_once( plugin_dir_path( __FILE__ ) . "lib/QuizMaster_Audio_Player.php" );
		require_once( plugin_dir_path( __FILE__ ) . "lib/QuizMaster_Extension_Audio.php" );
		new QuizMaster_Extension_Audio();
		new QuizMaster_Audio_Player();

	}

	public function registerExtension( $registeredExtensions ) {

		$registeredExtensions['audio'] = array(
			'type' => 'ext',
			'name' => 'Audio',
		);

	}

}

new QuizMaster_Audio_Plugin();
