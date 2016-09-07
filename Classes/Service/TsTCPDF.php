<?php

namespace Extcode\TCPDF\Service;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * TdTCPDF
 *
 * @package cart_pdf
 * @author Daniel Lorenz <ext.tcpdf@extco.de>
 */
class TsTCPDF extends \TCPDF
{
    /**
     * Object Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Log Manager
     *
     * @var \TYPO3\CMS\Core\Log\LogManager
     */
    protected $logManager;

    /**
     * PDF Settings
     *
     * @var array
     */
    protected $pdfSettings;

    /**
     * PDF Type
     *
     * @var string
     */
    protected $pdfType;

    /**
     * Injects the Object Manager
     *
     * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
     *
     * @return void
     */
    public function injectObjectManager(
        \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
    ) {
        $this->objectManager = $objectManager;
    }

    /**
     * Inject the Log Manager
     *
     * @param \TYPO3\CMS\Core\Log\LogManagerInterface $logḾanager
     *
     * @return void
     */
    public function injectLog(
        \TYPO3\CMS\Core\Log\LogManagerInterface $logḾanager
    ) {
        $this->logManager = $logḾanager;
    }

    /**
     * Get Cart PDF Type
     *
     * @return string
     */
    public function getCartPdfType()
    {
        return $this->pdfType;
    }

    /**
     * Set Cart PDF Type
     *
     * @param string $pdfType
     * @return void
     */
    public function setCartPdfType($pdfType)
    {
        $this->pdfType = $pdfType;
    }

    /**
     * Sets Settings
     *
     * @param array $settings
     *
     * @return void
     */
    public function setSettings($settings)
    {
        $this->pdfSettings = $settings;
    }

    /**
     * render page header
     *
     * @return void
     */
    public function header()
    {
        if ($this->pdfSettings[$this->pdfType]) {
            if ($this->pdfSettings[$this->pdfType]['header']) {
                if ($this->pdfSettings[$this->pdfType]['fontSize']) {
                    $this->SetFontSize($this->pdfSettings['fontSize']);
                }

                if ($this->pdfSettings[$this->pdfType]['header']['html']) {
                    foreach ($this->pdfSettings[$this->pdfType]['header']['html'] as $partName => $partConfig) {
                        $this->renderStandaloneView(
                            $this->pdfSettings[$this->pdfType]['header']['html'][$partName]['templatePath'],
                            $partName,
                            $partConfig
                        );
                    }
                }

                if ($this->pdfSettings[$this->pdfType]['header']['line']) {
                    foreach ($this->pdfSettings[$this->pdfType]['header']['line'] as $partName => $partConfig) {
                        $this->Line(
                            $partConfig['x1'],
                            $partConfig['y1'],
                            $partConfig['x2'],
                            $partConfig['y2'],
                            $partConfig['style']
                        );
                    }
                }
            }
        }
    }

    /**
     * render page footer
     *
     * @return void
     */
    public function footer()
    {
        if ($this->pdfSettings[$this->pdfType]) {
            if ($this->pdfSettings[$this->pdfType]['footer']) {
                if ($this->pdfSettings[$this->pdfType]['fontSize']) {
                    $this->SetFontSize($this->pdfSettings['fontSize']);
                }

                if ($this->pdfSettings[$this->pdfType]['footer']['html']) {
                    foreach ($this->pdfSettings[$this->pdfType]['footer']['html'] as $partName => $partConfig) {
                        $this->renderStandaloneView(
                            $this->pdfSettings[$this->pdfType]['footer']['html'][$partName]['templatePath'],
                            $partName,
                            $partConfig
                        );
                    }
                }

                if ($this->pdfSettings[$this->pdfType]['footer']['line']) {
                    foreach ($this->pdfSettings[$this->pdfType]['footer']['line'] as $partName => $partConfig) {
                        $this->Line(
                            $partConfig['x1'],
                            $partConfig['y1'],
                            $partConfig['x2'],
                            $partConfig['y2'],
                            $partConfig['style']
                        );
                    }
                }
            }
        }
    }

