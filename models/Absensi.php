<?php

class Absensi {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // TAMPIL DATA
    public function getAll($limit, $offset, $sort) {

        return $this->conn->query(
            "SELECT absensi.*, penerima_manfaat.nama
            FROM absensi

            JOIN penerima_manfaat
            ON absensi.id_penerima =
            penerima_manfaat.id_penerima

            ORDER BY $sort

            LIMIT $limit
            OFFSET $offset"
        );
    }

    // HITUNG TOTAL DATA
    public function count() {

        $result = $this->conn->query(
            "SELECT COUNT(*) as total
            FROM absensi"
        );

        return $result->fetch_assoc()['total'];
    }

    // AMBIL DATA PENERIMA
    public function getPenerima() {

        return $this->conn->query(
            "SELECT * FROM penerima_manfaat"
        );
    }

    // TAMBAH DATA
    public function create($id_penerima, $tanggal, $status_hadir) {

        return $this->conn->query(
            "INSERT INTO absensi
            VALUES (
                NULL,
                '$id_penerima',
                '$tanggal',
                '$status_hadir'
            )"
        );
    }

    // HAPUS DATA
    public function delete($id) {

        return $this->conn->query(
            "DELETE FROM absensi
            WHERE id_absensi=$id"
        );
    }

    // AMBIL SATU DATA
    public function getById($id) {

        $result = $this->conn->query(
            "SELECT * FROM absensi
            WHERE id_absensi=$id"
        );

        return $result->fetch_assoc();
    }

    // UPDATE DATA
    public function update(
        $id,
        $id_penerima,
        $tanggal,
        $status_hadir
    ) {

        return $this->conn->query(
            "UPDATE absensi SET

            id_penerima='$id_penerima',
            tanggal='$tanggal',
            status_hadir='$status_hadir'

            WHERE id_absensi=$id"
        );
    }    
}
?>