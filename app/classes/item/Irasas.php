<?php

namespace App\Item;

Class Irasas {

    private $data;

    public function __construct($data = null) {
        if ($data) {
            $this->setData($data);
        } else {
            $this->data = [
                'skyrius' => null,
                'valst_nr' => null,
                'priemones_tipas' => null,
                'marke' => null,
                'pagaminimo_metai' => null,
                'dok_nr' => null,
                'dok_data' => null,
                'tiekejas' => null,
                'detale_darbas' => null,
                'vnt_kaina' => null,
                'dok_suma' => null,
            ];
        }
    }

    public function setSkyrius(string $skyrius) {
        $this->data['skyrius'] = $skyrius;
    }

    public function setValstNr(string $valst_nr) {
        $this->data['valst_nr'] = $valst_nr;
    }

    public function setPriemonesTipas(string $priemones_tipas) {
        $this->data['priemones_tipas'] = $priemones_tipas;
    }

    public function setMarke(string $marke) {
        $this->data['marke'] = $marke;
    }

    public function setPagaminimoMetai(string $pagaminimo_metai) {
        $this->data['pagaminimo_metai'] = $pagaminimo_metai;
    }

    public function setDokNr(string $dok_nr) {
        $this->data['dok_nr'] = $dok_nr;
    }

    public function setDokData(string $dok_data) {
        $this->data['dok_data'] = $dok_data;
    }

    public function setTiekejas(string $tiekejas) {
        $this->data['tiekejas'] = $tiekejas;
    }

    public function setDetaleDarbas(string $detale_darbas) {
        $this->data['detale_darbas'] = $detale_darbas;
    }

    public function setVntKaina(string $vnt_kaina) {
        $this->data['vnt_kaina'] = $vnt_kaina;
    }

    public function setDokSuma(string $dok_suma) {
        $this->data['dok_suma'] = $dok_suma;
    }

    public function getSkyrius() {
        return $this->data['skyrius'];
    }

    public function getValstNr() {
        return $this->data['valst_nr'];
    }

    public function getPriemonesTipas() {
        return $this->data['priemones_tipas'];
    }

    public function getMarke() {
        return $this->data['marke'];
    }

    public function getPagaminimoMetai() {
        return $this->data['pagaminimo_metai'];
    }

    public function getDokNr() {
        return $this->data['dok_nr'];
    }

    public function getDokData() {
        return $this->data['dok_data'];
    }

    public function getTiekejas() {
        return $this->data['tiekejas'];
    }

    public function getDetaleDarbas() {
        return $this->data['detale_darbas'];
    }

    public function getVntKaina() {
        return $this->data['vnt_kaina'];
    }

    public function getDokSuma() {
        return $this->data['dok_suma'];
    }

    public function getData() {
        return $this->data;
    }

    public function setData(array $data) {
        $this->setSkyrius($data['skyrius']);
        $this->setValstNr($data['valst_nr']);
        $this->setPriemonesTipas($data['priemones_tipas']);
        $this->setMarke($data['marke']);
        $this->setPagaminimoMetai($data['pagaminimo_metai']);
        $this->setDokNr($data['dok_nr']);
        $this->setDokData($data['dok_data']);
        $this->setTiekejas($data['tiekejas']);
        $this->setDetaleDarbas($data['detale_darbas']);
        $this->setVntKaina($data['vnt_kaina']);
        $this->setDokSuma($data['dok_suma']);
    }

}
?>