<?php

namespace Art321\Th3Log;

class Logging
{
    private $log_path;
    private $prefix;
    private $data1;
    private $data2;
    private $log_level;
    private $log;

    public function __construct(
        $log_path = __DIR__ . '/logs',
        $prefix = null,
        $data1 = null,
        $data2 = null,
        $log_level = \Psr\Log\LogLevel::INFO
        ) {
        $this->logpath = $logpath;
        $this->prefix = $prefix;
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->log_level = $log_level;
    }

    /**
     * @param string $log_message
     */

    public function buildLogString(
        $log_message = null
    ) {
        if ($log_message === null) {
            return null;
        }

        $log_data = $this->prefix . ': ';

        if (isset($this->data1)) {
            $log_data .= '[' . $this->data1 . '] ';
        }

        if (isset($this->data2)) {
            $log_data .= '- [' . $this->data2 . '] ';
        }

        return $log_data .= $log_message;
    }

    /**
     * @param string $log_method
     * @param string $log_data
     */

    public function switchLogMethod($log_method, $log_data)
    {
        switch ($log_method) {
            case 'EMERGENCY':
                $this->log->emergency($log_data);
            break;

            case 'ALERT':
                $this->log->alert($log_data);
            break;

            case 'CRITICAL':
                $this->log->critical($log_data);
            break;

            case 'ERROR':
                $this->log->error($log_data);
            break;

            case 'WARNING':
                $this->log->warning($log_data);
            break;

            case 'NOTICE':
                $this->log->notice($log_data);
            break;

            case 'INFO':
                $this->log->info($log_data);
            break;

            case 'DEBUG':
                $this->log->debug($log_data);
            break;


            default:
                $this->log->info($log_data);
                break;
        }
    }

    /**
     * @param string $log_message
     * @param string $log_method
     */

    public function log(
        $log_message = null,
        $log_method = null
        ) {
        $this->log = new Katzgrau\KLogger\Logger($this->log_path, $this->log_level, array(
            'prefix' => $this->prefix . '_',
        ));

        $log_data = $this->buildLogString($log_message);

        $this->switchLogMethod($log_method, $log_data);

        unset($this->log);
    }
}
