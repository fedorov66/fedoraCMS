<?
class Sitemap {
	
	protected $rootPath;
	protected $appPath;
	protected $pageId;
	protected $sectionId;
	protected $dbc;
	protected $navElements;
	protected $navArray;
	
	public function __construct($rootPath, $appPath, $dbc) {
		$this->dbc = $dbc;
		$this->rootPath = $rootPath;
		$this->appPath = rtrim($appPath, '/');
		
		$this->resolveSectionId();
		$this->resolvePageId();
		$this->buildNavigation();
				
	}
	
	private function resolveSectionId() {
		if ($this->appPath != '') {
			$pathLevels = explode("/", $this->appPath);
			$pathDepth = sizeof($pathLevels);
			$pathName = $pathLevels[$pathDepth - 1];
			$this->sectionId =  $this->dbc->getOne('SELECT section_id FROM sitemap_tree WHERE section_level = ?i AND section_path_name = ?s', $pathDepth, $pathName);
		} else {
			$this->sectionId = 1;
		}
	}
	
	private function resolvePageId() {
	    $this->pageId = $this->dbc->getOne('SELECT page_id FROM sitemap_tree WHERE section_id = ?i', $this->sectionId);
	}

	private function buildNavigation() {
		$this->navElements = [];
		$this->navArray = [];
		$prevLevelPaths = [];
	
		$tree_params = array(
			'table' => 'sitemap_tree',
			'id' => 'section_id',
			'left' => 'section_left',
			'right' => 'section_right',
			'level' => 'section_level'
		);
		
		$dbtree = new DbTreeExt($tree_params, $this->dbc);
		$ajar = $dbtree->Ajar($this->getSectionId(), array('page_id', 'section_id', 'section_level', 'section_name', 'section_path_name'));
	
		$prevLevel = 0;
		$prevSectionId = [];
		foreach ($ajar as $item) {
			$curLevel = $item['section_level'] - 1;
			if (array_key_exists($curLevel - 1, $prevLevelPaths)) {
				$fullPath = implode('/', array_slice($prevLevelPaths, 0, $curLevel)).'/'.$item['section_path_name'];
			} else {
				$fullPath = $item['section_path_name']; 
			}
			$prevLevelPaths[$curLevel] = $item['section_path_name'];
			$parentId = 0;

			if ($curLevel > 0) {
				if ($curLevel > $prevLevel) {
					$parentId = $prevSectionId[$prevLevel];
				} else if ($curLevel < $prevLevel || $curLevel == $prevLevel) {
					$parentId = $prevSectionId[$curLevel - 1];
				}
			}
			$navElement = new NavELement($item['page_id'], $item['section_name'], $item['section_level'], $parentId, $item['section_path_name'], $this->rootPath.$fullPath);
			$this->navElements[$navElement->getRootPath()] = $navElement;
			
			$navEl['id'] = $navElement->getId();
			$navEl['parent_id'] = $navElement->getParentId();
			$navEl['path'] = $navElement->getRootPath();
			$navEl['name'] = $navElement->getName();
			$navEl['level'] = $navElement->getLevel();
			$navEl['isCurrent'] = $navElement->getRootPath() == $this->rootPath.$this->appPath;
			$this->navArray[] = $navEl;
			
			$prevSectionId[$curLevel] = $item['section_id'];
			$prevLevel = $curLevel;
		}
		
		$this->navArray = self::buildTree($this->navArray);
		$this->navElements;
	}
	
	public function getSectionId() {
		return $this->sectionId;
	}
	
	public function getPageId() {
	    return $this->pageId;
	}
	
	public function getNavElements() {
		return $this->navElements;
	}
	
	public function getNavArray() {
		return $this->navArray;
	}
	
	public function buildTree(array $elements, $parentId = 0) {
		$branch = array();
		foreach ($elements as $element) {
			if ($element['parent_id'] == $parentId) {
				$children = self::buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}
		return $branch;
	}
		
}

class NavElement {
	
	private $id;
	private $name;
	private $level;
	private $pathName;
	private $parentId;
	private $rootPath;
	
	public function __construct($id, $name, $level, $parentId, $pathName, $rootPath) {
		$this->id = $id;
		$this->name = $name;
		$this->level = $level;
		$this->parentId = $parentId;
		$this->pathName = $pathName;
		$this->rootPath = $rootPath;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->name;
	}

	public function getLevel() {
		return $this->level;
	}
	
	public function getParentId() {
		return $this->parentId;
	}
	
	public function getPathName() {
		return $this->pathName;
	}
	
	public function getRootPath() {
		return $this->rootPath;
	}
	
	
}

?>