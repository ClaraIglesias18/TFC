<?php
interface iModel {
    public function create();
    public function getAll();
    public function getById($id);
    public function delete($id);
    public function modify();
}