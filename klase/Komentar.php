<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';

class Komentar
{
    public $id;
    public $sadrzaj;

    public static function obrisiKomentar($id)
    {
        $db = Database::getInstance();
        return $db->delete('delete from komentari where id = :id', [
            ':id' => $id
        ]);
    }

    public static function dodajKomentar($sadrzaj, $id_zadatka)
    {
        $db = Database::getInstance();
        $db->insert('Komentar', 'insert into komentari (sadrzaj, id_zadatka) values (:sadrzaj, :id)', [
            ':sadrzaj' => $sadrzaj,
            ':id' => $id_zadatka
        ]);
        return $db->lastInsertId();
    }

    public static function vratiSveKomentare()
    {
        $db = Database::getInstance();
        return $db->select('Komentar', 'select * from komentari');
    }

    public static function menjajKomentar($id, $sadrzaj, $id_zadatka)
    {
        $db = Database::getInstance();
        $db->update('Komentar', 'update komentari set sadrzaj = :s, id_zadatka = :id_zadatka where id = :id', [
            ':s' => $sadrzaj,
            ':id_zadatka' => $id_zadatka,
            ':id' => $id
        ]);
    }

    public static function vratiZaId($id)
    {
        $db = Database::getInstance();
        $komentari = $db->select(
            'Komentar',
            'select * from komentari where id = :id',
            [
                ':id' => $id
            ]
        );
        foreach ($komentari as $komentar) {
            return $komentar;
        }
        return null;
    }
}