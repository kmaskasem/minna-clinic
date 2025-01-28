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

    <div class="py-6">
        <div class="max-w-7xl mx-auto md:px-0 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full py-12 px-4">
                    <div class="space-y-6">
                        <div class="mx-auto max-w-7xl md:px-0 sm:px-6 lg:px-8">
                            <div class="overflow-hidden bg-white sm:rounded-lg">
                                <div class="flex justify-between items-end">
                                    <h4>ทั้งหมด รายการ</h4>
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
                                                            ID
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

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-4">

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
    <x-modal name="create-modal" :show="false" :maxWidth="'2xl'" focusable>
        <div class="p-6">

            <h2 class="text-lg font-medium text-gray-900 mb-3">
                {{ __('Create ผู้ป่วยใหม่') }}
            </h2>

            <form wire:submit="create">
                <div class="flex flex-wrap space-x-2 mb-4">
                    <button class="bg-indigo-700 text-white px-4 py-2 rounded-lg">ผู้ป่วยใหม่</button>
                    <button class="bg-indigo-500 text-white px-4 py-2 rounded-lg">ผู้ป่วยเก่า</button>
                    <!-- <input type="text" placeholder="Code No." class="border px-3 py-2 rounded-lg flex-1 min-w-[120px]">
                    <input type="text" placeholder="บัตรประชาชน" class="border px-3 py-2 rounded-lg flex-1 min-w-[120px]">
                    <input type="text" placeholder="ชื่อ" class="border px-3 py-2 rounded-lg flex-1 min-w-[120px]">
                    <input type="text" placeholder="สกุล" class="border px-3 py-2 rounded-lg flex-1 min-w-[120px]">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">ค้นหา</button> -->
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                    <div>
                        <label class="block">ประเภท</label>
                        <select class="border px-3 py-2 rounded-lg w-full mb-3">
                            <option>บุคคลทั่วไป</option>
                        </select>
                        <label class="col-span-1">Code No.</label>
                        <input type="text" placeholder="Code No." class="border px-3 py-2 rounded-lg w-full">
                    </div>
                    <div class="row-span-2">
                        <label class="block">รูปภาพ</label>
                        <div class="border px-3 py-12 rounded-lg w-full flex items-center justify-center bg-gray-200 cursor-pointer" id="image-upload-container">
                            <input type="file" id="image-upload" class="hidden" accept="image/*">
                            <span id="upload-text">อัพโหลดภาพ</span>
                            <img id="preview-image" class="hidden max-h-32" alt="Uploaded Image">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                    <div>
                        <label class="block">เลขที่บัตรประชาชน</label>
                        <input type="text" class="border px-3 py-2 rounded-lg w-full "
                            name="id"
                            id="thai-id"
                            maxlength="22"
                            placeholder="0 - 0000 - 00000 - 00 - 0"
                            oninput="formatThaiID(this)"
                            onkeypress="return isNumber(event)">
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <label class="block">คำนำหน้า</label>
                        <select class="border px-3 py-2 rounded-lg w-full mb-3">
                            <option>นาย</option>
                            <option>นาง</option>
                            <option>นางสาว</option>
                        </select>
                    </div>
                    <div class="md:col-span-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block">ชื่อ</label>
                                <input type="text" placeholder="ชื่อ" class="border px-3 py-2 w-full rounded-lg">
                            </div>
                            <div>
                                <label class="block">นามสกุล</label>
                                <input type="text" placeholder="นามสกุล" class="border px-3 py-2 w-full rounded-lg">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block">เพศ</label>
                        <select class="border px-3 py-2 rounded-lg w-full">
                            <option>ชาย</option>
                            <option>หญิง</option>
                        </select>
                    </div>
                    <div>
                        <label class="block">วันเกิด</label>
                        <input type="date" class="border px-3 py-2 rounded-lg w-full">
                    </div>
                    <div class="col-span-2">
                        <label class="block">สิทธิรักษา</label>
                        <div class="flex justify-between">
                            <select class="border px-3 py-2 rounded-lg w-full">
                                <option>ไม่ระบุ</option>
                                <option>บัตรประกันสุขภาพ</option>
                                <option>ประกันสังคม</option>
                                <option>สิทธิข้าราชการ</option>
                                <option>สิทธิว่าง</option>
                            </select>
                            <button class="bg-blue-700 ms-3 text-white px-4 py-2 rounded-lg">ค้นหา</button>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block">ประวัติการเจ็บป่วย</label>
                    <textarea class="border px-3 py-2 rounded-lg w-full" rows="3"></textarea>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block">การสูบบุหรี่</label>
                        <select class="border px-3 py-2 rounded-lg w-full">
                            <option>ไม่ระบุ</option>
                            <option>ไม่สูบ</option>
                            <option>สูบบุหรี่มวน ไม่เกิน 5 มวน/วัน</option>
                            <option>สูบบุหรี่ไฟฟ้า</option>
                            <option>นานๆ สูบที</option>
                            <option>เคยสูบแต่เลิกแล้ว</option>
                            <option>สูบไม่เกิน 10 มวน/วัน</option>
                            <option>สูบมากกว่า 10 มวน/วัน</option>
                        </select>
                    </div>
                    <div>
                        <label class="block">การดื่มเครื่องดื่มแอลกอฮอล์</label>
                        <select class="border px-3 py-2 rounded-lg w-full">
                            <option>ไม่ระบุ</option>
                            <option>ไม่ดื่ม</option>
                            <option>ดื่มเมื่อเข้าสังคม</option>
                            <option>ดื่มเป็นประจำ</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" placeholder="แพ้ยา" class="border px-3 py-2 rounded-lg">
                    <input type="text" placeholder="อาการแพ้ยา" class="border px-3 py-2 rounded-lg">
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" placeholder="โทรศัพท์มือถือ" class="border px-3 py-2 rounded-lg">
                    <input type="email" placeholder="E-mail" class="border px-3 py-2 rounded-lg">
                </div>

                <div class="mt-6 flex flex-wrap space-x-2">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">ลงผลตรวจ</button>
                    <button class="bg-blue-700 text-white px-4 py-2 rounded-lg">บันทึก</button>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" wire:click="$dispatch('close')" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>

                    <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Create
                    </button>
                </div>
            </form>

        </div>
    </x-modal>
    <!-- Edit Modal -->

</div>

<script>
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
</script>