<?php
namespace App;
use PDO;
class Artiste extends AllInformation{

    private $numA, $nomA, $prenomA, $urlPhoto, $biographie;
    public function __construct () {}

    public static $PER_PAGE = 10;
    public static $page;
    public static $pages;
    public function selectArtiste(PDO $pdo, $q, $sort, $dir, $p) {
        $this->query = "SELECT * FROM artiste";
        $this->queryCount = "SELECT COUNT(numA) as numA FROM artiste";
        $this->params = []; 
        $this->sortable = ["numA", "nomA", "prenomA", "urlPhoto", "biographie"];
        
        self::seekAlbum($q, "nomA");
        $postS = self::getInformation($sort, $dir, $p, $pdo);
        self::perPages($pdo, "numA");
        
        return $postS;
    }
}