<?php

defined('TYPO3_MODE') or die();

\Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('pre');
\Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('protected');
\Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('public');

