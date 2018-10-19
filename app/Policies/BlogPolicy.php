<?php

namespace App\Policies;

use App\User;
use App\Blog;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the blog.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function view(User $user, Blog $blog)
    {
        //
    }

    /**
     * Determine whether the user can create blogs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can edit blogs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function edit(User $user, Blog $blog)
    {
       //return $user->id === $blog->user_id;
    }

    /**
     * Determine whether the user can update the blog.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function update(User $user, Blog $blog)
    {
        //
    }

    /**
     * Determine whether the user can delete the blog.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function delete(User $user, Blog $blog)
    {
        //
    }
}
