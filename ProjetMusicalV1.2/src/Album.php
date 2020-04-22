<?php
namespace App;
use PDO;
class Album extends AllInformation{

    private $codeAlbum, $nomAL, $anneeSortie, $urlPochette;
    public function __construct () {}

    public function selectAlbum(PDO $pdo, $q, $sort, $dir, $p) {
        $this->query = "SELECT * FROM album";
        $this->queryCount = "SELECT COUNT(codeAlbum) as codeAlbum FROM album";
        $this->params = []; 
        $this->sortable = ["codeAlbum", "nomAL", "anneeSortie", "urlPochette"];

        self::seekAlbum($q, "nomAL");
        $postS = self::getInformation($sort, $dir, $p, $pdo);
        self::perPages($pdo, "codeAlbum");
        
        return $postS;
    }
}