<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';

class Grupa
{
    public $id;
    public $naziv_grupe;

    public static function kreirajGrupu($naziv_grupe)
    {
        $db = Database::getInstance();
        $db->insert('Grupa', 'insert into grupe_zadataka (Naziv_grupe) value (:ng)', [
            ':ng' => $naziv_grupe
        ]);

        return $db->lastInsertId();
    }

    public static function vratiZaNaziv($naziv_grupe)
    {
        $db = Database::getInstance();
        $nazivi = $db->select('Grupa', 'select * from grupe_zadataka where Naziv_grupe = :ng', [
            ':ng' => $naziv_grupe
        ]);
        foreach ($nazivi as $naziv) {
            return $naziv;
        }
        return null;
    }


    public static function vratiSve()
    {
        $db = Database::getInstance();
        return $db->select('Grupa', 'select * from grupe_zadataka');
    }

    public static function izmeniGrupu($id, $naziv_grupe)
    {
        $db = Database::getInstance();
        $db->update(
            'Grupa',
            'update grupe_zadataka set naziv_grupe = :ng where id = :id',
            [
                ':ng' => $naziv_grupe,
                ':id' => $id
            ]
        );
    }

    public static function obrisiGrupu($id)
    {
        $db = Database::getInstance();
        $db->delete('delete from grupe_zadataka where id = :id', [
            ':id' => $id
        ]);
    }
}