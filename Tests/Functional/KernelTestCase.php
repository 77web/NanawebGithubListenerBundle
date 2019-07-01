<?php


namespace Nanaweb\GithubListenerBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as BaseKernelTestCase;

class KernelTestCase extends BaseKernelTestCase
{
    protected static function getKernelClass()
    {
        return AppKernel::class;
    }
}
