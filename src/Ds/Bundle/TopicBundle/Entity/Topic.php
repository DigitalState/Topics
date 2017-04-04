<?php

namespace Ds\Bundle\TopicBundle\Entity;

use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Gedmo\Mapping\Annotation as Behavior;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Topic
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds_topic.topic.filter"},
 *          "normalization_context"={"groups"={"topic_output"}},
 *          "denormalization_context"={"groups"={"topic_input"}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\TopicBundle\Repository\TopicRepository")
 * @ORM\Table(name="ds_topic")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Topic implements Uuidentifiable
{
    /**
     * @var integer
     *
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"topic_output_admin"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id; use Accessor\Id;

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"topic_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid; use Accessor\Uuid;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"topic_output_admin"})
     * @Behavior\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt; use Accessor\CreatedAt;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"topic_output_admin"})
     * @Behavior\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt; use Accessor\UpdatedAt;
}
