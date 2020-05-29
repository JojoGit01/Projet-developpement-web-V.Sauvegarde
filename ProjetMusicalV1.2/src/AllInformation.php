<?php
//Creator : Jonathan
// Fichier qui est un extend //
// Fichier important pour afficher les albums/artiste/chanson //
namespace App;
use PDO;
class AllInformation{

    protected $query, $queryCount, $params, $sortable;
    public function __construct () {
        $this->query = $query;
        $this->queryCount = $queryCount;
        $this->params = $params;
        $this->sortable = $sortable;
    }

    // Variable for all
    private static $PER_PAGE = 10;
    public static $page;
    public static $pages;

    //Function important
    protected function seekAAC($q, $nomR, $prenomR, $titreR) {
        if(!empty($q)) {
            $this->query .= " WHERE $nomR like :$nomR OR $prenomR like :$prenomR OR $titreR like :$titreR";
            $this->queryCount .= " WHERE $nomR like :$nomR OR $prenomR like :$prenomR OR $titreR like :$titreR";
            $this->params[$nomR] = '%' . $q . '%';
            $this->params[$prenomR] = '%' . $q . '%';
            $this->params[$titreR] = '%' . $q . '%';
        }
    }

    protected function getInformation($sort, $dir, $p, $pdo) {
        self::organisation($sort, $dir);
        self::perPage($p);
        $statement = $pdo->prepare($this->query);
        $statement->execute($this->params);
        $postS = $statement->fetchAll();
        return $postS;
    }

    protected function organisation($sort, $dir) {
        if(!empty($sort) && in_array($sort, $this->sortable)){
            $direction = $dir ?? 'asc';
            if(!in_array($direction, ['asc', 'desc'])){
                $direction = 'asc';
            }
            $this->query .= " ORDER BY " . $sort . " $direction";
        }
    }

    protected function perPage($p) {
        self::$page = (int)($p ?? 1);
        $offset = (self::$page - 1) * self::$PER_PAGE;
        $this->query .= " LIMIT " . self::$PER_PAGE . " OFFSET $offset";
    }

    protected function perPages(PDO $pdo, $code){
        $statement = $pdo->prepare($this->queryCount);
        $statement->execute($this->params);
        $count = (int)$statement->fetch()->$code;
        self::$pages = ceil($count / self::$PER_PAGE); 
    }
}