<!-- ========================== -->
<!-- Accessibility Panel -->
<!-- ========================== -->

<style>
.active-btn {
    background-color: #0e7490 !important;
    color: white !important;
}

[x-cloak]{display:none !important}
</style>

<div 
    x-data="accessibilityMenu()"
    x-init="init()"
    @keydown.window.ctrl.u.prevent="open = !open"
    class="relative z-9999"
>

    <!-- Floating Button -->
    <button 
        x-show="showFloating"
        x-transition.duration.500ms
        @click="open = !open"
        class="fixed bottom-6 right-6 p-4 bg-cyan-600 text-white rounded-full shadow-lg hover:bg-cyan-500"
    >   <i class="fa-solid fa-sliders"></i>
    </button>


    <!-- PANEL -->
    <div 
        x-show="open"
        x-transition
        x-cloak
        @click.outside="open = false"
        class="fixed top-0 right-0 w-96 h-full bg-white shadow-2xl border-l border-gray-200 flex flex-col"
    >
        <div class="flex items-center justify-between p-4 bg-cyan-900 text-white">
            <h2 class="text-lg font-semibold">Accessibility Tools</h2>
            <button @click="open = false" class="text-xl">✕</button>
        </div>

        <script>
        document.addEventListener('click', function(e) {
            const panel = document.querySelector('[x-data="accessibilityMenu()"] > div[x-show]');
            const toggleBtn = document.querySelector('[x-data="accessibilityMenu()"] button');
            if (!panel) return;
            if (!panel.contains(e.target) && !toggleBtn.contains(e.target)) {
                const alpine = document.querySelector('[x-data="accessibilityMenu()"]');
                if (alpine.__x) alpine.__x.$data.open = false;
            }
        });
        </script>

        <div class="p-4 space-y-10 overflow-y-auto flex-1">

            {{-- ========== ADHD MODE ========== --}}

            <div>
                <h3 class="font-semibold text-lg text-cyan-900 mb-2">ADHD Mode</h3>
                <div class="grid grid-cols-1 gap-3 text-center">
                    <button class="btn border p-3 rounded" :class="adhdActive ? 'active-btn' : ''" @click="ADHD()">
                        <i class="fa-solid fa-brain"></i>
                        <span class="text-xs block mt-1">Enable</span>
                    </button>
                </div>
            </div>

            <!-- ========== FONT SIZE ========== -->
            <div>
                <h3 class="font-semibold text-lg text-cyan-900 mb-2">Font Size</h3>
                <div class="grid grid-cols-2 gap-3 text-center">

                    <button class="btn border p-3 rounded" :class="font.mode=='dec' ? 'active-btn' : ''" @click="font.decrease()">
                        <i class="fa-solid fa-text-height"></i>
                        <span class="text-xs block mt-1">Smaller</span>
                    </button>

                    <button class="btn border p-3 rounded" :class="font.mode=='inc' ? 'active-btn' : ''" @click="font.increase()">
                        <i class="fa-solid fa-text-height"></i>
                        <span class="text-xs block mt-1">Bigger</span>
                    </button>

                </div>
            </div>

            <!-- ========== ALIGNMENT ========== -->
            <div>
                <h3 class="font-semibold text-lg text-cyan-900 mb-2">Text Alignment</h3>
                <div class="grid grid-cols-4 gap-2 text-center">

                    <button class="btn border p-3 rounded" :class="layout.alignMode=='left' ? 'active-btn' : ''" @click="layout.align('left')">
                        <i class="fa-solid fa-align-left"></i>
                        <span class="text-xs block mt-1">Left</span>
                    </button>

                    <button class="btn border p-3 rounded" :class="layout.alignMode=='center' ? 'active-btn' : ''" @click="layout.align('center')">
                        <i class="fa-solid fa-align-center"></i>
                        <span class="text-xs block mt-1">Center</span>
                    </button>

                    <button class="btn border p-3 rounded" :class="layout.alignMode=='right' ? 'active-btn' : ''" @click="layout.align('right')">
                        <i class="fa-solid fa-align-right"></i>
                        <span class="text-xs block mt-1">Right</span>
                    </button>

                    <button class="btn border p-3 rounded" :class="layout.alignMode=='justify' ? 'active-btn' : ''" @click="layout.align('justify')">
                        <i class="fa-solid fa-align-justify"></i>
                        <span class="text-xs block mt-1">Justify</span>
                    </button>

                </div>
            </div>

            <!-- ========== LINE HEIGHT ========== -->
            <div>
                <h3 class="font-semibold text-lg text-cyan-900 mb-2">Line Height</h3>
                <div class="grid grid-cols-2 gap-3 text-center">

                    <button class="btn border p-3 rounded" :class="layout.lineHeightMode==1.2 ? 'active-btn' : ''" @click="layout.lineHeight(1.2)">
                        <i class="fa-solid fa-arrow-up-wide-short rotate-180"></i>
                        <span class="text-xs block mt-1">Tight</span>
                    </button>

                    <button class="btn border p-3 rounded" :class="layout.lineHeightMode==2 ? 'active-btn' : ''" @click="layout.lineHeight(2)">
                        <i class="fa-solid fa-arrow-up-wide-short"></i>
                        <span class="text-xs block mt-1">Wide</span>
                    </button>

                </div>
            </div>

            <!-- ========== LETTER SPACING ========== -->
            <div>
                <h3 class="font-semibold text-lg text-cyan-900 mb-2">Letter Spacing</h3>
                <div class="grid grid-cols-3 gap-3 text-center">

                    <button class="btn border p-3 rounded" :class="layout.spacingMode=='0px' ? 'active-btn' : ''" @click="layout.spacing('0px')">
                        <i class="fa-solid fa-arrows-left-right"></i>
                        <span class="text-xs block mt-1">Normal</span>
                    </button>

                    <button class="btn border p-3 rounded" :class="layout.spacingMode=='1px' ? 'active-btn' : ''" @click="layout.spacing('1px')">
                        <i class="fa-solid fa-arrows-left-right"></i>
                        <span class="text-xs block mt-1">Medium</span>
                    </button>

                    <button class="btn border p-3 rounded" :class="layout.spacingMode=='2px' ? 'active-btn' : ''" @click="layout.spacing('2px')">
                        <i class="fa-solid fa-arrows-left-right"></i>
                        <span class="text-xs block mt-1">Wide</span>
                    </button>

                </div>
            </div>

            <!-- ========== SATURATION ========== -->
            <div>
                <h3 class="font-semibold text-lg text-cyan-900 mb-2">Saturation</h3>
                <div class="grid grid-cols-1 gap-3 text-center">

                    <button class="btn border p-3 rounded" :class="visual.saturateActive ? 'active-btn' : ''" @click="visual.saturate()">
                        <i class="fa-solid fa-droplet"></i>
                        <span class="text-xs block mt-1">Low Color</span>
                    </button>
                </div>
            </div>

            <!-- ========== CONTRAST ========== -->
            <div>
                <h3 class="font-semibold text-lg text-cyan-900 mb-2">Contrast</h3>
                <div class="grid grid-cols-1 gap-3 text-center">

                    <button class="btn border p-3 rounded" :class="visual.contrastActive ? 'active-btn' : ''" @click="visual.contrast()">
                        <i class="fa-solid fa-adjust"></i>
                        <span class="text-xs block mt-1">High</span>
                    </button>
                </div>
            </div>

            <!-- ========== READING MASK ========== -->
            <div>
                <h3 class="font-semibold text-lg text-cyan-900 mb-2">Reading Mask</h3>
                <div class="grid grid-cols-1 gap-3 text-center">

                    <button class="btn border p-3 rounded" :class="cursor.active ? 'active-btn' : ''" @click="cursor.maskOn()">
                        <i class="fa-solid fa-highlighter"></i>
                        <span class="text-xs block mt-1">Enable</span>
                    </button>
                </div>
            </div>

            <!-- ========== DYSLEXIA FONT ========== -->
            <div>
                <h3 class="font-semibold text-lg text-cyan-900 mb-2">Dyslexia Mode</h3>
                <div class="grid grid-cols-1 gap-3 text-center">

                    <button class="btn border p-3 rounded" :class="assist.dyslexia ? 'active-btn' : ''" @click="assist.dyslexiaOn()">
                        <i class="fa-solid fa-font"></i>
                        <span class="text-xs block mt-1">Enable</span>
                    </button>
                </div>
            </div>

            <!-- ========== HOVER TOOLTIP ========== -->
            

            <!-- RESET -->
            <button class="w-full py-3 bg-cyan-600 text-white rounded-lg hover:bg-cyan-500">
                <i class="fa-solid fa-rotate-left"></i> Reset All
            </button>

        </div>
    </div>
