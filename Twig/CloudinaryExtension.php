<?php
namespace Misteio\CloudinaryBundle\Twig;

use Misteio\CloudinaryBundle\Wrapper\CloudinaryWrapper;
/**
 * Cloudinary twig extension.
 */
class CloudinaryExtension extends \Twig_Extension
{
    /**
     * The cloudinary library.
     *
     * @var Cloudinary
     */
    protected $cloudinary;
    /**
     * Constructor.
     *
     * @param Cloudinary $cloudinary The cloudinary library.
     */
    public function __construct(CloudinaryWrapper $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('cloudinary_url'         , array($this, 'getUrl')),
            new \Twig_SimpleFilter('cloudinary_url_video'   , array($this, 'getUrlVideo'))
        );
    }


    /**
     * Get the cloudinary URL.
     *
     * @param string $id Image ID.
     * @param array $options options for the image.
     * @return string
     */
    public function getUrl($id, $options = array())
    {
        return $this->cloudinary->show($id, $options);
    }

    /**
     * Get the cloudinary URL.
     *
     * @param string $id Video ID.
     * @param array $options options for the video.
     * @return string
     */
    public function getUrlVideo($id, $options = array())
    {
        return $this->cloudinary->showVideo($id, $options);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'cloudinary';
    }
}