<?php

namespace CosmoCode\SlimSkeleton\Models;

/**
 * @Entity
 * @Table(name="user")
 */
class User
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(length=140)
     */
    private $username;

    /**
     * @Column(length=250)
     */
    private $full_name;

    /**
     * @Column(length=250)
     */
    private $password;

}