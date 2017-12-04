<?
require_once('Settings.php');
require_once('core/libs/dbtree/safemysql.class.php');
require_once('core/libs/dbtree/DbTree.class.php');
require_once('core/libs/dbtree/DbTreeExt.class.php');
require_once('Database.php');
require_once('Sitemap.php');
require_once('Template.php');

class App {
	
	private $pageData;
	private $sitemap;
	private $path;
	
	
	public function __construct($path) {
		$this->path = $path;
	}
	
	function testConnect() {
		$db = Database::getInstance();
		$dbc = $db->getConnection();
		$data = $dbc->getAll('SELECT * FROM sitemap');
		$pageData = $dbc->getAll('SELECT * FROM sitemap');
		foreach ($pageData as $row) {
			echo var_dump($row);
		}
		echo "OK";
	}
	
	function init($path) {
		
		/* init database connection */
		$db = Database::getInstance();
		$dbc = $db->getConnection();
		
		/* get sitemap */	
		$this->sitemap  = new Sitemap(S__RootPath, $this->path, $dbc);
		
				
		/* get pagedata*/
		$this->pageData = [];
		foreach ($dbc->getAll('SELECT * FROM pages WHERE id = ?i', $this->sitemap->getPageId()) as $row) {
			$this->pageData = json_decode($row['data']);
		}
		/*$stmt = $dbc->prepare('SELECT * FROM pages WHERE id=?');
		$stmt->execute([$this->sitemap->getNavigation()[$this->path]->getId()]);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$this->pageData = json_decode($row['data']);
		}*/

		/* close connection */
		$dbc = null;
		
	}
	
	public function getPath() {
		return $this->path;
	}
	
	public function getPageData() {
		return $this->pageData;
	}
	
	public function getSitemap() {
		return $this->sitemap;
	}
	
}

?>