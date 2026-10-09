<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    private CustomerModel $customers;

    public function __construct()
    {
        $this->customers = new CustomerModel();
    }

    public function index(): string
    {
        return view('customers/index', [
            'title'      => 'Customer Accounts',
            'activePage' => 'customers',
            'customers'  => $this->customers->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function new(): string
    {
        return view('customers/form', [
            'title'      => 'Add Customer',
            'activePage' => 'customers',
            'customer'   => null,
            'isEdit'     => false,
        ]);
    }

    public function create()
    {
        $data = $this->customerData();

        if (! $this->validateData($data, $this->customerRules())) {
            return redirect()->to(site_url('customers/new'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $this->customers->insert($data);

        return redirect()->to(site_url('customers'))
            ->with('message', 'Customer added successfully.');
    }

    public function edit(int $id): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $customer = $this->customers->find($id);

        if ($customer === null) {
            return redirect()->to(site_url('customers'))
                ->with('error', 'That customer could not be found.');
        }

        return view('customers/form', [
            'title'      => 'Edit Customer',
            'activePage' => 'customers',
            'customer'   => $customer,
            'isEdit'     => true,
        ]);
    }

    public function update(int $id)
    {
        if ($this->customers->find($id) === null) {
            return redirect()->to(site_url('customers'))
                ->with('error', 'That customer could not be found.');
        }

        $data = $this->customerData();

        if (! $this->validateData($data, $this->customerRules())) {
            return redirect()->to(site_url('customers/' . $id . '/edit'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->customers->update($id, $data);

        return redirect()->to(site_url('customers'))
            ->with('message', 'Customer updated successfully.');
    }

    /**
     * @return array{full_name: string, email: string, phone: string|null}
     */
    private function customerData(): array
    {
        $phone = $this->input('phone');

        return [
            'full_name' => trim((string) $this->input('full_name')),
            'email'     => trim((string) $this->input('email')),
            'phone'     => $phone === null || trim($phone) === '' ? null : trim($phone),
        ];
    }

    /**
     * @return array<string, string>
     */
    private function customerRules(): array
    {
        return [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];
    }

    private function input(string $key): ?string
    {
        $value = $this->request->getPost($key);

        if ($value === null && $this->request->getMethod(true) === 'PUT') {
            $value = $this->request->getRawInput()[$key] ?? null;
        }

        return is_scalar($value) ? (string) $value : null;
    }
}
