<?php

namespace App\Repositories\Contracts;

interface BlogRepoInterface
{
    public function getAllBlogPosts();

    public function getPaginatedBlogPosts(int $amount);

    public function getTotalBlogPosts();

    public function getBlog(int $id);

    public function getBlogComments(int $id);

    public function getBlogImage(int $id);
}