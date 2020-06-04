<?php 
//===================================================
// Name        : RechercheIn.php
// Author      : Jonathan
// Version     : Final
// Description : Class qui permet à un utilisateur de regarder les données comme il le souhaite par ordre croissant, décroissant, par nom, etc.
//===================================================
namespace App;
class RechercheIn {
    private const SORT_KEY = 'sort';
    private const DIR_KEY = 'dir';

    public static function sort(string $sortKey, string $label, array $data): string {
        $sort = $data[self::SORT_KEY] ?? null;
        $direction = $data[self::DIR_KEY] ?? null;
        $icon = "";
        if($sort === $sortKey){
            $icon = $direction === 'asc' ? "▲" : "▼";
        }
        $url = self::withParams($data, [
            'sort' => $sortKey,
            'dir' => $direction === 'asc' && $sort === $sortKey ? 'desc' : 'asc'
        ]);
        return <<<HTML
            <a href="?$url">$label $icon</a>
        HTML;
    } 
    public static function withParam(array $data, string $param, $value): string {
        return http_build_query(array_merge($data, [$param => $value]));
    }

    public static function withParams(array $data, array $params): string {
        return http_build_query(array_merge($data, $params));
    }
}