<?php

interface CrudInterface {
    public function create(object $entity);
    public function read(int $id);
    public function update(int $id, object $entity);
    public function delete(int $id);
    public function getAll();
}
?>