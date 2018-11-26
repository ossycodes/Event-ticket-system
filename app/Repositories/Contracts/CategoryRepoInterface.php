<?php

namespace App\Repositories\Contracts;

interface CategoryRepoInterface
{
    public function getAllCategories();

    public function getTotalCategories();

    public function getCategoryWithEvent(int $id); 
    
}
