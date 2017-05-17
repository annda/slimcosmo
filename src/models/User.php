<?php
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

}