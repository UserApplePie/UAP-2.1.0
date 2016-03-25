<?php
/**
 * Sample layout
 */

use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get();
?>

</div>

<!-- JS -->
<?php
Assets::js(array_merge(array(
	Url::templatePath() . 'js/jquery.js',
	'//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'
),isset($data['js']) ? $data['js'] : array()));
if(isset($data['ownjs'])){
	foreach($data['ownjs'] as $js){
		echo $js;
	}
}
//hook for plugging in javascript
$hooks->run('js');

//hook for plugging in code into the footer
$hooks->run('footer');
?>

</body>
</html>
