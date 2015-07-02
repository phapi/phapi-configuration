<?php

namespace Phapi\Endpoint;

use Phapi\Endpoint;

class User extends Endpoint
{

    /**
     * @apiUri /blog/12
     * @apiDescription Retrieve the blogs information like
     *                 id, name and description
     * @apiParams id int
     * @apiResponse id int Blog ID
     * @apiResponse name string The name of the blog
     * @apiResponse description string A description of the blog
     * @apiResponse links string
     *              A list of links
     */
    public function get($username)
    {
        return [
            'message' => 'User '. $username
        ];
    }

    public function post()
    {
        return [
            'message' => 'Ok'
        ];
    }

    public function put()
    {}
}
