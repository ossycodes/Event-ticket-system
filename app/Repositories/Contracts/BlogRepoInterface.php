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

    public function getImageForBlogPost(int $id);

    public function getCommentsForBlogPostDescendingOrder();

    public function deleteBlogPost(int $id);

    public function createBlogPost($data);

    public function createImageForBlogPost(int $blogId, $data);

    public function updateBlogPost(int $id, $data);

    public function updateImageForBlogPost(int $id, $data);
}