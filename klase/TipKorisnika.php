<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';

class TipKorisnika
{
    public $id;
    public $naziv_tipa;

    public static function vratiSveTipove()
    {
        $db = Database::getInstance();
        return $db->select('TipKorisnika', 'select * from tipovi_korisnika');
    }

    // administrator kreira novi tip korisnika
    public static function kreirajTip($naziv_tipa)
    {
        $db = Database::getInstance();
        $db->insert(
            'TipKorisnika',
            'insert into tipovi_korisnika (naziv_tipa) values (:n)',
            [
                ':n' => $naziv_tipa
            ]
        );
        return $db->lastInsertId();
    }

    // administrator menja tip korisnika
    public static function menjajTip($naziv_tipa, $id)
    {
        $db = Database::getInstance();
        $db->update(
            'TipKorisnika',
            'update tipovi_korisnika set naziv_tipa = :n where id = :id',
            [
                ':n' => $naziv_tipa,
                ':id' => $id
            ]
        );
    }

    // administrator brise tip korisnika
    public static function obrisiTip($id)
    {
        $db = Database::getInstance();
        $db->delete(
            'delete from tipovi_korisnika where id = :id',
            [
                ':id' => $id
            ]
        );
    }
}