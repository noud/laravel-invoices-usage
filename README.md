# [Laravel Invoices](http://github.com/LaravelDaily/laravel-invoices) usage

Demonstrates Laravel-invoices usage.

## Installation

Install the package by running this command in your terminal/cmd:
```
composer require noud/laravel-invoices-usage
```

## Usage

After install the package gives 3 URLs to see Laravel-invoices at work.
```
http://localhost/invoices/example/random
http://localhost/invoices/example/advanced
http://localhost/invoices/example/alternatives
```

See result [Invoice_AA_00001.pdf](docs/examples/invoice_AA_00001.pdf).

See result [Roosevelt Lloyd Ashley Medina.pdf](docs/examples/Roosevelt%20Lloyd%20Ashley%20Medina.pdf).

## Advanced Usage Localized to Dutch

``` php
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

<...>

        $client = new Party([
            'name'          => 'Secure Code',
            'address'       => 'Voldijkje 13, 5053 AG  GOIRLE',
            'vat'           => 'NL003331926895',
            'phone'         => '06 1987 3003',
            'custom_fields' => [
                'kvk'   => '783999505',
                'bank_number'  => 'NL64RABO0116846267',
                'bank_name'  => 'Rabobank',
                'swift' => 'RABONL2U',
            ],
        ]);

<...>

        $this->name = 'Factuur';
        $this->dateFormat = Config::get('invoice.date.format');
        $this->currencySymbol = Config::get('invoice.currency.symbol');
        $this->currencyCode = strtolower(Config::get('invoice.currency.code'));
        $this->currencyDecimalPoint = Config::get('invoice.currency.decimal_point');
        $this->currencyThousandsSeparator = Config::get('invoice.currency.thousands_separator');
        $this->currencyFormat = Config::get('invoice.currency.format');
        $this->client = new Party(Config::get('invoice.seller.attributes'));
        $this->serialNumberSequence = Config::get('invoice.serial_number.sequence');
        $this->serialNumberSeries = Config::get('invoice.serial_number.series');
        $this->serialNumberFormat = Config::get('invoice.serial_number.format');
        $this->taxRate = 21;

        $invoice = Invoice::make('receipt')
            ->name($this->name)
            ->series('BIG')
            ->sequence(667)
            // @todo serialNumberFormat does not format
            ->serialNumberFormat($this->serialNumberSeries . '/' . $this->serialNumberSequence)
            // ->serialNumberFormat($this->serialNumberSeries . '/' . $this->serialNumberSequence)
            // ->serialNumberFormat($this->serialNumberFormat)
            ->seller($this->client)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat($this->dateFormat)
            ->payUntilDays(14)
            ->currencySymbol($this->currencySymbol)
            ->currencyCode($this->currencyCode)
            // @todo currency does not work
            ->currencyFormat($this->currencySymbol . $this->currencyValue)
            ->currencyThousandsSeparator($this->currencyThousandsSeparator)
            ->currencyDecimalPoint($this->currencyDecimalPoint)
            ->filename($this->client->name . ' ' . $customer->name)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('vendor/invoices/sample-logo.png'));

       if (isset($this->taxRate)) {
            $invoice->taxRate($this->taxRate);
        }

        // You can additionally save generated invoice to configured disk
        $invoice->save('public');
            
        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
```
See result [Secure Code Ashley Medina.pdf](docs/Secure%20Code%20Ashley%20Medina%20(nl).pdf).