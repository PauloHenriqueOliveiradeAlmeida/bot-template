<?php

namespace Database\Seeders;

use App\Shared\Infra\Database\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::firstOrCreate([
            "external_id" => "5515997840494"
        ], [
            "name" => "Company 123",
            "tenant_id" => "tenant_123",
            "external_id" => "5515997840494",
        ]);
    }
}