<?php 

namespace Phalcon\Assets {

    /**
     * Phalcon\Assets\Resource
     *
     * Represents an asset resource
     *
     *<code>
     * $resource = new \Phalcon\Assets\Resource('js', 'javascripts/jquery.js');
     *</code>
     */
    class Resource
    {

        protected $_type;

        protected $_path;

        protected $_local;

        protected $_filter;

        protected $_attributes;

        protected $_sourcePath;

        protected $_targetPath;

        protected $_targetUri;

        /**
         * \Phalcon\Assets\Resource constructor
         *
         * @param string type
         * @param string path
         * @param boolean local
         * @param boolean filter
         * @param array attributes
         */
        public function __construct($type, $path, $local=null, $filter=null, $attributes=null)
        {
        }


        /**
         * Sets the resource's type
         *
         * @param string type
         * @return \Phalcon\Assets\Resource
         */
        public function setType($type)
        {
        }


        public function getType()
        {
        }


        /**
         * Sets the resource's path
         *
         * @param string path
         * @return \Phalcon\Assets\Resource
         */
        public function setPath($path)
        {
        }


        public function getPath()
        {
        }


        /**
         * Sets if the resource is local or external
         *
         * @param boolean local
         * @return \Phalcon\Assets\Resource
         */
        public function setLocal($local)
        {
        }


        public function getLocal()
        {
        }


        /**
         * Sets if the resource must be filtered or not
         *
         * @param boolean filter
         * @return \Phalcon\Assets\Resource
         */
        public function setFilter($filter)
        {
        }


        public function getFilter()
        {
        }


        /**
         * Sets extra HTML attributes
         *
         * @param array attributes
         * @return \Phalcon\Assets\Resource
         */
        public function setAttributes($attributes)
        {
        }


        public function getAttributes()
        {
        }


        /**
         * Sets a target uri for the generated HTML
         *
         * @param string targetUri
         * @return \Phalcon\Assets\Resource
         */
        public function setTargetUri($targetUri)
        {
        }


        public function getTargetUri()
        {
        }


        /**
         * Sets the resource's source path
         *
         * @param string sourcePath
         * @return \Phalcon\Assets\Resource
         */
        public function setSourcePath($sourcePath)
        {
        }


        public function getSourcePath()
        {
        }


        /**
         * Sets the resource's target path
         *
         * @param string targetPath
         * @return \Phalcon\Assets\Resource
         */
        public function setTargetPath($targetPath)
        {
        }


        public function getTargetPath()
        {
        }


        /**
         * Returns the content of the resource as an string
         * Optionally a base path where the resource is located can be set
         *
         * @param string basePath
         * @return string
         */
        public function getContent($basePath=null)
        {
        }


        /**
         * Returns the real target uri for the generated HTML
         *
         * @return string
         */
        public function getRealTargetUri()
        {
        }


        /**
         * Returns the complete location where the resource is located
         *
         * @param string basePath
         * @return string
         */
        public function getRealSourcePath($basePath=null)
        {
        }


        /**
         * Returns the complete location where the resource must be written
         *
         * @param string basePath
         * @return string
         */
        public function getRealTargetPath($basePath=null)
        {
        }

    }
}
