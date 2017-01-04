<?php

namespace Misteio\CloudinaryBundle\Tests\Twig;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Misteio\CloudinaryBundle\Twig\CloudinaryExtension;

class CloudinaryTwigTest extends KernelTestCase
{
    /**
     * @var \Misteio\CloudinaryBundle\Wrapper\CloudinaryWrapper
     */
    private $_cloudinary;


    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->_cloudinary = static::$kernel->getContainer()
            ->get('misteio_cloudinary_wrapper');
    }


    public function testGetUrl()
    {
        $ext = new CloudinaryExtension($this -> _cloudinary);
        $this->assertEquals(
            $this -> _cloudinary -> show('sample'),
            $ext->getUrl('sample')
        );
    }

    public function testGetFilters()
    {
        $ext = new CloudinaryExtension($this -> _cloudinary);
        $this->assertEquals(
            $ext->getFilters()[0]->getName(),
            'cloudinary_url'
        );
    }

    public function testGetName()
    {
        $ext = new CloudinaryExtension($this -> _cloudinary);
        $this->assertEquals(
            $ext->getName(),
            'cloudinary'
        );
    }
}