</div>

<!-- Tooltip -->
<div id="hoverTooltip" class="fixed px-3 py-1 bg-black text-white text-sm rounded hidden pointer-events-none"></div>

<!-- Mask -->
<style>
#readingMask {
    position: fixed;
    left: 0;
    width: 100%;
    height: 100px; /* area baca nyaman untuk paragraf */
    pointer-events: none;
    display: none;
    z-index: 9998;

    /* Efek highlight yang lembut */
    backdrop-filter: brightness(2.5);

    /* Garis tepi yang elegan */
    border-top: 10px solid rgb(0, 0, 0);
    border-bottom: 10px solid rgb(0, 0, 0);

}


#bgDimmer {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.65); /* meredupkan background */
    pointer-events: none;
    display: none;
    z-index: 9997;
}

</style>
<div id="bgDimmer"></div>
<div id="readingMask"></div>

<!-- ROOT WRAPPER APP -->
<div id="appRoot">
    <!-- seluruh konten app -->
</div>

<script>
function accessibilityMenu() {
    return {

        open: false,
        showFloating: false,
        adhdActive: false,

        /* ADHD MODE */
        ADHD() {
            this.adhdActive = !this.adhdActive;

                const mask = document.getElementById("readingMask");
                const dimmer = document.getElementById("bgDimmer");

                if (this.adhdActive) {
                    dimmer.style.display = "block";
                    mask.style.display = "block";
                    
                    
                    window.onmousemove = (e) => {
                        mask.style.top = (e.clientY - 35) + "px";
                    };

                    document.documentElement.style.filter = "saturate(40%)";

                } else {
                dimmer.style.display = "none";
                mask.style.display = "none";
                window.onmousemove = null;
                
                
                document.documentElement.style.filter = "none";
            }
        },


        /* FONT MODULE */
        font: {
            scale: 1,
            mode: '',
            toggle(mode, amount = 0) {
                if (this.mode === mode) {
                    // turning off → reset
                    this.mode = '';
                    this.scale = 1;
                    document.documentElement.style.fontSize = "16px";
                } else {
                    // turning on
                    this.mode = mode;
                    this.scale = mode === 'inc' ? this.scale + amount :
                                mode === 'dec' ? Math.max(0.6, this.scale - amount) : 1;

                    document.documentElement.style.fontSize = (this.scale * 16) + "px";
                }
            },
            increase() { this.toggle('inc', 0.1); },
            decrease() { this.toggle('dec', 0.1); },
            reset()    { this.toggle('reset', 0); }
        },

        /* VISUAL MODULE */
        visual: {
            saturateActive: false,
            contrastActive: false,

            saturate() {
                this.saturateActive = !this.saturateActive;
                this.apply();
            },

            contrast() {
                this.contrastActive = !this.contrastActive;
                this.apply();
            },

            apply() {
                if (!this.saturateActive && !this.contrastActive) {
                    document.documentElement.style.filter = "none";
                } else if (this.saturateActive && !this.contrastActive) {
                    document.documentElement.style.filter = "saturate(40%)";
                } else if (!this.saturateActive && this.contrastActive) {
                    document.documentElement.style.filter = "contrast(130%)";
                } else {
                    document.documentElement.style.filter = "saturate(40%) contrast(130%)";
                }
            },

            resetSaturate() {
                this.saturateActive = false;
                this.apply();
            },

            resetContrast() {
                this.contrastActive = false;
                this.apply();
            }
        },

        /* LAYOUT MODULE */
        layout: {
            alignMode: '',
            lineHeightMode: '',
            spacingMode: '',

            align(value) {
                this.alignMode = this.alignMode === value ? '' : value;
                document.body.style.textAlign = this.alignMode;
            },

            lineHeight(value) {
                this.lineHeightMode = this.lineHeightMode === value ? '' : value;
                document.body.style.lineHeight = this.lineHeightMode || "";
            },

            spacing(value) {
                this.spacingMode = this.spacingMode === value ? '' : value;
                document.body.style.letterSpacing = this.spacingMode || "";
            }
        },

        /* MASK MODULE */
        cursor: {
            active: false,
            maskOn() {
                this.active = !this.active;

                const mask = document.getElementById("readingMask");
                const dimmer = document.getElementById("bgDimmer");
            
                if (this.active) {
                
                    dimmer.style.display = "block";
                    mask.style.display = "block";
                
                    window.onmousemove = (e) => {
                        mask.style.top = (e.clientY - 35) + "px";  // posisi strip terang
                    };
                
                } else {
                
                    dimmer.style.display = "none";
                    mask.style.display = "none";
                    window.onmousemove = null;
                }
            },
        
            maskOff() {
                this.active = false;
            
                document.getElementById("bgDimmer").style.display = "none";
                document.getElementById("readingMask").style.display = "none";
            
                window.onmousemove = null;
            }
        },

        /* ASSIST MODULE */
        assist: {
            dyslexia: false,
            hover: false,

            dyslexiaOn() {
                this.dyslexia = !this.dyslexia;
                document.body.style.fontFamily = this.dyslexia ? "'OpenDyslexic', sans-serif" : "";
            },

            hoverOn() {
                this.hover = !this.hover;
                const tooltip = document.getElementById("hoverTooltip");
                const root = document.getElementById("appRoot");

                if (this.hover) {
                    root.querySelectorAll("*").forEach(el => {
                        el.onmouseenter = () => {
                            if (!el.innerText.trim()) return;
                            tooltip.innerText = el.innerText.substring(0, 80);
                            tooltip.style.display = "block";
                        };
                        el.onmouseleave = () => {
                            tooltip.style.display = "none";
                        };
                    });

                    window.onmousemove = (e) => {
                        tooltip.style.left = (e.clientX + 15) + "px";
                        tooltip.style.top = (e.clientY + 15) + "px";
                    };

                } else {
                    tooltip.style.display = "none";

                    root.querySelectorAll("*").forEach(el => {
                        el.onmouseenter = null;
                        el.onmouseleave = null;
                    });

                    window.onmousemove = null;
                }
            },

            hoverOff() {
                this.hover = false;
                const tooltip = document.getElementById("hoverTooltip");
                tooltip.style.display = "none";

                const root = document.getElementById("appRoot");
                root.querySelectorAll("*").forEach(el => {
                    el.onmouseenter = null;
                    el.onmouseleave = null;
                });

                window.onmousemove = null;
            }
        },

        /* RESET ALL */
        resetAll() {

            /* Reset Font */
            this.font.mode = '';
            this.font.scale = 1;
            document.documentElement.style.fontSize = "16px";

            /* Reset Visual */
            this.visual.saturateActive = false;
            this.visual.contrastActive = false;
            document.documentElement.style.filter = "none";

            /* Reset Layout */
            this.layout.alignMode = '';
            this.layout.lineHeightMode = '';
            this.layout.spacingMode = '';
            document.body.style.textAlign = "";
            document.body.style.lineHeight = "";
            document.body.style.letterSpacing = "";

            /* Reset Mask */
            this.cursor.active = false;
            const mask = document.getElementById("readingMask");
            mask.style.display = "none";
            window.onmousemove = null;

            /* Reset Dyslexia */
            this.assist.dyslexia = false;
            document.body.style.fontFamily = "";

            /* Reset Hover Tooltip */
            this.assist.hover = false;
            const tooltip = document.getElementById("hoverTooltip");
            tooltip.style.display = "none";

            const root = document.getElementById("appRoot");
            root.querySelectorAll("*").forEach(el => {
                el.onmouseenter = null;
                el.onmouseleave = null;
            });
        },

        /* INIT: Floating button muncul setelah 5 detik */
        init() {
            this.open = false;
            setTimeout(() => {
                this.showFloating = true;
            }, 2000);
        }

    }
}
</script>


