<?php

namespace GraphQLClient;

/**
 * Class Field
 *
 * @package GraphQLClient
 */
class Field
{
    /**
     * @var Field[]|array
     */
    private $children;

    /**
     * @var string
     */
    private $name;

    /**
     * Field constructor.
     *
     * @param string        $name
     * @param Field[]|array $children
     */
    public function __construct(string $name, array $children = [])
    {
        $this->name = $name;
        $this->children = $children;
    }

    /**
     * @return Field[]|array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param Field $field
     *
     * @return Field
     */
    public function addChild(Field $field): Field
    {
        $this->children[] = $field;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