    /**
     * render Standalone View
     *
     * @param string $templatePath
     * @param string $type
     * @param array $config
     *
     * @return void
     */
    protected function renderStandaloneView($templatePath, $type, $config)
    {
        $view = $this->getStandaloneView($templatePath, ucfirst($type));

        if ($config['file']) {
            $file = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                $config['file']
            );
            $view->assign('file', $file);
            if ($config['width']) {
                $view->assign('width', $config['width']);
            }
            if ($config['height']) {
                $view->assign('heigth', $config['heigth']);
            }
        }
        if ($type == 'page') {
            $view->assign('numPage', $this->getAliasNumPage());
            $view->assign('numPages', $this->getAliasNbPages());
        }

        $content = $view->render();
        $content = trim(preg_replace('~[\n]+~', '', $content));

        $this->writeHtmlCellWithConfig($content, $config);
    }

    /**
     * Write HTML Cell with configuration
     *
     * @param string $content
     * @param array $config
     *
     * @return void
     */
    protected function writeHtmlCellWithConfig($content, $config)
    {
        $width = $config['width'];
        $height = 0;
        if ($config['height']) {
            $height = $config['height'];
        }
        $positionX = $config['positionX'];
        $positionY = $config['positionY'];
        $align = 'L';
        if ($config['align']) {
            $align = $config['align'];
        }

        $oldFontSize = $this->getFontSize();
        if ($config['fontSize']) {
            $this->SetFontSize($config['fontSize']);
        }

        $this->writeHTMLCell(
            $width,
            $height,
            $positionX,
            $positionY,
            $content,
            false,
            2,
            false,
            true,
            $align,
            true
        );

        if ($config['fontSize']) {
            $this->SetFontSize($oldFontSize);
        }
    }

    /**
     * Get standalone View
     *
     * @param string $templatePath
     * @param string $templateFileName
     * @param string $format
     *
     * @return \TYPO3\CMS\Fluid\View\StandaloneView Fluid instance
     */
    protected function getStandaloneView($templatePath, $templateFileName = 'Default', $format = 'html')
    {
        $templatePathAndFileName = $templatePath . $templateFileName . '.' . $format;

        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
        $view = $this->objectManager->get(
            \TYPO3\CMS\Fluid\View\StandaloneView::class
        );
        $view->setFormat($format);

        if ($this->pdfSettings['view']) {
            $view->setLayoutRootPaths($this->resolveRootPaths('layoutRootPaths'));
            $view->setPartialRootPaths($this->resolveRootPaths('partialRootPaths'));

            if ($this->pdfSettings['view']['templateRootPaths']) {
                foreach ($this->pdfSettings['view']['templateRootPaths'] as $pathNameKey => $pathNameValue) {
                    $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                        $pathNameValue
                    );

                    $completePath = $templateRootPath . $templatePathAndFileName;
                    if (file_exists($completePath)) {
                        $view->setTemplatePathAndFilename($completePath);
                    }
                }
            }
        }

        if (!$view->getTemplatePathAndFilename()) {
            $logger = $this->logManager->getLogger(__CLASS__);
            $logger->error(
                'Cannot find Template for PdfService',
                [
                    'templateRootPaths' => $this->pdfSettings['view']['templateRootPaths'],
                    'templatePathAndFileName' => $templatePathAndFileName,
                ]
            );
        }

        // set controller extension name for translation
        $view->getRequest()->setControllerExtensionName('Tcpdf');

        return $view;
    }

    /**
     * Returns the Partial Root Path
     *
     * For TYPO3 Version 6.2 it resolves the absolute file names
     *
     * @var string $type
     * @return array
     *
     * @deprecated will be removed with support for TYPO3 6.2
     */
    protected function resolveRootPaths($type)
    {
        $rootPaths = [];

        if ($this->pdfSettings['view'][$type]) {
            $rootPaths = $this->pdfSettings['view'][$type];

            if (\TYPO3\CMS\Core\Utility\GeneralUtility::compat_version('6.2')) {
                foreach ($rootPaths as $rootPathsKey => $rootPathsValue) {
                    $rootPaths[$rootPathsKey] = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
                        $rootPathsValue
                    );
                }
            }
        }

        return $rootPaths;
    }
}
