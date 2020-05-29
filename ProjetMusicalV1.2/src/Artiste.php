<?php
//Creator : Jonathan
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
        
        self::seekAAC($q, "nomA", "prenomA", "null");
        $postS = self::getInformation($sort, $dir, $p, $pdo);
        self::perPages($pdo, "numA");
        
        return $postS;
    }

    public function selectImage(PDO $pdo) {
        $selectImg = $pdo->prepare("SELECT urlPhoto FROM artiste");
        $selectImg->execute();
        $image = $selectImg->fetchAll();
        return $image;
    }
}