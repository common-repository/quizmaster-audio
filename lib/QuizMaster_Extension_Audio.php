<?php

class QuizMaster_Extension_Audio extends QuizMaster_Extension {

	public function __construct() {

		add_filter('quizmaster_add_fields_after_qmqe_question', array( $this, 'addFields' ));

	}

	public function addFields( $fields ) {

		$fields[] = array (
			'key' => 'field_592f27f6183ad',
			'label' => 'Audio File',
			'name' => 'qmqe_audio_file',
			'type' => 'file',
			'instructions' => 'Include an audio file with your question. Audio player and placement determined by your theme.',
			'return_format' => 'array',
			'library' => 'all',
			'max_size' => 50,
			'mime_types' => 'mp3, mp4, wav, aac, wma',
		);

		return $fields;

	}

	public function getKey() {
		return 'audio';
	}


}
