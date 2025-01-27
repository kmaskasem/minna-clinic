<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('โรคประจำตัว') }}
                </h2>
                <x-danger-button
                    x-data="" class="bg-indigo-500"
                    x-on:click.prevent="$dispatch('open-modal', 'create-modal')">
                    {{ __('Create New') }}
                </x-danger-button>
            </div>
        </div>
    </header>

    <div class="py-6">
        <div class="max-w-7xl mx-auto md:px-0 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full py-12 px-4">
                    <div class="space-y-6">
                        <div class="mx-auto max-w-7xl md:px-0 sm:px-6 lg:px-8">
                            <div class="overflow-hidden bg-white sm:rounded-lg">
                                <div class="flex justify-between items-end">
                                    <h4>ทั้งหมด {{$ncds->total()}} รายการ</h4>
                                    <div id="search-box" class="flex flex-col items-center justify-center">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30" stroke="currentColor" class="h-6 w-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 18a8 8 0 100-16 8 8 0 000 16zm6-2l4 4" />
                                            </svg>
                                            <input wire:model.live="search" type="search" placeholder="Search" class="ms-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="py-6 overflow-hidden overflow-x-auto bg-white border-b border-gray-200 ">

                                    <div class="min-w-full align-middle">
                                        <table class="min-w-full border divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th class="px-6 py-3 text-left bg-gray-50">
                                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">
                                                            No.
                                                        </span>
                                                    </th>
                                                    <th class="px-6 py-3 text-left bg-gray-50">
                                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">
                                                            Code
                                                        </span>
                                                    </th>
                                                    <th class="px-6 py-3 text-left bg-gray-50">
                                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">
                                                            Name
                                                        </span>
                                                    </th>
                                                    <th class="px-6 py-3 text-left bg-gray-50">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">

                                            @forelse($ncds as $index => $ncd)
                                                <tr class="bg-white">
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        {{ ($ncds->currentPage() - 1) * $ncds->perPage() + $index + 1 }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        {{$ncd->code}}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        {{$ncd->name}}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        @if(isset($ncd))
                                                        <x-danger-button
                                                            x-data="" class="me-3 bg-indigo-500"
                                                            wire:click="showFaculty({{ $ncd->id }})">
                                                            Edit
                                                        </x-danger-button>
                                                        <x-danger-button
                                                            x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'delete-modal')">
                                                            Delete
                                                        </x-danger-button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr class="bg-white">
                                                    <td colspan="4" class="px-6 py-4 text-sm leading-5 text-gray-800 text-center whitespace-no-wrap">
                                                        No ncds found.
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforelse
                                        </table>
                                    </div>
                                    <div class="mt-4">
                                        {{ $ncds->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <x-modal name="delete-modal" :show="$errors->isNotEmpty()" :maxWidth="'md'" focusable>
        <div class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Delete โรคประจำตัว') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Are you sure you want to delete โรคประจำตัว?') }}
            </p>

            <div class="mt-6 flex justify-end">
                <div class="mt-4 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3"
                        x-on:click="deleteFaculty({{ $ncd->id ?? null}})">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </div>
        </div>
    </x-modal>
    <!-- Create Modal -->
    <x-modal name="create-modal" :show="$errors->isNotEmpty()" :maxWidth="'md'" focusable>
        <div class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Create โรคประจำตัว') }}
            </h2>

            <form wire:submit="create">
                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-4">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
    <!-- Edit Modal -->
    <x-modal name="edit-modal" :show="$errors->isNotEmpty()" :maxWidth="'md'" focusable>
        <div class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Edit โรคประจำตัว') }}
            </h2>

            <form wire:submit="update">
                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</div>