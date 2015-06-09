<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;

/**
 * Class Request
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name = "requests")
 */
class Request extends AbstractEntity
{
    /**
     * @var string
     * @ORM\Column(name = "reqcomment", type = "text", nullable = true)
     */
    protected $comment;

    /**
     * @var string
     * @ORM\Column(name = "email", type = "string", nullable = true)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(name = "name", type = "string")
     * @Assert\NotBlank(message = "Имя не может быть пустым")
     * @Assert\Length(min = 2, minMessage = "Имя не должно быть меньше 2 символов")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(name = "phone", type = "string", nullable = true)
     * @Assert\Regex(pattern = "/^\d{10}$/", message = "Некорректно указан номер мобильного телефона")
     */
    protected $phone;

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }
} 