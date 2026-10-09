<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class Users extends BaseController
{
    private UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index(): string
    {
        return view('users/index', [
            'title'      => 'User Accounts',
            'activePage' => 'users',
            'users'      => $this->users->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function new(): string
    {
        return view('users/form', [
            'title'      => 'Add User',
            'activePage' => 'users',
            'user'       => null,
            'isEdit'     => false,
        ]);
    }

    public function create()
    {
        $data = $this->userData();

        if (! $this->validateData($data, $this->userRules())) {
            return redirect()->to(site_url('users/new'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $this->users->insert($data);

        return redirect()->to(site_url('users'))
            ->with('message', 'User added successfully.');
    }

    public function edit(int $id): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $user = $this->users->find($id);

        if ($user === null) {
            return redirect()->to(site_url('users'))
                ->with('error', 'That user could not be found.');
        }

        return view('users/form', [
            'title'      => 'Edit User',
            'activePage' => 'users',
            'user'       => $user,
            'isEdit'     => true,
        ]);
    }

    public function update(int $id)
    {
        $user = $this->users->find($id);

        if ($user === null) {
            return redirect()->to(site_url('users'))
                ->with('error', 'That user could not be found.');
        }

        $data = $this->userData();

        if (! $this->validateData($data, $this->userRules($id))) {
            return redirect()->to(site_url('users/' . $id . '/edit'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $avatar = $this->request->getFile('avatar');
        $hasNewAvatar = $avatar instanceof UploadedFile && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasNewAvatar && ! $this->validate([
            'avatar' => 'uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpeg,image/jpg,image/png]',
        ])) {
            return redirect()->to(site_url('users/' . $id . '/edit'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        if ($hasNewAvatar) {
            try {
                $data['avatar'] = $this->createAvatarThumbnail($avatar);
            } catch (\Throwable $exception) {
                return redirect()->to(site_url('users/' . $id . '/edit'))
                    ->withInput()
                    ->with('errors', ['avatar' => 'The avatar could not be processed. Please try another JPG or PNG image.']);
            }
        }

        // Omitting an avatar deliberately leaves the stored filename untouched.
        $this->users->update($id, $data);

        return redirect()->to(site_url('users'))
            ->with('message', 'User updated successfully.');
    }

    /**
     * @return array{username: string, full_name: string}
     */
    private function userData(): array
    {
        return [
            'username'  => trim((string) $this->input('username')),
            'full_name' => trim((string) $this->input('full_name')),
        ];
    }

    /**
     * @return array<string, string>
     */
    private function userRules(?int $ignoreId = null): array
    {
        $usernameRule = 'required|max_length[50]|is_unique[users.username]';

        if ($ignoreId !== null) {
            $usernameRule = 'required|max_length[50]|is_unique[users.username,id,' . $ignoreId . ']';
        }

        return [
            'username'  => $usernameRule,
            'full_name' => 'required|max_length[100]',
        ];
    }

    private function createAvatarThumbnail(UploadedFile $avatar): string
    {
        $temporaryDirectory = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatar-tmp';
        $avatarsDirectory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

        $this->ensureDirectory($temporaryDirectory);
        $this->ensureDirectory($avatarsDirectory);

        $temporaryName = $avatar->getRandomName();
        $avatar->move($temporaryDirectory, $temporaryName);

        $temporaryPath = $temporaryDirectory . DIRECTORY_SEPARATOR . $temporaryName;
        $avatarName = pathinfo($temporaryName, PATHINFO_FILENAME) . '.jpg';
        $avatarPath = $avatarsDirectory . DIRECTORY_SEPARATOR . $avatarName;

        try {
            service('image')
                ->withFile($temporaryPath)
                ->fit(300, 300, 'center')
                ->save($avatarPath, 85);
        } catch (\Throwable $exception) {
            if (is_file($avatarPath)) {
                unlink($avatarPath);
            }

            throw $exception;
        } finally {
            if (is_file($temporaryPath)) {
                unlink($temporaryPath);
            }
        }

        return $avatarName;
    }

    private function ensureDirectory(string $directory): void
    {
        if (! is_dir($directory) && ! mkdir($directory, 0775, true) && ! is_dir($directory)) {
            throw new \RuntimeException('Unable to create the avatar upload directory.');
        }
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
