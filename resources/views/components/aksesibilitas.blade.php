<!-- ========================== -->
<!-- Panel Aksesibilitas -->
<!-- ========================== -->
<div 
    x-data="accessibilityMenu()" 
    @keydown.window.ctrl.u.prevent="open = !open"
    class="relative z-9999"
>

    <!-- Tombol Mengambang -->
    <button 
        @click="open = true"
        class="fixed bottom-6 right-6 bg-red-600 text-white p-4 rounded-full shadow-lg hover:bg-red-700 transition"
    >
        <i class="fa-solid fa-universal-access text-xl"></i>
    </button>

    <!-- Panel -->
    <div 
        x-show="open"
        x-transition
        class="fixed top-0 right-0 w-96 max-w-full h-full bg-white shadow-2xl border-l border-gray-200"
    >
        <!-- Header -->
        <div class="flex items-center justify-between p-4 bg-red-600 text-white">
            <h2 class="text-lg font-semibold">Menu Aksesibilitas (CTRL+U)</h2>
            <button @click="open = false" class="text-xl">✕</button>
        </div>

        <!-- Isi Panel -->
        <div class="p-4 space-y-6 overflow-y-auto h-[calc(100%-60px)]">

            <!-- Bahasa -->
            <div>
                <label class="text-gray-700 font-semibold">Bahasa</label>
                <select class="w-full mt-1 border-gray-300 rounded">
                    <option>Bahasa Indonesia</option>
                    <option>English</option>
                </select>
            </div>

            <!-- Profil Aksesibilitas -->
            <div>
                <h3 class="font-semibold text-lg mb-2">Profil Aksesibilitas</h3>

                <div class="grid grid-cols-2 gap-3">
                    <template x-for="item in profiles">
                        <button 
                            class="border p-3 rounded-lg flex items-center gap-2 transition"
                            :class="item.active 
                                ? 'bg-red-100 border-red-600 shadow-inner' 
                                : 'bg-white border-gray-300'"
                            @click="toggleProfile(item)"
                        >
                            <span x-text="item.icon" class="text-xl"></span>
                            <span x-text="item.label"></span>
                        </button>
                    </template>
                </div>
            </div>

            <!-- Ukuran Teks -->
            <div>
                <h3 class="font-semibold text-lg mb-2">Ukuran Teks</h3>
                <div class="grid grid-cols-3 gap-3">
                    <button class="border p-3 rounded text-center" @click="decreaseText()">A−</button>
                    <button class="border p-3 rounded text-center" @click="resetText()">A</button>
                    <button class="border p-3 rounded text-center" @click="increaseText()">A+</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ADHD CSS -->
<style>
.low-saturation {
    filter: saturate(40%);
}

.reading-mask {
    position: fixed;
    left: 0;
    width: 100%;
    height: 60px;
    background: rgba(255, 255, 0, 0.25);
    pointer-events: none;
    z-index: 9998;
    display: none;
}
</style>

<div id="readingMask" class="reading-mask"></div>

<!-- Script Alpine Aksesibilitas -->
<script>
function accessibilityMenu() {
    return {
        open: false,
        textScale: 1,
        adhdActive: false,

        profiles: [
            { label: "Gangguan Motorik", icon: "♿", active: false, key: "motorik" },
            { label: "Netra Total", icon: "👁️‍🗨️", active: false, key: "netra" },
            { label: "Buta Warna", icon: "🎨", active: false, key: "colorblind" },
            { label: "Disleksia", icon: "🔤", active: false, key: "dyslexia" },
            { label: "Gangguan Pengelihatan", icon: "👁️", active: false, key: "vision" },
            { label: "Kognitif & Pembelajaran", icon: "🧠", active: false, key: "cognitive" },
            { label: "Kejang & Epilepsi", icon: "⚡", active: false, key: "epilepsy" },
            { label: "ADHD", icon: "🎯", active: false, key: "adhd" },
        ],

        toggleProfile(item) {
            item.active = !item.active
            this.applyProfileEffect(item)
        },

        applyProfileEffect(item) {
            switch (item.key) {

                case "motorik":
                    document.body.classList.toggle("motorik-mode", item.active)
                    break

                case "netra":
                    document.documentElement.style.filter = item.active ? "grayscale(100%)" : "none"
                    break

                case "colorblind":
                    document.documentElement.style.filter = item.active ? "contrast(120%) saturate(60%)" : "none"
                    break

                case "dyslexia":
                    document.body.style.fontFamily = item.active ? "'OpenDyslexic', sans-serif" : ""
                    break

                case "vision":
                    document.body.style.letterSpacing = item.active ? "1.5px" : ""
                    document.body.style.lineHeight = item.active ? "1.8" : ""
                    break

                case "cognitive":
                    document.body.classList.toggle("low-distraction", item.active)
                    break

                case "epilepsy":
                    document.documentElement.classList.toggle("reduce-flash", item.active)
                    break

                case "adhd":
                    this.handleADHD(item.active)
                    break
            }
        },

        handleADHD(active) {
            const mask = document.getElementById("readingMask")

            // Efek 1: Saturasi rendah
            document.body.classList.toggle("low-saturation", active)

            // Efek 2: Reading mask
            if (active) {
                mask.style.display = "block"

                window.onmousemove = (e) => {
                    mask.style.top = (e.clientY - 30) + "px"
                }
            } else {
                mask.style.display = "none"
                window.onmousemove = null
            }
        },

        increaseText() {
            this.textScale += 0.1
            document.documentElement.style.fontSize = (this.textScale * 16) + "px"
        },

        decreaseText() {
            this.textScale = Math.max(0.6, this.textScale - 0.1)
            document.documentElement.style.fontSize = (this.textScale * 16) + "px"
        },

        resetText() {
            this.textScale = 1
            document.documentElement.style.fontSize = "16px"
        }
    }
}
</script>
