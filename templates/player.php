<script type="text/javascript" charset="utf-8">
	soundManager.setup({
		url: '$path_to_swf',
		onready: function() {
			var mySound = soundManager.createSound({
			id: 'btnplay_$ids',
			volume: '$volume',
			url: '$fileurl'
			});
			var auto_loop = '$loops';
			mySound.play({
					onfinish: function() {
					if(auto_loop == 'true'){
						loopSound('btnplay_$ids');
					}
					else{
						document.getElementById('btnplay_$ids').style.display = 'inline';
						document.getElementById('btnstop_$ids').style.display = 'none';
					}
					}
			});
			document.getElementById('btnplay_$ids').style.display = 'none';
									document.getElementById('btnstop_$ids').style.display = 'inline';
		},
		ontimeout: function() {
			// SM2 could not start. Missing SWF? Flash blocked? Show an error.
			alert('Error! Audio player failed to load.');
		}
	});
</script>
