<?php
declare(strict_types=1);

use CoenJacobs\Mozart\Replace\ClassmapReplacer;
use PHPUnit\Framework\TestCase;

class ClassMapReplacerTest extends TestCase
{
    /** @test */
    public function it_replaces_class_declarations(): void
    {
        $contents = 'class Hello_World {';
        $replacer = new ClassmapReplacer();
        $replacer->classmap_prefix = 'Mozart_';
        $contents = $replacer->replace($contents);
        $this->assertEquals('class Mozart_Hello_World {', $contents);
    }

    /** @test */
    public function it_replaces_abstract_class_declarations(): void
    {
        $contents = 'abstract class Hello_World {';
        $replacer = new ClassmapReplacer();
        $replacer->classmap_prefix = 'Mozart_';
        $contents = $replacer->replace($contents);
        $this->assertEquals('abstract class Mozart_Hello_World {', $contents);
    }

    /** @test */
    public function it_replaces_interface_class_declarations(): void
    {
        $contents = 'interface Hello_World {';
        $replacer = new ClassmapReplacer();
        $replacer->classmap_prefix = 'Mozart_';
        $contents = $replacer->replace($contents);
        $this->assertEquals('interface Mozart_Hello_World {', $contents);
    }

    /** @test */
    public function it_replaces_class_declarations_that_extend_other_classes(): void
    {
        $contents = 'class Hello_World extends Bye_World {';
        $replacer = new ClassmapReplacer();
        $replacer->classmap_prefix = 'Mozart_';
        $contents = $replacer->replace($contents);
        $this->assertEquals('class Mozart_Hello_World extends Bye_World {', $contents);
    }

    /** @test */
    public function it_replaces_class_declarations_that_implement_interfaces(): void
    {
        $contents = 'class Hello_World implements Bye_World {';
        $replacer = new ClassmapReplacer();
        $replacer->classmap_prefix = 'Mozart_';
        $contents = $replacer->replace($contents);
        $this->assertEquals('class Mozart_Hello_World implements Bye_World {', $contents);
    }

    /** @test */
    public function it_stores_replaced_class_names(): void
    {
        $contents = 'class Hello_World {';
        $replacer = new ClassmapReplacer();
        $replacer->classmap_prefix = 'Mozart_';
        $replacer->replace($contents);
        $this->assertArrayHasKey('Hello_World', $replacer->replacedClasses);
    }

    /** @test */
    public function it_replaces_class_declarations_psr2(): void
    {
        $contents = "class Hello_World\n{";
        $replacer = new ClassmapReplacer();
        $replacer->classmap_prefix = 'Mozart_';
        $contents = $replacer->replace($contents);
        $this->assertEquals("class Mozart_Hello_World\n{", $contents);
    }
}
