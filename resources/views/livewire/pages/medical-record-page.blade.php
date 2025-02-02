<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('เวชระเบียน') }}
                </h2>
                <x-danger-button
                    x-data="" class="bg-indigo-500"
                    x-on:click.prevent="$dispatch('open-modal', 'create-modal')">
                    {{ __('Create New') }}
                </x-danger-button>
            </div>
        </div>
    </header>
    <div class="pt-6">
        <div class="max-w-7xl mx-auto md:px-0 sm:px-6 lg:px-8">
            <div class="collapse collapse-arrow bg-white sm:rounded-lg">
                <input type="checkbox" name="my-accordion" id="accordion-1" class="hidden" />
                <label for="accordion-1" class="collapse-title text-lg text-black font-medium cursor-pointer">
                    ค้นหา
                </label>
                <div class="collapse-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                        <div class="w-full">
                            <label class="block">ประเภท</label>
                            <select wire:model.live="search_type" class="border px-3 py-2 rounded-lg w-full">
                                <option value="">-- โปรดเลือก --</option>
                                @foreach($patientType ?? [] as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <label class="block">สิทธิรักษา</label>
                            <select wire:model.live="search_healthcode" class="border px-3 py-2 rounded-lg w-full">
                                <option value="">-- โปรดเลือก --</option>
                                @foreach($healthcareCode as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <label class="block">วันที่เพิ่ม</label>
                            <input wire:model.live="search_date" type="date" class="border px-3 py-2 rounded-lg w-full">
                        </div>
                        <div class="w-full">
                            <label class="block">เพศ</label>
                            <select wire:model.live="search_gender" class="border px-3 py-2 rounded-lg w-full" wire:model="gender" id="gender">
                                <option value="">-- โปรดเลือก --</option>
                                @foreach($genders as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 flex justify-end">                       
                             <button class="btn px-4 py-0 bg-gray-800 border border-transparent rounded-md font-semibold">รีเซ็ท</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto md:px-0 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full py-12 px-4">
                    <div class="space-y-6">
                        <div class="mx-auto max-w-7xl md:px-0 sm:px-6 lg:px-8">
                            <div class="overflow-hidden bg-white sm:rounded-lg">
                                <div class="flex justify-between items-end">
                                    <h4>ทั้งหมด {{$patients->total()}} รายการ</h4>
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
                                                            วันที่
                                                        </span>
                                                    </th>
                                                    <th class="px-6 py-3 text-left bg-gray-50">
                                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">
                                                            Code No.
                                                        </span>
                                                    </th>
                                                    <th class="px-6 py-3 text-left bg-gray-50">
                                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">
                                                            เลขที่บัตร
                                                        </span>
                                                    </th>
                                                    <th class="px-6 py-3 text-left bg-gray-50">
                                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">
                                                            ชื่อ
                                                        </span>
                                                    </th>
                                                    <th class="px-6 py-3 text-left bg-gray-50">
                                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">
                                                            สังกัด
                                                        </span>
                                                    </th>
                                                    <th class="px-6 py-3 text-left bg-gray-50">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                                @forelse($patients as $index => $patient)
                                                <tr class="bg-white">
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        {{ ($patients->currentPage() - 1) * $patients->perPage() + $index + 1 }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        {{$patient->created_at}}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        {{$patient->code_no}}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        {{$patient->id_card_number ?? $patient->student_id}}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        {{$patient->firstname . ' ' . $patient->lastname }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                                        {{ 'org_id => '.$patient->org_id . '<br />' .
                                                            'position_type => '.$patient->position_type . '<br />' .
                                                            'fac_id => '.$patient->fac_id }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">

                                                        Edit
                                                        Delete

                                                    </td>
                                                </tr>
                                                @empty
                                                <tr class="bg-white">
                                                    <td colspan="7" class="px-6 py-4 text-sm leading-5 text-gray-800 text-center whitespace-no-wrap">
                                                        No patients found.
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-4">
                                        {{ $patients->links()}}
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
    <!-- Create Modal -->
    <x-modal name="create-modal" :show="$errors->isNotEmpty()" :maxWidth="'4xl'" focusable>
        <div class="p-6">

            <h2 class="text-lg font-medium text-gray-900 mb-3">
                {{ __('Create ผู้ป่วยใหม่') }}
            </h2>
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong>เกิดข้อผิดพลาด!</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form wire:submit.prevent="create">
                <div class="flex flex-wrap space-x-2 mb-4">
                    <button class="text-white bg-indigo-600 outline-none transition ease-in-out duration-150 px-4 py-2 me-2 rounded-lg">ผู้ป่วยใหม่</button>
                    <button class="bg-white border border-indigo-600  text-indigo-600  tracking-widest hover:text-white hover:bg-indigo-500 focus:text-white focus:bg-indigo-500 active:text-white active:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 px-4 py-2 rounded-lg">ผู้ป่วยเก่า</button>
                    <!-- <input type="text" placeholder="Code No." class="border px-3 py-2 rounded-lg flex-1 min-w-[120px]">
                    <input type="text" placeholder="บัตรประชาชน" class="border px-3 py-2 rounded-lg flex-1 min-w-[120px]">
                    <input type="text" placeholder="ชื่อ" class="border px-3 py-2 rounded-lg flex-1 min-w-[120px]">
                    <input type="text" placeholder="สกุล" class="border px-3 py-2 rounded-lg flex-1 min-w-[120px]">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">ค้นหา</button> -->
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                    <div>
                        <label class="col-span-1">Code No.</label>
                        <input wire:model="code_no" type="text" readonly class="border px-3 py-2 mb-3 bg-gray-100 text-gray-700 rounded-lg w-full">
                        <x-input-error :messages="$errors->get('code_no')" class="mt-2" />

                        <label class="block">ประเภท</label>
                        <select wire:model="patient_type" class="border px-3 py-2 rounded-lg w-full">
                            @foreach($patientType ?? [] as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('patient_type')" class="mt-2" />
                    </div>
                    <div class="row-span-2">
                        <label class="block">รูปภาพ</label>
                        <div class="border px-3 py-12 rounded-lg w-full flex items-center justify-center bg-gray-200 cursor-pointer" id="image-upload-container">
                            <input wire:model="profile_picture" type="file" id="image-upload" class="hidden" accept="image/*">
                            <span id="upload-text">อัพโหลดภาพ</span>
                            <img id="preview-image" class="hidden max-h-32" alt="Uploaded Image">
                        </div>

                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                    <div>
                        <label class="block">เลขที่บัตรประชาชน</label>
                        <input wire:model="id_card_number" type="text" class="border px-3 py-2 rounded-lg w-full "
                            name="id"
                            id="thai-id"
                            maxlength="22"
                            placeholder="0 - 0000 - 00000 - 00 - 0"
                            oninput="formatThaiID(this)"
                            onkeypress="return isNumber(event)">
                        <x-input-error :messages="$errors->get('id_card_number')" class="mt-2" />
                    </div>
                    <div>
                        <label class="block">เลขทะเบียนนักศึกษา</label>
                        <input wire:model="student_id" type="text" class="border px-3 py-2 rounded-lg w-full "
                            placeholder="เลขทะเบียนนักศึกษา"
                            onkeypress="return isNumber(event)">
                        <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                    <div>
                        <label class="block">คณะ</label>
                        <select wire:model="" class="border px-3 py-2 rounded-lg w-full" wire:model="gender" id="gender">
                            <option value="">-- โปรดเลือก --</option>
                            @foreach($faculites as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('')" class="mt-2" />
                    </div>
                    <div>
                        <label class="block">หน่วยงาน</label>
                        <select wire:model="" class="border px-3 py-2 rounded-lg w-full" wire:model="gender" id="gender">
                            <option value="">-- โปรดเลือก --</option>
                            @foreach($orgs as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('')" class="mt-2" />
                    </div>
                    <div>
                        <label class="block">ตำแหน่ง</label>
                        <select wire:model="" class="border px-3 py-2 rounded-lg w-full" wire:model="gender" id="gender">
                            <option value="">-- โปรดเลือก --</option>
                            @foreach($positions as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <label class="block">คำนำหน้า</label>
                        <select wire:model="title" class="border px-3 py-2 rounded-lg w-full mb-3">
                            <option value="">-- โปรดเลือก --</option>
                            @foreach($titles as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="md:col-span-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block">ชื่อ</label>
                                <input wire:model="firstname" type="text" placeholder="ชื่อ" class="border px-3 py-2 w-full rounded-lg">
                                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block">นามสกุล</label>
                                <input wire:model="lastname" type="text" placeholder="นามสกุล" class="border px-3 py-2 w-full rounded-lg">
                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 md:grid-cols-6 gap-4 w-full">
                    <div class="hidden md:col-span-5 md:flex md:justify-between md:gap-x-4">
                        <div class="w-full">
                            <label class="block">เพศ</label>
                            <select wire:model="gender" class="border px-3 py-2 rounded-lg w-full" wire:model="gender" id="gender">
                                <option value="">-- โปรดเลือก --</option>
                                @foreach($genders as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                        <div class="w-full">
                            <label class="block">วันเกิด</label>
                            <input wire:model="birthday" type="date" class="border px-3 py-2 rounded-lg w-full">
                            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                        </div>
                        <div class="w-full">
                            <label class="block">สิทธิรักษา</label>
                            <select wire:model="healthcare_code" class="border px-3 py-2 rounded-lg w-full">
                                <option value="">-- โปรดเลือก --</option>
                                @foreach($healthcareCode as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('healthcare_code')" class="mt-2" />
                        </div>
                    </div>
                    <div class="md:hidden col-span-2 flex justify-between gap-x-4">
                        <div class="w-full">
                            <label class="block">เพศ</label>
                            <select wire:model="gender" class="border px-3 py-2 rounded-lg w-full" wire:model="gender" id="gender">
                                <option value="">-- โปรดเลือก --</option>
                                @foreach($genders as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                        <div class="w-full">
                            <label class="block">วันเกิด</label>
                            <input wire:model="birthday" type="date" class="border px-3 py-2 rounded-lg w-full">
                            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                        </div>
                    </div>
                    <div class="md:hidden sm:col-span-1 w-full">
                        <label class="block">สิทธิรักษา</label>
                        <select wire:model="healthcare_code" class="border px-3 py-2 rounded-lg w-full">
                            <option value="">-- โปรดเลือก --</option>
                            @foreach($healthcareCode as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('healthcare_code')" class="mt-2" />
                    </div>
                    <div class="col-span-1 flex self-end">
                        <a class="btn bg-indigo-500 text-white px-4 py-2 rounded-lg w-32 text-center"
                            href="http://www.nhso.go.th/peoplesearch/" target="_blank">
                            ตรวจสอบ
                        </a>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block">ประวัติการเจ็บป่วย</label>
                    <textarea wire:model="medical_history" class="border px-3 py-2 rounded-lg w-full" rows="3"></textarea>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block">การสูบบุหรี่</label>
                        <select wire:model="smoking_freq" class="border px-3 py-2 rounded-lg w-full">
                            <option value="">-- โปรดเลือก --</option>
                            @foreach($smokingFreq as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('smoking_freq')" class="mt-2" />
                    </div>
                    <div>
                        <label class="block">การดื่มเครื่องดื่มแอลกอฮอล์</label>
                        <select wire:model="alcohol_freq" class="border px-3 py-2 rounded-lg w-full">
                            <option value="">-- โปรดเลือก --</option>
                            @foreach($alcoholFreq as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('alcohol_freq')" class="mt-2" />
                    </div>
                </div>

                <div id="allergy-container">
                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3 md:flex md:justify-between">
                        <div class="w-full">
                            <label class="block">แพ้ยา</label>
                            <input type="text" placeholder="แพ้ยา" class="border px-3 py-2 rounded-lg w-full">
                        </div>
                        <div class="w-full">
                            <label class="block">อาการแพ้ยา</label>
                            <input type="text" placeholder="อาการแพ้ยา" class="border px-3 py-2 rounded-lg w-full">
                            <x-input-error :messages="$errors->get('')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="mt-4 w-full flex justify-end">
                    <button id="add-allergy-btn" type="button" class=" bg-indigo-500 text-white px-4 py-2 rounded-lg  text-center">
                        เพิ่มรายการแพ้ยา
                    </button>
                </div>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block">โทรศัพท์มือถือ</label>
                        <input wire:model="mobile_number" type="text" placeholder="โทรศัพท์มือถือ" class="border px-3 py-2 rounded-lg w-full">
                    </div>
                    <div>
                        <label class="block">E-mail</label>
                        <input wire:model="email" type="email" placeholder="E-mail" class="border px-3 py-2 rounded-lg w-full">
                    </div>
                </div>

                <!-- <div class="mt-6 flex flex-wrap space-x-2">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">ลงผลตรวจ</button>
                    <button class="bg-blue-700 text-white px-4 py-2 rounded-lg">บันทึก</button>
                </div> -->

                <div class="flex items-center justify-end mt-4">
                    <button type="button" wire:click="$dispatch('close')" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>

                    <x-primary-button class="ms-4">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </x-modal>
    <!-- Edit Modal -->

</div>

<script>
    document.getElementById("add-allergy-btn").addEventListener("click", function() {
        const container = document.getElementById("allergy-container");
        const newDiv = document.createElement("div");
        newDiv.classList.add("mt-4", "grid", "grid-cols-1", "gap-4", "md:grid-cols-2");

        newDiv.innerHTML = `
            <div class="w-full">
                <label class="block">แพ้ยา</label>
                <input type="text" placeholder="แพ้ยา" class="border px-3 py-2 rounded-lg w-full">
            </div>
            <div class="w-full">
                <label class="block">อาการแพ้ยา</label>
                <div class="flex justify-between">
                    <input type="text" placeholder="อาการแพ้ยา" class="border px-3 py-2 rounded-lg w-full">
                    <button type="button" class="remove-allergy-btn py-2 px-2 ms-4 rounded-lg bg-gray-200 text-gray-500 hover:text-red-500 hover:bg-gray-50 justify-items-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                    </button>
                </div>
            </div>
        `;

        container.appendChild(newDiv);

        newDiv.querySelector(".remove-allergy-btn").addEventListener("click", function() {
            newDiv.remove();
        });
    });

    document.getElementById('image-upload-container').addEventListener('click', function() {
        document.getElementById('image-upload').click();
    });

    document.getElementById('image-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('preview-image').classList.remove('hidden');
                document.getElementById('upload-text').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    function formatThaiID(input) {
        let value = input.value.replace(/[^0-9]/g, ''); // ลบตัวอักษรที่ไม่ใช่ตัวเลข
        let formattedValue = '';

        // เพิ่ม '-' ในตำแหน่งที่เหมาะสม
        if (value.length > 0) formattedValue += value.substring(0, 1);
        if (value.length > 1) formattedValue += ' - ' + value.substring(1, 5);
        if (value.length > 5) formattedValue += ' - ' + value.substring(5, 10);
        if (value.length > 10) formattedValue += ' - ' + value.substring(10, 12);
        if (value.length > 12) formattedValue += ' - ' + value.substring(12, 13);

        input.value = formattedValue;
    }

    // ฟังก์ชันป้องกันการพิมพ์ตัวอักษรที่ไม่ใช่ตัวเลข
    function isNumber(event) {
        const charCode = event.which || event.keyCode;
        return charCode >= 48 && charCode <= 57; // เฉพาะตัวเลข 0-9
    }


    function handleResize() {
        const checkbox = document.getElementById("accordion-1");
        if (window.innerWidth >= 640) {
            checkbox.checked = true; // เปิดอัตโนมัติถ้าเป็นหน้าจอใหญ่
        } else {
            checkbox.checked = false; // ปิดเมื่อเป็นหน้าจอเล็ก
        }
    }

    window.addEventListener("resize", handleResize);
    window.addEventListener("load", handleResize); // ทำงานตอนโหลดหน้า  
</script>