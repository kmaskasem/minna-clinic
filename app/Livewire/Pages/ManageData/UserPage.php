<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use Livewire\WithPagination;

class UserPage extends Component
{
    use WithPagination;

    public $search;
    public $confirmDeletion = false;
    public $currentModal = null; // ตัวแปรเก็บชื่อ Modal
    public $selectedUserId = null; // เก็บ ID ของผู้ใช้สำหรับการลบ
    
    public $username, $password, $password_confirmation = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteUser($userId)
    {
        if ($this->selectedUserId) {
            User::findOrFail($this->selectedUserId)->delete();
            $this->reset(['selectedUserId']);
            // session()->flash('message', 'User deleted successfully.');
            $this->render();
        }
    }

    public function showUser($userId)
    {
        if (!$userId) {
            session()->flash('message', 'User not found.');
        }

        $this->selectedUserId = User::findOrFail($userId);
        $this->username = $this->selectedUserId->username;
        $this->password = $this->selectedUserId->password;
        $this->password_confirmation = $this->selectedUserId->password;
        $this->dispatch('open-modal', 'edit-modal');
    }

    public function update(): void
    {
        // $this->username = Auth::user()->username;

        $validated = $this->validate([
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $this->selectedUserId->fill($validated);

        $this->selectedUserId->save();

        $this->reset(['selectedUserId', 'username', 'password', 'password_confirmation']);
        $this->dispatch('close-modal', 'edit-modal');

        $this->render();
    }

    public function register(): void
    {
        $validated = $this->validate([
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        session()->flash('message', 'Created successfully.');

        $this->reset(['username', 'password', 'password_confirmation']);
        $this->dispatch('close-modal', 'create-modal');

        $this->render();
    }

    public function render()
    {
        $users = User::where('username', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.user-page', [
            'users' => $users->paginate(10),
        ]);
    }
}
