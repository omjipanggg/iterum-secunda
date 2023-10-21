<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use NcJoes\OfficeConverter\OfficeConverter;
use PhpOffice\PhpWord\TemplateProcessor;

class ConvertWordToPDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $document;
    protected $template;
    protected $data;

    public function __construct($data, $document, $template)
    {
        $this->data = $data;
        $this->document = $document;
        $this->template = $template;
    }

    public function handle(): void
    {
        $writer = new TemplateProcessor($this->template);
        foreach ($this->data as $key => $value) {
            $writer->setValue($key, $value);
        }

        $writer->saveAs($this->document);

        /* WINDOWS-BASED */
        $converter = new OfficeConverter($this->template, storage_path('app/public/PKWT/'), 'soffice', false);
        $converter->convertTo($this->template)
    }
}
