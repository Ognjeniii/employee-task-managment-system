<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';

class Korisnik
{
    public $id;
    public $korisnicko_ime;
    public $lozinka;
    public $ime_prezime;
    public $email;
    public $broj_telefona;
    public $datum_rodjenja;
    public $tip_korisnika_id;

    public static function registracija(
        $korisnicko_ime,
        $lozinka,
        $ime_prezime,
        $email,
        $broj_telefona,
        $datum_rodjenja
    ) {
        $lozinka = hash('sha512', $lozinka);
        $db = Database::getInstance();

        $db->insert(
            'Korisnik',
            'insert into korisnici (korisnicko_ime, lozinka, ime_prezime, email, broj_telefona, datum_rodjenja, tip_korisnika_id) 
        values (:k, :l, :i, :e, :b, :d, 3)',
            [
                ':k' => $korisnicko_ime,
                ':l' => $lozinka,
                ':i' => $ime_prezime,
                ':e' => $email,
                ':b' => $broj_telefona,
                ':d' => $datum_rodjenja
            ]
        );

        return $db->lastInsertId();
    }

    //ovo je metoda pomocu koje administrator kreira korinsika
    public static function kreiranjeKorisnika(
        $korisnicko_ime,
        $lozinka,
        $ime_prezime,
        $email,
        $broj_telefona,
        $datum_rodjenja,
        $tip_korisnika_id
    ) {

        $lozinka = hash('sha512', $lozinka);
        $db = Database::getInstance();

        $db->insert(
            'Korisnik',
            'insert into korisnici (korisnicko_ime, lozinka, ime_prezime, email, broj_telefona, datum_rodjenja, tip_korisnika_id) 
        values (:k, :l, :i, :e, :b, :d, :t)',
            [
                ':k' => $korisnicko_ime,
                ':l' => $lozinka,
                ':i' => $ime_prezime,
                ':e' => $email,
                ':b' => $broj_telefona,
                ':d' => $datum_rodjenja,
                ':t' => $tip_korisnika_id
            ]
        );

        return $db->lastInsertId();
    }

    // ovo je metoda pomocu koje admin menja podatke korisnika
    public static function promeniKorisnika(
        $korisnicko_ime,
        $lozinka,
        $ime_prezime,
        $email,
        $broj_telefona,
        $datum_rodjenja,
        $tip_korisnika_id
    ) {
        $db = Database::getInstance();
        $db->update('Korisnik', 'update korisnici set lozinka = :l, ime_prezime = :i, email = :e, broj_telefona = :b,
         datum_rodjenja = :d, tip_korisnika_id = :t where korisnicko_ime = :k', [
                ':l' => $lozinka,
                ':i' => $ime_prezime,
                ':e' => $email,
                ':b' => $broj_telefona,
                ':d' => $datum_rodjenja,
                ':t' => $tip_korisnika_id,
                ':k' => $korisnicko_ime
            ]);
    }

    // metoda pomocu koje administrator brise korisnika
    public static function obrisiKorisnika($korisnicko_ime)
    {
        $db = Database::getInstance();
        $db->delete('delete from korisnici where korisnicko_ime = :k', [
            ':k' => $korisnicko_ime
        ]);
    }

    // proverava da li uopste postoji korisnik u bazi
    public static function prijava($korisnicko_ime, $lozinka)
    {
        $db = Database::getInstance();
        $lozinka = hash('sha512', $lozinka);

        $korisnici = $db->select(
            'Korisnik',
            'select * from korisnici where korisnicko_ime = :k and lozinka = :l',
            [
                ':k' => $korisnicko_ime,
                ':l' => $lozinka
            ]
        );

        foreach ($korisnici as $korisnik) {
            return $korisnik;
        }
        return null;
    }

    // metoda pomocu koje se proverava da li korisnik postoji u bazi, koristi se pri menjanju lozinke
    public static function proveriKorisnika($korisnicko_ime, $email, $lozinka)
    {
        $db = Database::getInstance();
        $lozinka = hash('sha512', $lozinka);

        $korisnici = $db->select(
            'Korisnik',
            'select * from korisnici where korisnicko_ime = :k and email = :e and lozinka = :l',
            [
                ':k' => $korisnicko_ime,
                ':e' => $email,
                ':l' => $lozinka
            ]
        );
        foreach ($korisnici as $korisnik)
            return $korisnik;
        return null;
    }

    public static function promeniLozinku($korisnicko_ime, $lozinka)
    {
        $db = Database::getInstance();
        $lozinka = hash('sha512', $lozinka);
        $db->update(
            'Korisnik',
            'update korisnici set lozinka = :l where korisnicko_ime = :k',
            [
                ':l' => $lozinka,
                ':k' => $korisnicko_ime
            ]
        );
    }

    public static function posaljiEmailZaRegistraciju($email)
    {
        $naslov = 'Registracija na sistem';
        $poruka = 'Uspesno ste se registrovali na sistem, srdacan pozdrav.';
        $headers = "From: peraperictest12345@gmail.com" . "/r/n" .
            "Reply-To: peraperictest12345@gmail.com" . "/r/n" .
            "X-Mailer: PHP/" . phpversion();

        if (mail($email, $naslov, $poruka, $headers)) {
            echo 'poslat';
        } else {
            echo 'nije poslat';
        }

        // trebalo bi da se konfigurise mail server, kao na .net ?
        // smtp server takodje, to proveriti
        // spam pogledati
    }

    // vraca korisnika za id
    public static function getById($id)
    {
        $db = Database::getInstance();

        $korisnici = $db->select('Korisnik', 'select * from korisnici where id = :id', [
            ':id' => $id
        ]);
        foreach ($korisnici as $korisnik)
            return $korisnik;
        return null;
    }

    public static function vratiIzvrsioce(): array
    {
        $db = Database::getInstance();

        return $db->select('Korisnik', 'select * from korisnici where tip_korisnika_id = 3');
    }

    public static function vratiRukovodioce(): array
    {
        $db = Database::getInstance();

        return $db->select('Korisnik', 'select * from korisnici where tip_korisnika_id = 2');
    }

    public static function vratiSveKorisnike(): array
    {
        $db = Database::getInstance();
        return $db->select('Korisnik', 'select * from korisnici');
    }

    // ova metoda se poziva kada izvrsilac zeli da zavrsi svoj deo zadatka
    public static function zavrsiZadatakZaIzvrsioca($id_zadatka, $id_korisnika)
    {
        $db = Database::getInstance();
        $db->update(
            'Korisnik',
            'update korisnici set zavrsen_deo_zadatka = :id_zadatka where id = :id_korisnika',
            [
                ':id_zadatka' => $id_zadatka,
                ':id_korisnika' => $id_korisnika
            ]
        );
    }


}