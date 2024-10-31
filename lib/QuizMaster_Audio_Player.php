<?php

class QuizMaster_Audio_Player {

	public function __construct() {

		add_shortcode('quizmaster_audio_player', array( $this, 'sc_embed_player_handler'));
		add_action('init', array( $this, 'wp_sc_audio_init' ), 25);
		add_action('wp_footer', array( $this, 'scap_footer_code' ));

	}

	public function scap_footer_code() {

	    $debug_marker = "<!-- QuizMaster Audio v" . QUIZMASTER_AUDIO_VERSION . " -->";
	    	echo "\n${debug_marker}\n";
	    ?>

	    <script type="text/javascript">
	        soundManager.url = '<?php echo QUIZMASTER_AUDIO_ASSETS_URL; ?>swf/soundmanager2.swf';
	        function play_mp3(flg, ids, mp3url, volume, loops)
	        {
	            //Check the file URL parameter value
	            var pieces = mp3url.split("|");
	            if (pieces.length > 1) {//We have got an .ogg file too
	                mp3file = pieces[0];
	                oggfile = pieces[1];
	                //set the file URL to be an array with the mp3 and ogg file
	                mp3url = new Array(mp3file, oggfile);
	            }

	            soundManager.createSound({
	                id: 'btnplay_' + ids,
	                volume: volume,
	                url: mp3url
	            });

	            if (flg == 'play') {
	                soundManager.play('btnplay_' + ids, {
	                    onfinish: function() {
	                        if (loops == 'true') {
	                            loopSound('btnplay_' + ids);
	                        }
	                        else {
	                            document.getElementById('btnplay_' + ids).style.display = 'inline';
	                            document.getElementById('btnstop_' + ids).style.display = 'none';
	                        }
	                    }
	                });
	            }
	            else if (flg == 'stop') {
	                soundManager.pause('btnplay_' + ids);
	            }
	        }
	        function show_hide(flag, ids)
	        {
	            if (flag == 'play') {
	                document.getElementById('btnplay_' + ids).style.display = 'none';
	                document.getElementById('btnstop_' + ids).style.display = 'inline';
	            }
	            else if (flag == 'stop') {
	                document.getElementById('btnplay_' + ids).style.display = 'inline';
	                document.getElementById('btnstop_' + ids).style.display = 'none';
	            }
	        }
	        function loopSound(soundID)
	        {
	            window.setTimeout(function() {
	                soundManager.play(soundID, {onfinish: function() {
	                        loopSound(soundID);
	                    }});
	            }, 1);
	        }
	        function stop_all_tracks()
	        {
	            soundManager.stopAll();
	            var inputs = document.getElementsByTagName("input");
	            for (var i = 0; i < inputs.length; i++) {
	                if (inputs[i].id.indexOf("btnplay_") == 0) {
	                    inputs[i].style.display = 'inline';//Toggle the play button
	                }
	                if (inputs[i].id.indexOf("btnstop_") == 0) {
	                    inputs[i].style.display = 'none';//Hide the stop button
	                }
	            }
	        }
	    </script>
	    <?php
	}

	public function wp_sc_audio_init() {
    if (!is_admin()) {
      wp_register_script('scap.soundmanager2', QUIZMASTER_AUDIO_ASSETS_URL . 'js/soundmanager2-nodebug-jsmin.js');
      wp_enqueue_script('scap.soundmanager2');
      wp_register_style('scap.player', QUIZMASTER_AUDIO_ASSETS_URL . 'css/player.css');
      wp_enqueue_style('scap.player');
    }
	}

	public function sc_embed_player_handler($atts, $content = null) {

	    extract(shortcode_atts(array(
	        'fileurl' => '',
	        'autoplay' => '',
	        'volume' => '',
	        'class' => '',
	        'loops' => '',
				), $atts));

			// check for missing audio file
	    if (empty($fileurl)) {
	    	return '<div style="color:red;font-weight:bold;">Compact Audio Player Error! You must enter the mp3 file URL via the "fileurl" parameter in this shortcode. Please check the documentation and correct the mistake.</div>';
	    }
	    if (empty($volume)) {
	        $volume = '80';
	    }
	    if (empty($loops)) {
	        $loops = "false";
	    }
	    $ids = uniqid('', true);//uniqid();

	    $player_cont = '<div class="quizmaster-audio-player ' . $class . '">';
	    $player_cont .= '<input type="button" id="btnplay_' . $ids . '" class="myButton_play" onClick="play_mp3(\'play\',\'' . $ids . '\',\'' . $fileurl . '\',\'' . $volume . '\',\'' . $loops . '\');show_hide(\'play\',\'' . $ids . '\');" />';
	    $player_cont .= '<input type="button"  id="btnstop_' . $ids . '" style="display:none" class="myButton_stop" onClick="play_mp3(\'stop\',\'' . $ids . '\',\'\',\'' . $volume . '\',\'' . $loops . '\');show_hide(\'stop\',\'' . $ids . '\');" />';
	    $player_cont .= '<div id="sm2-container"><!-- flash movie ends up here --></div>';
	    $player_cont .= '</div>';

	    if (!empty($autoplay)) {
	      $path_to_swf = QUIZMASTER_AUDIO_ASSETS_URL . 'swf/soundmanager2.swf';

				$template_path = QUIZMASTER_AUDIO_ASSETS_URL . 'templates/';
				$player_cont .= quizmaster_parse_template( 'player.php',
					array(

					),
					$template_path,
					$template_path
				);
			}

	    return $player_cont;
	}

}
