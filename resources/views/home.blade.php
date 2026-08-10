@extends('layouts.app')

@section('content')
<div class="min-h-screen text-theme-text transition-colors duration-500"
     x-data="{ 
         activeMoodId: null,
         products: {{ Js::from($products) }},
         moods: {{ Js::from($moods) }},
         
         get coffeeProducts() {
             let filtered = this.products.filter(p => p.category.slug === 'coffee');
             if (this.activeMoodId) {
                 filtered = filtered.filter(p => p.mood_id === this.activeMoodId);
             }
             return filtered;
         },
         
         get bakeryProducts() {
             return this.products.filter(p => p.category.slug === 'brownies' || p.category.slug === 'deals');
         },
         
         selectedProduct: null
     }">

    <!-- 1. HOME INTRO SECTION -->
    <section id="intro" class="relative min-h-screen flex flex-col justify-center pt-24 md:pt-0 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 w-full flex flex-col md:flex-row items-center gap-12">
            
            <!-- Left: Cafe Features & Intro -->
            <div class="w-full md:w-1/2 flex flex-col justify-center space-y-8 z-10"
                 x-data="{ shown: false }" x-intersect.once="shown = true"
                 :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'"
                 style="transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);">
                 
                <div class="inline-block px-4 py-1.5 rounded-full border-2 border-theme-primary text-theme-primary text-[10px] font-extrabold uppercase tracking-widest self-start shadow-[3px_3px_0px_currentColor]">
                    Premium Cafe Experience
                </div>
                
                <h1 class="text-6xl md:text-8xl font-black font-['Instrument_Serif'] leading-[1.0] text-theme-primary">
                    Artisanal <br/>
                    <span class="italic text-theme-accent">Coffee</span>
                </h1>
                
                <p class="text-theme-text/80 text-lg leading-relaxed font-medium max-w-md">
                    Experience coffee crafted for your mood. From ethically sourced beans with full <strong class="text-theme-primary font-bold">Trace to Farm</strong> transparency, to expertly paired bakery items. Earn reward beans with every purchase.
                </p>
                
                <div class="flex items-center gap-4 pt-4">
                    <a href="#coffee" class="bg-theme-primary text-theme-bg px-8 py-4 rounded-full font-bold uppercase tracking-widest text-xs hover:bg-theme-text transition-colors shadow-[4px_4px_0px_currentColor] text-theme-primary">
                        <span class="text-theme-bg">Explore Coffees</span>
                    </a>
                </div>
            </div>
            
            <!-- Right: Dynamic 3D Coffee Cup Showcase -->
            <div class="w-full md:w-1/2 flex items-center justify-center relative z-10 h-[60vh] md:h-[80vh]">
                <!-- Interactive 3D CSS Coffee Element -->
                <div class="relative w-72 h-72 md:w-96 md:h-96 group perspective-1000">
                    <div class="w-full h-full relative preserve-3d animate-[spin_20s_linear_infinite] group-hover:[animation-play-state:paused] transition-all duration-500">
                        <!-- We use a high quality coffee image masked into a circle, giving it a 3D float/spin feel -->
                        <div class="absolute inset-0 rounded-full border-4 border-theme-primary shadow-[20px_20px_60px_rgba(0,0,0,0.2)] overflow-hidden transform translate-z-12">
                            <img src="/images/coffee/Americano.jpg" alt="3D Coffee" class="w-full h-full object-cover scale-125">
                        </div>
                        
                        <!-- Floating Badges orbiting the cup -->
                        <div class="absolute -top-4 -right-4 bg-theme-bg border-2 border-theme-primary text-theme-primary px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest shadow-[4px_4px_0px_currentColor] animate-bounce">
                            100% Organic
                        </div>
                        <div class="absolute -bottom-8 -left-8 bg-theme-accent text-white border-2 border-theme-primary px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest shadow-[4px_4px_0px_currentColor] animate-pulse">
                            Trace to Farm 🌱
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. COFFEE SECTION (Mood Categorized) -->
    <section id="coffee" class="py-24 bg-theme-primary/5 border-t-2 border-theme-primary/10 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-5xl md:text-7xl font-['Instrument_Serif'] font-black text-theme-primary">Brew Your Mood</h2>
                <p class="text-theme-text/80 max-w-xl mx-auto">Select how you want to feel, and we'll change the atmosphere and show you the perfect cup.</p>
                
                <div class="mt-10 flex flex-wrap justify-center gap-4">
                    <button @click="activeMoodId = null; $store.cart.setMoodTheme('default')" 
                            class="px-8 py-3 rounded-full border-2 text-xs font-bold uppercase tracking-widest transition-all shadow-[3px_3px_0px_currentColor]"
                            :class="activeMoodId === null ? 'bg-theme-primary text-theme-bg border-theme-primary' : 'border-theme-primary/30 text-theme-primary hover:border-theme-primary hover:-translate-y-1'">
                        All Coffees
                    </button>
                    <template x-for="mood in moods" :key="mood.id">
                        <button @click="activeMoodId = mood.id; $store.cart.setMoodTheme(mood.name)" 
                                class="px-8 py-3 rounded-full border-2 text-xs font-bold uppercase tracking-widest transition-all shadow-[3px_3px_0px_currentColor]"
                                :class="activeMoodId === mood.id ? 'bg-theme-primary text-theme-bg border-theme-primary' : 'border-theme-primary/30 text-theme-primary hover:border-theme-primary hover:-translate-y-1'"
                                x-text="mood.name">
                        </button>
                    </template>
                </div>
            </div>

            <!-- Coffee Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <template x-for="product in coffeeProducts" :key="product.id">
                    <div class="bg-[rgba(var(--theme-card-rgb),1)] rounded-3xl overflow-hidden shadow-[0px_10px_30px_rgba(0,0,0,0.06)] hover:shadow-[0px_25px_50px_rgba(0,0,0,0.15)] transition-all duration-500 ease-out group flex flex-col relative border-2 border-theme-primary/10 hover:border-theme-primary cursor-pointer hover:-translate-y-3"
                         @click="selectedProduct = product">
                        
                        <div class="aspect-square relative overflow-hidden bg-black/5 p-4">
                            <div class="w-full h-full rounded-2xl overflow-hidden border-2 border-theme-primary/20 relative">
                                <img :src="product.image" :alt="product.name" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            
                            <!-- Mood Badge -->
                            <div class="absolute top-8 left-8 bg-theme-bg/90 backdrop-blur text-theme-primary border border-theme-primary px-3 py-1 text-[10px] font-bold uppercase tracking-widest rounded-full shadow-sm">
                                <span x-text="moods.find(m => m.id === product.mood_id)?.name"></span>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-['Instrument_Serif'] font-bold text-2xl text-theme-primary leading-tight mb-2" x-text="product.name"></h3>
                            <p class="text-theme-accent font-black text-xl mb-3" x-text="'$' + product.price"></p>
                            <p class="text-theme-text/70 text-xs leading-relaxed line-clamp-3 mb-6 flex-grow font-medium" x-text="product.description"></p>
                            
                            <div class="mt-auto">
                                <button @click.stop="$store.cart.addToCart(product.id)" 
                                        class="w-full py-3 rounded-xl border-2 border-theme-primary text-theme-primary font-bold uppercase tracking-widest text-[10px] hover:bg-theme-primary hover:text-theme-bg transition-colors flex items-center justify-center gap-2">
                                    <span>Add to Cart</span>
                                    <span class="text-theme-accent">|</span>
                                    <span class="text-theme-accent" x-text="'+' + product.reward_points + ' 🌱'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            
            <div x-show="coffeeProducts.length === 0" class="text-center py-20">
                <p class="text-theme-text/50 font-bold uppercase tracking-widest">No coffees found for this mood.</p>
            </div>
        </div>
    </section>

    <!-- 3. BAKERY SECTION (Perfect Pairings) -->
    <section id="bakery" class="py-24 bg-theme-bg border-t-2 border-theme-primary/10 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="text-center mb-16 space-y-4">
                <div class="inline-block px-4 py-1.5 rounded-full border-2 border-theme-primary text-theme-primary text-[10px] font-extrabold uppercase tracking-widest shadow-[3px_3px_0px_currentColor]">
                    Desserts
                </div>
                <h2 class="text-5xl md:text-7xl font-['Instrument_Serif'] font-black text-theme-primary">Perfect Pairings</h2>
                <p class="text-theme-text/80 max-w-xl mx-auto">Enhance your coffee experience with our carefully crafted bakery items, designed to complement specific roast profiles.</p>
            </div>

            <!-- Bakery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <template x-for="product in bakeryProducts" :key="product.id">
                    <div class="bg-[rgba(var(--theme-card-rgb),1)] rounded-3xl overflow-hidden shadow-[0px_10px_30px_rgba(0,0,0,0.06)] hover:shadow-[0px_25px_50px_rgba(0,0,0,0.15)] transition-all duration-500 ease-out flex flex-col relative border-2 border-theme-primary/10 hover:-translate-y-3">
                        <div class="aspect-[4/3] relative overflow-hidden bg-black/5 p-4">
                            <div class="w-full h-full rounded-2xl overflow-hidden border-2 border-theme-primary/20">
                                <img :src="product.image" :alt="product.name" class="w-full h-full object-cover">
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow text-center">
                            <h3 class="font-['Instrument_Serif'] font-bold text-2xl text-theme-primary leading-tight mb-2" x-text="product.name"></h3>
                            <p class="text-theme-accent font-black text-xl mb-4" x-text="'$' + product.price"></p>
                            <p class="text-theme-text/80 text-sm leading-relaxed mb-6 font-medium italic" x-text="product.description"></p>
                            
                            <div class="mt-auto">
                                <button @click.prevent="$store.cart.addToCart(product.id)" 
                                        class="w-full py-3 rounded-xl bg-theme-primary border-2 border-theme-primary text-theme-bg font-bold uppercase tracking-widest text-[10px] hover:opacity-90 transition-opacity">
                                    Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- Modal for Product Details / Trace to Farm -->
    <div x-show="selectedProduct" class="fixed inset-0 z-[100] flex items-center justify-center px-4" style="display: none;">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md transition-opacity" x-show="selectedProduct" x-transition.opacity @click="selectedProduct = null"></div>
        
        <div class="relative bg-theme-bg rounded-3xl w-full max-w-4xl max-h-[90vh] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.5)] border-4 border-theme-primary flex flex-col md:flex-row" 
             x-show="selectedProduct" 
             x-transition:enter="transition ease-out duration-300 transform" 
             x-transition:enter-start="opacity-0 translate-y-8" 
             x-transition:enter-end="opacity-100 translate-y-0" 
             x-transition:leave="transition ease-in duration-200 transform" 
             x-transition:leave-start="opacity-100 translate-y-0" 
             x-transition:leave-end="opacity-0 translate-y-8">
            
            <button @click="selectedProduct = null" class="absolute top-4 right-4 z-10 w-10 h-10 bg-theme-bg border-2 border-theme-primary rounded-full flex items-center justify-center text-theme-primary hover:bg-theme-primary hover:text-theme-bg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Image Side -->
            <div class="w-full md:w-2/5 relative h-64 md:h-auto bg-theme-primary p-4">
                <div class="w-full h-full rounded-2xl overflow-hidden border-2 border-theme-bg/20 relative">
                    <img :src="selectedProduct?.image" class="absolute inset-0 w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Details Side -->
            <div class="w-full md:w-3/5 p-8 md:p-12 overflow-y-auto">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 border-2 border-theme-accent text-theme-accent text-[10px] font-bold uppercase tracking-widest rounded-full">
                        <span x-text="moods.find(m => m.id === selectedProduct?.mood_id)?.name || 'Pairing'"></span>
                    </span>
                </div>
                
                <h3 class="text-4xl font-['Instrument_Serif'] font-black text-theme-primary mb-2" x-text="selectedProduct?.name"></h3>
                <p class="text-2xl text-theme-accent font-bold mb-6" x-text="'$' + selectedProduct?.price"></p>
                
                <p class="text-theme-text/80 mb-8 font-medium leading-relaxed" x-text="selectedProduct?.description"></p>
                
                <!-- Trace to Farm Timeline (Only if data exists) -->
                <div x-show="selectedProduct?.farmer_name" class="mt-8 pt-8 border-t-2 border-theme-primary/10">
                    <h4 class="text-xs font-black uppercase tracking-widest text-theme-primary mb-6 flex items-center gap-2">
                        <span>🌱</span> Trace to Farm Journey
                    </h4>
                    
                    <div class="relative pl-6 border-l-2 border-theme-accent/50 space-y-8">
                        <div class="relative">
                            <div class="absolute -left-[1.95rem] top-1 w-4 h-4 rounded-full bg-theme-bg border-4 border-theme-accent"></div>
                            <h5 class="font-bold text-theme-primary">The Farmer</h5>
                            <p class="text-theme-text/70 text-sm mt-1" x-text="selectedProduct?.farmer_name"></p>
                        </div>
                        <div class="relative">
                            <div class="absolute -left-[1.95rem] top-1 w-4 h-4 rounded-full bg-theme-bg border-4 border-theme-accent"></div>
                            <h5 class="font-bold text-theme-primary">Origin & Altitude</h5>
                            <p class="text-theme-text/70 text-sm mt-1">
                                <span x-text="selectedProduct?.country_origin"></span> 
                                <span class="text-theme-accent mx-1">•</span> 
                                <span x-text="selectedProduct?.altitude"></span>
                            </p>
                        </div>
                        <div class="relative">
                            <div class="absolute -left-[1.95rem] top-1 w-4 h-4 rounded-full bg-theme-accent ring-4 ring-theme-bg border-2 border-theme-bg"></div>
                            <h5 class="font-bold text-theme-primary">The Process</h5>
                            <p class="text-theme-text/70 text-sm mt-1 leading-relaxed" x-text="selectedProduct?.farm_story"></p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 p-4 bg-theme-primary/5 rounded-2xl flex items-center justify-between border-2 border-theme-primary/20">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">🌱</span>
                        <div>
                            <p class="font-bold text-[10px] text-theme-primary uppercase tracking-widest">Bean Reward</p>
                            <p class="text-xs text-theme-text/60">Earn beans with this purchase</p>
                        </div>
                    </div>
                    <span class="text-xl font-black text-theme-accent" x-text="'+' + selectedProduct?.reward_points"></span>
                </div>

                <button @click="$store.cart.addToCart(selectedProduct.id); selectedProduct = null;" 
                        class="w-full mt-6 bg-theme-primary text-theme-bg py-4 rounded-xl font-bold uppercase tracking-widest hover:scale-[1.02] transition-all shadow-[4px_4px_0px_currentColor] border-2 border-theme-primary text-theme-primary">
                    <span class="text-theme-bg">Add to Cart - <span x-text="'$' + selectedProduct?.price"></span></span>
                </button>
            </div>
        </div>
    </div>

</div>

<!-- 3D CSS Utilities for the Home Cup -->
<style>
    .perspective-1000 { perspective: 1000px; }
    .preserve-3d { transform-style: preserve-3d; }
    .translate-z-12 { transform: translateZ(48px); }
</style>
@endsection
