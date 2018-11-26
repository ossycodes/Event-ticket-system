<?php

namespace App\Repositories\Contracts;

interface BlogRepoInterface
{
    public function getAllBlogPosts();

    public function getPaginatedBlogPosts(int $amount);

    public function getTotalEvents();
}