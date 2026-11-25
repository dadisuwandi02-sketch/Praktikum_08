<?php
class BaseReport {
    final public function getId(): string { return 'R-01'; }
    public function title(): string { return 'Report'; }
}

class CustomReport extends BaseReport {
    public function title(): string { return 'Custom Report'; }
    // JANGAN mendeklarasikan getId() ulang: method parent final.
}
$report = new CustomReport();
echo $report->getId() . ' - ' . $report->title() . PHP_EOL;