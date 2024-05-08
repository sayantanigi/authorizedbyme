<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public function download($invoice_id) {
        // Load necessary models, libraries, etc. as needed
        
        // Fetch the invoice data from your database or generate it
        
        // Example invoice content
        $invoice_content = 'Invoice content goes here';
        
        // Set headers for file download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="invoice.pdf"');
        
        // Output the invoice content
        echo $invoice_content;
    }

}
