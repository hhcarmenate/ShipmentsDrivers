<?php


namespace App\Http\Support\Shipments\CheckFile;

use Maatwebsite\Excel\Facades\Excel;

abstract class CheckFile
{
    private $file;

    protected $excel_data;

    protected $error;
    /**
     * CheckFile constructor.
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->processFile();
    }

    /**
     * Get Data formatted from excel
     * @return mixed
     */
    abstract public function getExcelData();

    /**
     * Assign excel data to array
     */
    private function processFile()
    {
        try {
            $this->excel_data = Excel::toArray('',$this->file);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    /**
     * Get Check File Errors
     * @return mixed
     */
    public function errors()
    {
        return $this->error;
    }
}
