<div 
    x-data="{
        showMessage: false,
        message: '',
        showSuccess(msg) {
            this.message = msg;
            this.showMessage = true;
            setTimeout(() => this.showMessage = false, 4000);
        },
        formatNomorPolisi(e) {
            let v = e.target.value.toUpperCase()
                .replace(/[^A-Z0-9]/g, '')
                .replace(/^([A-Z]{1,2})(\d{0,4})([A-Z]{0,3}).*$/, (m, a, b, c) => {
                    let parts = [];
                    if (a) parts.push(a);
                    if (b) parts.push(b);
                    if (c) parts.push(c);
                    return parts.join(' ');
                })
                .trim();
            e.target.value = v;
        },
        formatWhatsapp(e) {
            let v = e.target.value.replace(/\D/g, '');
            if (v.startsWith('0')) v = '62' + v.slice(1);
            if (!v.startsWith('62')) v = '62' + v;
            v = '+' + v;
            v = v.replace(/^(\+62)(\d{3,4})(\d{3,4})(\d+)?$/, (m, a, b, c, d) => {
                return [a, b, c, d].filter(Boolean).join(' ');
            });
            e.target.value = v;
        },
        limitLength(e, max) {
            if (e.target.value.length > max) {
                e.target.value = e.target.value.slice(0, max);
            }
        }
    }"
    x-on:booking-success.window="showSuccess($event.detail)"
    class="my-10 max-w-3xl mx-auto bg-white border border-gray-200 shadow-sm rounded-xl p-8"
>
    <template x-if="showMessage">
        <div 
            x-transition
            class="mb-5 p-4 rounded-lg bg-green-50 border border-green-300 text-green-700 font-medium"
        >
            <span x-text="message"></span>
        </div>
    </template>

    <h2 class="text-2xl font-semibold mb-6 text-gray-800">FORM BOOKING SERVICE </h2>

    <form wire:submit="save" class="space-y-5">
        <div>
            <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
            <input wire:model.defer="nama_pelanggan" type="text" id="nama_pelanggan"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                placeholder="Masukkan nama pelanggan" required>
        </div>

        <div>
            <label for="nomor_whatsapp" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
            <input wire:model.defer="nomor_whatsapp" type="text" id="nomor_whatsapp"
                x-on:input="formatWhatsapp($event); limitLength($event, 18)"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                placeholder="+62 812 3456 7890" required>
        </div>

        <div>
            <label for="merk_mobil" class="block text-sm font-medium text-gray-700 mb-1">Merk Mobil</label>
            <input wire:model.defer="merk_mobil" type="text" id="merk_mobil"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                placeholder="Contoh: Toyota Avanza" required>
        </div>

        <div>
            <label for="nomor_polisi" class="block text-sm font-medium text-gray-700 mb-1">Nomor Polisi</label>
            <input wire:model.defer="nomor_polisi" type="text" id="nomor_polisi"
                x-on:input="formatNomorPolisi($event)"
                maxlength="10"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                placeholder="Contoh: B 1234 AB" required>
        </div>

        <div>
            <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
            <textarea wire:model.defer="keluhan" id="keluhan" rows="4"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none"
                placeholder="Tuliskan keluhan kendaraan..." required></textarea>
        </div>

        <div>
            <label for="sumber_informasi" class="block text-sm font-medium text-gray-700 mb-1">Sumber Informasi</label>
            <select wire:model.defer="sumber_informasi" id="sumber_informasi"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                required>
                <option value="">-- Pilih Sumber --</option>
                <option value="langganan">Langganan</option>
                <option value="teman/saudara">Teman/Saudara</option>
                <option value="google_maps">Google Maps</option>
                <option value="media_sosial">Media Sosial</option>
            </select>
        </div>

        <div>
            <label for="tanggal_booking" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Booking</label>
            <input wire:model.defer="tanggal_booking" type="date" id="tanggal_booking"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                required>
        </div>

        <div>
            <label for="jam_booking" class="block text-sm font-medium text-gray-700 mb-1">Jam Booking</label>
            <input wire:model.defer="jam_booking" type="time" id="jam_booking"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                required>
        </div>

        <div>
            <label for="riwayat_service" class="block text-sm font-medium text-gray-700 mb-1">Riwayat Service</label>
            <textarea wire:model.defer="riwayat_service" id="riwayat_service" rows="4"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none"
                placeholder="Tuliskan riwayat service sebelumnya..."></textarea>
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit"
                class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-200 transition">
                Simpan Booking
            </button>
        </div>
    </form>
</div>
