<?php

namespace Doctrine\Tests\Common\Annotations;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Annotations\SimpleAnnotationReader;

class SimpleAnnotationReaderTest extends AbstractReaderTest
{
    /**
     * Contrary to the behavior of the default annotation reader, we do just ignore
     * these in the simple annotation reader (so, no expected exception here).
     *
     * @doesNotPerformAssertions
     */
    public function testImportDetectsNotImportedAnnotation()
    {
        $this->ignoreIssues();
        parent::testImportDetectsNotImportedAnnotation();
    }

    /**
     * Contrary to the behavior of the default annotation reader, we do just ignore
     * these in the simple annotation reader (so, no expected exception here).
     *
     * @doesNotPerformAssertions
     */
    public function testImportDetectsNonExistentAnnotation()
    {
        $this->ignoreIssues();
        parent::testImportDetectsNonExistentAnnotation();
    }

    /**
     * Contrary to the behavior of the default annotation reader, we do just ignore
     * these in the simple annotation reader (so, no expected exception here).
     *
     * @doesNotPerformAssertions
     */
    public function testClassWithInvalidAnnotationTargetAtClassDocBlock()
    {
        $this->ignoreIssues();
        parent::testClassWithInvalidAnnotationTargetAtClassDocBlock();
    }

    /**
     * Contrary to the behavior of the default annotation reader, we do just ignore
     * these in the simple annotation reader (so, no expected exception here).
     *
     * @doesNotPerformAssertions
     */
    public function testClassWithInvalidAnnotationTargetAtPropertyDocBlock()
    {
        $this->ignoreIssues();
        parent::testClassWithInvalidAnnotationTargetAtPropertyDocBlock();
    }

    /**
     * Contrary to the behavior of the default annotation reader, we do just ignore
     * these in the simple annotation reader (so, no expected exception here).
     *
     * @doesNotPerformAssertions
     */
    public function testClassWithInvalidNestedAnnotationTargetAtPropertyDocBlock()
    {
        $this->ignoreIssues();
        parent::testClassWithInvalidNestedAnnotationTargetAtPropertyDocBlock();
    }

    /**
     * Contrary to the behavior of the default annotation reader, we do just ignore
     * these in the simple annotation reader (so, no expected exception here).
     *
     * @doesNotPerformAssertions
     */
    public function testClassWithInvalidAnnotationTargetAtMethodDocBlock()
    {
        $this->ignoreIssues();
        parent::testClassWithInvalidAnnotationTargetAtMethodDocBlock();
    }

    /**
     * Contrary to the behavior of the default annotation reader, we do just ignore
     * these in the simple annotation reader (so, no expected exception here).
     *
     * @doesNotPerformAssertions
     */
    public function testErrorWhenInvalidAnnotationIsUsed()
    {
        $this->ignoreIssues();
        parent::testErrorWhenInvalidAnnotationIsUsed();
    }

    /**
     * The SimpleAnnotationReader doens't include the @IgnoreAnnotation in the results.
     */
    public function testInvalidAnnotationUsageButIgnoredClass()
    {
        $reader = $this->getReader();
        $ref = new \ReflectionClass(Fixtures\InvalidAnnotationUsageButIgnoredClass::class);
        $annots = $reader->getClassAnnotations($ref);

        self::assertCount(1, $annots);
    }

    public function testIncludeIgnoreAnnotation()
    {
        $this->markTestSkipped('The simplified annotation reader would always autoload annotations');
    }

    /**
     * @group DDC-1660
     * @group regression
     *
     * Contrary to the behavior of the default annotation reader, @version is not ignored
     */
    public function testInvalidAnnotationButIgnored()
    {
        $reader = $this->getReader();
        $class  = new \ReflectionClass(Fixtures\ClassDDC1660::class);

        self::assertTrue(class_exists(Fixtures\Annotation\Version::class));
        self::assertCount(1, $reader->getClassAnnotations($class));
        self::assertCount(1, $reader->getMethodAnnotations($class->getMethod('bar')));
        self::assertCount(1, $reader->getPropertyAnnotations($class->getProperty('foo')));
    }

    protected function getReader(): Reader
    {
        $reader = new SimpleAnnotationReader();
        $reader->addNamespace(__NAMESPACE__);
        $reader->addNamespace(__NAMESPACE__ . '\Fixtures');
        $reader->addNamespace(__NAMESPACE__ . '\Fixtures\Annotation');

        return $reader;
    }
}
