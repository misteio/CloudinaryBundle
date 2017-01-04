<?php
namespace Misteio\CloudinaryBundle\Wrapper;

use Cloudinary;

/**
 * Cloudinary WRAPPER
 *
 * @package v1.0.11
 * @author MisteIO
 * @link https://packagist.org/packages/misteio/misteio-cloudinary-bundle
 *
 */
class CloudinaryWrapper
{

    /**
     * Cloudinary lib.
     *
     * @var \Cloudinary
     */
    protected $cloudinary;
    /**
     * Cloudinary uploader.
     *
     * @var \Cloudinary\Uploader
     */
    protected $uploader;

    /**
     * Cloud name.
     *
     * @var String
     */
    protected $cloud_name;

    /**
     * Uploaded result.
     *
     * @var array
     */
    protected $uploadedResult;

    public function __construct($cloudinaryCloudName, $cloudinaryApiKey, $cloudinarySecretKey)
    {
        $this->cloudinary   = new Cloudinary;
        $this->uploader     = new Cloudinary\Uploader;

        $this -> cloud_name = $cloudinaryCloudName;

        $this->cloudinary->config(array(
                'cloud_name' => $cloudinaryCloudName,
                'api_key'    => $cloudinaryApiKey,
                'api_secret' => $cloudinarySecretKey
            ));
    }


    /**
     * Get cloudinary class.
     *
     * @return \Cloudinary
     */
    public function getCloudinary()
    {
        return $this->cloudinary;
    }

    /**
     * Get cloud name.
     *
     * @return String
     */
    public function getCloudName()
    {
        return $this->cloud_name;
    }

    /**
     * Get cloudinary uploader.
     *
     * @return \Cloudinary\Uploader
     */
    public function getUploader()
    {
        return $this->uploader;
    }


    /**
     * Upload image to cloud.
     *
     * @param  mixed $source
     * @param  string $publicId
     * @param  array  $tags
     * @return CloudinaryWrapper
     */
    public function upload($source, $publicId, $tags = array())
    {
        $defaults = array(
            'public_id' => null,
            'tags'      => array()
        );
        $options = array_merge($defaults, array(
                'public_id' => $publicId,
                'tags'      => $tags
            ));
        $this->uploadedResult = $this->getUploader()->upload($source, $options);
        return $this;
    }

    /**
     * Upload image to cloud.
     *
     * @param  mixed $source
     * @param  string $publicId
     * @param  array  $tags
     * @return CloudinaryWrapper
     */
    public function uploadVideo($source, $publicId, $tags = array())
    {
        $options =  array(
            'public_id' => $publicId,
            'tags'      => $tags,
            'resource_type' => 'video'
        );
        $this->uploadedResult = $this->getUploader()->upload($source, $options);
        return $this;
    }


    /**
     * Uploaded result.
     *
     * @return array
     */
    public function getResult()
    {
        return $this->uploadedResult;
    }


    /**
     * Display image.
     *
     * @param  string $publicId
     * @param  array  $options
     * @return string
     */
    public function show($publicId, $options = array())
    {
        return $this->getCloudinary()->cloudinary_url($publicId, $options);
    }

    /**
     * Display video.
     *
     * @param  string $publicId
     * @param  array  $options
     * @return string
     */
    public function showVideo($publicId, $options = array())
    {
        $options['resource_type'] = 'video';
        return $this->getCloudinary()->cloudinary_url($publicId, $options);
    }
    /**
     * Rename public ID.
     *
     * @param  string $publicId
     * @param  string $toPublicId
     * @param  array  $options
     * @return array
     */
    public function rename($publicId, $toPublicId, $options = array())
    {
        try
        {
            return $this->getUploader()->rename($publicId, $toPublicId, $options);
        }
        catch (\Exception $e) { }
        return false;
    }
    /**
     * Destroy image.
     *
     * @param  string $publicId
     * @param  array  $options
     * @return array
     */
    public function destroy($publicId, $options = array())
    {
        return $this->getUploader()->destroy($publicId, $options);
    }

    /**
     * @param $tag
     * @param array $publicIds
     * @param array $options
     * @return mixed
     */
    public function addTag($tag, $publicIds = array(), $options = array())
    {
        return $this->getUploader()->add_tag($tag, $publicIds, $options);
    }

    /**
     * @param $tag
     * @param array $publicIds
     * @param array $options
     * @return mixed
     */
    public function removeTag($tag, $publicIds = array(), $options = array())
    {
        return $this->getUploader()->remove_tag($tag, $publicIds, $options);
    }

    /**
     * @param $tag
     * @param array $publicIds
     * @param array $options
     * @return mixed
     */
    public function replaceTag($tag, $publicIds = array(), $options = array())
    {
        return $this->getUploader()->replace_tag($tag, $publicIds, $options);
    }
}