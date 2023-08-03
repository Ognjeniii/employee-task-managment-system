<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/Grupa.php';
require_once __DIR__ . '/Komentar.php';

class Zadatak
{
    public $id;
    public string $naslov;
    public $opis_zadatka;
    public $lista_izvrsioca;
    public $rukovodilac;
    public $rok_izvrsenja;
    public $prioritet;
    public $grupa_zadatka_id;
    public $propratni_fajlovi;
    public $zavrsen;
    public $otkazan;

    public static function kreirajZadatak(
        $naslov,
        $opis_zadatka,
        $lista_izvrsioca,
        $rukovodilac,
        $rok_izvrsenja,
        $prioritet,
        $grupa_zadatka_id,
        $propratni_fajlovi
    ) {

        $db = Database::getInstance();

        $db->insert('Zadatak', 'insert into zadaci (naslov, opis_zadatka, lista_izvrsioca, rukovodilac, rok_izvrsenja, prioritet,
        grupa_zadatka_id, fajlovi) values (:naslov, :opis_zadatka, :lista_izvrsioca, :rukovodilac, :rok_izvrsenja, :prioritet,
        :grupa_zadatka_id, :propratni_fajlovi)', [
                ':naslov' => $naslov,
                ':opis_zadatka' => $opis_zadatka,
                ':lista_izvrsioca' => $lista_izvrsioca,
                ':rukovodilac' => $rukovodilac,
                ':rok_izvrsenja' => $rok_izvrsenja,
                ':grupa_zadatka_id' => $grupa_zadatka_id,
                ':prioritet' => $prioritet,
                ':propratni_fajlovi' => $propratni_fajlovi
            ]);

        return $db->lastInsertId();
    }

    // metoda pomocu koje rukovodilac menja zadatak
    public static function izmeniZadatak(
        $naslov,
        $opis_zadatka,
        $lista_izvrsioca,
        $rok_izvrsenja,
        $prioritet,
        $grupa_zadatka_id,
        $propratni_fajlovi
    ) {

        $db = Database::getInstance();

        $db->update('Zadatak', 'update zadaci set opis_zadatka = :o , lista_izvrsioca = :l, rok_izvrsenja = :r, 
        prioritet = :p, grupa_zadatka_id = :g, fajlovi = :pf where naslov like :n', [
                ':o' => $opis_zadatka,
                ':l' => $lista_izvrsioca,
                ':r' => $rok_izvrsenja,
                ':p' => $prioritet,
                ':g' => $grupa_zadatka_id,
                ':pf' => $propratni_fajlovi,
                ':n' => $naslov
            ]);
    }

    // metoda pomocu koje administrator menja zadatak
    public static function izmeniZadatakAdmin(
        $naslov,
        $opis_zadatka,
        $lista_izvrsioca,
        $rukovodilac,
        $rok_izvrsenja,
        $prioritet,
        $grupa_zadatka_id,
        $propratni_fajlovi
    ) {

        $db = Database::getInstance();

        $db->update('Zadatak', 'update zadaci set opis_zadatka = :o , lista_izvrsioca = :l, rukovodilac = :ru, rok_izvrsenja = :r, 
        prioritet = :p, grupa_zadatka_id = :g, fajlovi = :pf where naslov like :n', [
                ':o' => $opis_zadatka,
                ':l' => $lista_izvrsioca,
                ':ru' => $rukovodilac,
                ':r' => $rok_izvrsenja,
                ':p' => $prioritet,
                ':g' => $grupa_zadatka_id,
                ':pf' => $propratni_fajlovi,
                ':n' => $naslov
            ]);
    }

    // metoda pomocu koje rukovodilac brise zadatak
    public static function obrisiZadatak($id)
    {
        $db = Database::getInstance();
        $db->delete('delete from zadaci where id = :id', [
            ':id' => $id
        ]);
    }

    public static function vratiZaNaslov($naslov)
    {

        $db = Database::getInstance();
        $zadatak = $db->select(
            'Zadatak',
            'select * from zadaci where naslov like :n',
            [
                ':n' => $naslov
            ]
        );
        foreach($zadatak as $z)
        {
            return $z;
        }
        return null;
    }

    public static function vratiZaNaslovPronalazenje($naslov)
    {

        $db = Database::getInstance();
        return $db->select(
            'Zadatak',
            'select * from zadaci where naslov like :n',
            [
                ':n' => $naslov
            ]
        );
    }

    public static function vratiSveGrupe()
    {
        return Grupa::vratiSve();
    }

    public static function vratiSveZadatke()
    {
        $db = Database::getInstance();
        return $db->select('Zadatak', 'select * from zadaci');
    }

    // za rukovodioca odeljenja(pretrazivanje)
    public static function vratiZaPrioritet($prioritet)
    {
        $db = Database::getInstance();
        return $db->select('Zadatak', 'select * from zadaci where prioritet = :p', [
            ':p' => $prioritet
        ]);
    }

    public static function zavrsiZadatak($id_zadatka)
    {
        $db = Database::getInstance();
        $date = date("Y-m-d");
        return $db->update('Zadatak', 'update zadaci set zavrsen = :date where id = :id', [
            ':date'=>$date,
            ':id' => $id_zadatka
        ]);
    }

    public static function otkaziZadatak($id_zadatka)
    {
        $db = Database::getInstance();
        $date = date("Y-m-d");
        return $db->update('Zadatak', 'update zadaci set otkazan = :date where id = :id', [
            ':date'=>$date,
            ':id' => $id_zadatka
        ]);
    }

    public static function sortirajPoZavrsetku()
    {
        $db = Database::getInstance();
        $zadaci = $db->select('Zadatak', 'select * from zadaci order by zavrsen desc');
        return $zadaci;
    }

    public static function sortirajPoClanovima()
    {
        $db = Database::getInstance();
        $zadaci = $db->select('Zadatak', 'select * from zadaci order by lista_izvrsioca desc');
        return $zadaci;
    }

    public static function sortitajPoRukovodiocima()
    {
        $db = Database::getInstance();
        $zadaci = $db->select('Zadatak', 'select * from zadaci order by rukovodilac desc');
        return $zadaci;
    }

    public static function vratiZaZavrsetak($zavrsetak)
    {
        $db = Database::getInstance();
        $zadaci = $db->select('Zadatak', 'select * from zadaci where zavrsen = :z',
        [
            ':z' => $zavrsetak
        ]);
        return $zadaci;
    }

    public static function vratiZaRukovodioca($rukovodilac)
    {
        $db = Database::getInstance();
        $zadaci = $db->select('Zadatak', 'select * from zadaci where rukovodilac = :r',
        [
            ':r' => $rukovodilac
        ]);
        return $zadaci;
    }
}