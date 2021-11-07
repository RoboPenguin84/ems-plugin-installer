<?php

namespace Ems\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class Installer extends LibraryInstaller
{
    /**
     * @inheritDoc
     */
    public function getInstallPath(PackageInterface $package)
    {
        $prefix = substr($package->getPrettyName(), 0, 23);
        if ('armis/ems-plugin-' !== $prefix) {
            if ('armis/ems-service-' !== $prefix) {
                throw new \InvalidArgumentException(
                    'Unable to install template, phpdocumentor templates '
                        . 'should always start their package name with '
                        . '"phpdocumentor/template-"'
                );
            }
        }

        if ('armis/ems-plugin-' === $prefix)
            return 'src/Plugins/' . substr($package->getPrettyName(), 23);
        else if ('armis/ems-service-' === $prefix)
            return 'src/Services/' . substr($package->getPrettyName(), 23);
    }

    /**
     * @inheritDoc
     */
    public function supports($packageType)
    {
        return ('ems-plugin' === $packageType || 'ems-service' === $packageType);
    }
}
