<div 
    x-data="{
        showMessage: false,
        message: '',
        loading: false,
        pelayanan: @entangle('pelayanan'),
        durasi: @entangle('durasi'),

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
        }
    }"
    x-on:testimonial-success.window="showSuccess($event.detail); loading = false;"
    class="my-10 max-w-3xl mx-auto bg-white border border-gray-200 shadow-lg rounded-2xl p-8 relative overflow-hidden"
>
    <!-- Background subtle animation -->
    <div class="absolute inset-0 bg-gradient-to-br opacity-70 animate-pulse-slow"></div>

    <template x-if="showMessage">
        <div 
            x-transition
            class="mb-5 p-4 rounded-lg bg-green-50 border border-green-300 text-green-700 font-medium relative z-10 shadow-sm"
        >
            <span x-text="message"></span>
        </div>
    </template>

    <h2 class="text-2xl font-semibold mb-6 text-gray-800 relative z-10">
        FORM TESTIMONIAL
    </h2>

    <form 
        wire:submit.prevent="save"
        class="space-y-6 relative z-10"
    >
        <!-- Nomor Polisi -->
        <div x-data="{ focused: false }" class="transition">
            <label for="nomor_polisi" class="block text-sm font-medium text-gray-700 mb-1">Nomor Polisi</label>
            <input wire:model.defer="nomor_polisi" type="text" id="nomor_polisi"
                x-on:input="formatNomorPolisi($event)"
                x-on:focus="focused = true" 
                x-on:blur="focused = false"
                maxlength="10"
                class="block w-full rounded-lg border px-3 py-2 text-gray-900 transition-all duration-200 
                       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 
                       border-gray-300"
                :class="focused ? 'shadow-md scale-[1.01]' : ''"
                placeholder="Contoh: B 1234 AB" required>
        </div>

        <!-- Pelayanan -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Pelayanan</label>
            <div class="flex flex-wrap gap-2">
                <button type="button" x-on:click="pelayanan = 5"
                    :class="pelayanan == 5 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Sangat Puas
                </button>
                <button type="button" x-on:click="pelayanan = 4"
                    :class="pelayanan == 4 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Puas
                </button>
                <button type="button" x-on:click="pelayanan = 3"
                    :class="pelayanan == 3 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Cukup
                </button>
                <button type="button" x-on:click="pelayanan = 2"
                    :class="pelayanan == 2 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Kurang
                </button>
                <button type="button" x-on:click="pelayanan = 1"
                    :class="pelayanan == 1 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Tidak Puas
                </button>
            </div>
        </div>

        <!-- Durasi -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Durasi</label>
            <div class="flex flex-wrap gap-2">
                <button type="button" x-on:click="durasi = 5"
                    :class="durasi == 5 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Sangat Cepat
                </button>
                <button type="button" x-on:click="durasi = 4"
                    :class="durasi == 4 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Cepat
                </button>
                <button type="button" x-on:click="durasi = 3"
                    :class="durasi == 3 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Cukup
                </button>
                <button type="button" x-on:click="durasi = 2"
                    :class="durasi == 2 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Lama
                </button>
                <button type="button" x-on:click="durasi = 1"
                    :class="durasi == 1 ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    class="px-3 py-2 rounded-lg border text-sm font-medium transition duration-150">
                    Sangat Lama
                </button>
            </div>
        </div>

        <!-- Kesan -->
        <div>
            <label for="kesan" class="block text-sm font-medium text-gray-700 mb-1">Kesan</label>
            <textarea wire:model.defer="kesan" id="kesan" rows="4"
                class="block w-full rounded-lg border px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none border-gray-300"
                placeholder="Tuliskan kesan Anda..." required></textarea>
        </div>

        <!-- Saran -->
        <div>
            <label for="saran" class="block text-sm font-medium text-gray-700 mb-1">Saran</label>
            <textarea wire:model.defer="saran" id="saran" rows="4"
                class="block w-full rounded-lg border px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none border-gray-300"
                placeholder="Tuliskan saran Anda..." required></textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end pt-2">
            <button type="submit"
                wire:loading.attr="disabled"
                class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-200 transition">
                <span wire:loading.remove>Kirim Testimonial</span>
                <span wire:loading>Memproses...</span>
            </button>
        </div>
    </form>
</div>
