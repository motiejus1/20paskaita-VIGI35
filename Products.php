<?php 
// Veiksmus su produktais
include ("DatabaseManager.php");
class Product {

    public $total;
    public $products;
    public $limit;
    public $page;
    public $offset;
    public $pages;
    
    //parodys visus produktus
    public function index() {
        $db = new DatabaseManager();
        $this->total = $db->databaseCount("products");
        $this->limit = 15;
        $this->pages = ceil($this->total / $this->limit);
        $this->page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $this->offset = ($this->page - 1) * $this->limit;
        $this->products = $db->selectLimit('products', $this->offset, $this->limit );

        return $this->products;
    }

    
}