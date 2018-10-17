<?php declare(strict_types=1);

namespace Tests\GraphQLClient;

use GraphQLClient\Field;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GraphQLClient\Field
 */
class TokenizerTest extends TestCase
{
    public function testAddingChildren()
    {
        $subField = new Field('subfield');
        $field = new Field('field');

        $this->assertCount(0, $field->getChildren());

        $field->addChild($subField);

        $this->assertCount(1, $field->getChildren());
    }
}
