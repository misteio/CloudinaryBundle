<?php

namespace Misteio\MisteioCloudinaryBundle\Tests\Wrapper;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CloudinaryWrapperTest extends KernelTestCase
{
    /**
     * @var \Misteio\CloudinaryBundle\Wrapper\CloudinaryWrapper
     */
    private $_cloudinary;

    /**
     * @var String
     */
    private $_file;

    /**
     * @var String
     */
    private $_video;

    /**
     * @var String
     */
    private $_video_large;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this -> _cloudinary    = static::$kernel -> getContainer() -> get('misteio_cloudinary_wrapper');
        $this -> _file          = static::$kernel -> locateResource('@MisteioCloudinaryBundle/Resources/public/images/apple-touch-icon.png');
        $this -> _video         = static::$kernel -> locateResource('@MisteioCloudinaryBundle/Resources/public/videos/html5.mp4');
        $this -> _video_large   = static::$kernel -> locateResource('@MisteioCloudinaryBundle/Resources/public/videos/large.mp4');
    }

    public function testShow()
    {
        $this->assertEquals('http://res.cloudinary.com/' . $this -> _cloudinary -> getCloudName() . '/image/upload/sample', $this -> _cloudinary -> show('sample'));
    }

    public function testUpload()
    {
        $tags   = array( 'testing', 'phpunit', 'test');
        $this->assertEquals('my_upload_unit_test', $this -> _cloudinary -> upload( $this ->_file , 'my_upload_unit_test', $tags) -> getResult()['public_id']);
    }

    public function testUploadVideo()
    {
        $tags   = array( 'testing', 'phpunit', 'test');
        $this->assertEquals('my_upload_unit_test', $this -> _cloudinary -> uploadVideo( $this->_video, 'my_upload_unit_test', $tags) -> getResult()['public_id']);
    }

    public function testUploadLargeVideo()
    {
        $tags   = array( 'testing', 'phpunit', 'test');
        $this->assertEquals('my_upload_unit_test', $this -> _cloudinary -> uploadVideo( $this->_video_large, 'my_upload_unit_test', $tags) -> getResult()['public_id'], true);
    }

    public function testAddTag()
    {
        $this->assertEquals('my_upload_unit_test', $this -> _cloudinary -> addTag('symfony', array('my_upload_unit_test'))['public_ids'][0]);
    }

    public function testRemoveTag()
    {
        $this->assertEquals('my_upload_unit_test', $this -> _cloudinary -> removeTag('symfony', array('my_upload_unit_test'))['public_ids'][0]);
    }


    public function testRename()
    {
        $this->assertEquals('my_upload_unit_test2', $this -> _cloudinary -> rename('my_upload_unit_test', 'my_upload_unit_test2')['public_id']);
    }


    public function testDestroy()
    {
        $this->assertEquals('ok', $this -> _cloudinary -> destroy('my_upload_unit_test2', 'my_upload_unit_test2')['result']);
    }
}
