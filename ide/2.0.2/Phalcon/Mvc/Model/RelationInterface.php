<?php 

namespace Phalcon\Mvc\Model {

	interface RelationInterface {

		public function __construct($type, $referencedModel, $fields, $referencedFields, $options=null);


		public function setIntermediateRelation($intermediateFields, $intermediateModel, $intermediateReferencedFields);


		public function isReusable();


		public function getType();


		public function getReferencedModel();


		public function getFields();


		public function getReferencedFields();


		public function getOptions();


		public function isForeignKey();


		public function getForeignKey();


		public function isThrough();


		public function getIntermediateFields();


		public function getIntermediateModel();


		public function getIntermediateReferencedFields();

	}
}
