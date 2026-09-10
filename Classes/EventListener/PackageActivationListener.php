<?php

namespace Aashro\AtVilla\EventListener;

use Symfony\Component\Finder\Finder;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Configuration\SiteConfiguration;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Package\Event\PackageInitializationEvent;
use TYPO3\CMS\Core\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

error_reporting(E_ALL);
ini_set('display_errors', '1');

class PackageActivationListener
{
    public function __construct(
        private readonly Registry $registry,
        private readonly SiteConfiguration $siteConfiguration,
    ) {}

    #[AsEventListener]
    public function __invoke(PackageInitializationEvent $event): void
    {
        $extensionKey = $event->getExtensionKey();

        // Only process this extension
        if ($extensionKey !== 'at_villa') {
            return;
        }

        // Import site configuration from Initialisation/Site
        $package = $event->getPackage();
        $importAbsFolder = $package->getPackagePath() . 'Initialisation/Site';
        

        $destinationFolder = Environment::getConfigPath() . '/sites';
        GeneralUtility::mkdir($destinationFolder);
        $existingSites = $this->siteConfiguration->resolveAllExistingSites(false);
        
        $finder = GeneralUtility::makeInstance(Finder::class);
        $finder->directories()->ignoreUnreadableDirs()->in($importAbsFolder);
        
        if ($finder->hasResults()) {
            foreach ($finder as $siteConfigDirectory) {
                $siteIdentifier = $siteConfigDirectory->getBasename();
                
                // Skip if site already exists
                if (isset($existingSites[$siteIdentifier])) {
                    continue;
                }
                
                $targetDir = $destinationFolder . '/' . $siteIdentifier;
                
                // Only import if not already imported and target doesn't exist
                if (!$this->registry->get('siteConfigImport', $siteIdentifier) && !is_dir($targetDir)) {
                    GeneralUtility::mkdir($targetDir);
                    GeneralUtility::copyDirectory($siteConfigDirectory->getPathname(), $targetDir);
                    $this->registry->set('siteConfigImport', $siteIdentifier, 1);
                }
            }
        }

        // Import static data if pages do not exist
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $count = $queryBuilder->count('uid')->from('pages')->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter(1)))->executeQuery()->fetchOne();

        if ($count == 0) {
            $sqlFile = $package->getPackagePath() . 'ext_tables_static+adt.sql';
            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('pages');
                $connection->executeStatement($sql);
            }
        }

        // Copy initial files to fileadmin
        $filesSource = $package->getPackagePath() . 'Initialisation/Files';
        $filesDest = Environment::getPublicPath() . '/fileadmin/' . $extensionKey;
        if (is_dir($filesSource) && !$this->registry->get('filesImported', 'at_villa')) {
            GeneralUtility::mkdir($filesDest);
            GeneralUtility::copyDirectory($filesSource, $filesDest);
            $this->registry->set('filesImported', 'at_villa', 1);
        }
    }
}