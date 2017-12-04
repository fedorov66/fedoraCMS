<?
require 'core/libs/vendor/autoload.php';
require_once('core/App.php');

/* get path :-) */
$path = isset($_GET['path']) ? $_GET['path'] : '/';

/* init Application */
$App = new App($path);
//$App->testConnect();
$App->init();

/* init templates engine */
$core = new Dwoo\Core();
$template = new Dwoo\Template\File(S__Templates.'index.tpl');
$data = new Dwoo\Data();

$data->assign('_header', 'Header');
$data->assign('_footer', 'Footer');
$data->assign('navigation', $App->getSitemap()->getNavArray());

/* fill page data */
foreach ($App->getPageData() as $key => $value) {
	$data->assign($key, $value);
}

echo $core->get($template, $data);

/*$template = new Template(S__Templates . 'index.tpl');
$template->set('Header', 'Header');
$template->set('Footer', 'Footer');
$template->set('Navigation', $App->getNavigation());

foreach ($App->getPageData() as $key => $data) {
	$template->set($key, $data);
}

echo $template->output();
*/


?>