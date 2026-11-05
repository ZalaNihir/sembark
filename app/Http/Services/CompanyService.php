<?php

namespace App\Http\Services;

use App\Models\Company;
use App\Jobs\CreateCompanyDatabase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class CompanyService
{
    public function getCompanies()
    {
        $companies = Company::select('id', 'name', 'phone', 'email')->paginate(10);

        return $companies;
    }

    public function store($data)
    {
        $user = User::create([
            'name' => $data['user_name'],
            'email' => $data['user_email'],
            'password' => Hash::make(Str::random(64))
        ]);

        $company = Company::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'database_name' => $this->generateUniqueSlug($data['name']),
            'user_id'=>$user->id,
        ]);

        $user->update([
            'company_id' => $company->id,
        ]);

        $user->assignRole('Admin');

        CreateCompanyDatabase::dispatch($company);

        Password::sendResetLink([
            'email' => $user->email
        ]);

        return $company;
    }

    public function editCompany(Company $company, array $data){
        $company->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        if ($company->user) {
            $company->user->update([
                'name' => $data['user_name'],
                'email' => $data['user_email'],
            ]);
        }

        return $company;
    }

    public function deleteCompany(Company $company){
        DB::transaction(function () use ($company) {
            if ($company->user_id) {
                User::where('parent_id', $company->user_id)->delete();
                User::where('id', $company->user_id)->delete();
            }

            $company->delete();
        });
    }

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $databaseName = $slug;
        $counter = 1;

        while (Company::where('database_name', $databaseName)->exists()) {
            $databaseName = "{$slug}-{$counter}";
            $counter++;
        }

        return $databaseName;
    }
}
