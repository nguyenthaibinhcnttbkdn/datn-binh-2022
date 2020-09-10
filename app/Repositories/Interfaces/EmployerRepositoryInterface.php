<?php


namespace App\Repositories\Interfaces;


interface EmployerRepositoryInterface
{
    public function getEmployerOrder();

    public function getEmployer();

    public function addEmployer(array $data);

    public function getEmployerByUserId($id);
}
