<?php

namespace Tests\Feature;

use App\Repositories\CsvRepository;
use App\Repositories\CsvRepositoryInterface;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    protected string $file;

    protected function setUp(): void
    {
        parent::setUp();

        $this->file = tempnam(sys_get_temp_dir(), 'csv');
        copy(public_path('file/transactions.csv'), $this->file);
        $this->app->bind(CsvRepositoryInterface::class, fn () => new CsvRepository($this->file));
    }

    protected function tearDown(): void
    {
        @unlink($this->file);
        parent::tearDown();
    }

    public function test_index_lists_transactions(): void
    {
        $this->get('/transaction')->assertOk()->assertSee('Amy')->assertSee('Mccormick');
    }

    public function test_store_appends_row_in_header_order(): void
    {
        $this->post('/transaction', [
            'last_name' => 'Doe',
            'first_name' => 'Jane',
            'city' => '=HYPERLINK("x")',
        ])->assertCreated();

        $lines = file($this->file, FILE_IGNORE_NEW_LINES);
        $row = str_getcsv(end($lines), escape: '');
        $this->assertSame('Jane', $row[2]);
        $this->assertSame('Doe', $row[3]);
        $this->assertSame('\'=HYPERLINK("x")', $row[8]);
    }

    public function test_unknown_route_returns_json_404(): void
    {
        $this->get('/nope')->assertNotFound()->assertJson(['message' => 'Page Not Found']);
    }
}
