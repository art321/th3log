<?php
use PHPUnit\Framework\TestCase;
use Art321\Th3Log\Logging;

class LoggingTests extends TestCase
{
    public function testBuildLogString()
    {
        $logging = new Logging('logs', 'test', 'data1', 'data2');

        $this->assertContains('test: [data1] - [data2] Check this function', $logging->buildLogString('Check this function'));
    }
}
