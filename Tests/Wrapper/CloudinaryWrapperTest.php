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
    private $_video_url = 'http://www.sample-videos.com/video/mp4/720/big_buck_bunny_720p_1mb.mp4';

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this -> _cloudinary = static::$kernel -> getContainer() -> get('misteio_cloudinary_wrapper');
        //We test with a default logo Symfony
        $this -> _file =  static::$kernel -> locateResource('@MisteioCloudinaryBundle/Resources/public/images/apple-touch-icon.png');
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
        $this->assertEquals('my_upload_unit_test', $this -> _cloudinary -> uploadVideo( $this->_video_url, 'my_upload_unit_test', $tags) -> getResult()['public_id']);
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
