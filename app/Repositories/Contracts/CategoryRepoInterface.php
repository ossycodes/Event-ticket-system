<?php

namespace App\Repositories\Contracts;

interface CategoryRepoInterface
{
    public function getAllCategories();

    public function getTotalCategories();
    
}
