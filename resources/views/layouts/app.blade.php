<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COFFEE | The Richest Coffee in the City</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased font-['Plus_Jakarta_Sans'] relative transition-colors duration-500"
      x-data="{ scrolled: false }"
      :class="$store.cart.themeClass"
      @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- 3D Parallax Background Effects (Now sits OVER the background color, but UNDER content) -->
    <div class="fixed inset-0 pointer-events-none z-[0] overflow-hidden transition-opacity duration-500">
        <!-- Floating Coffee Beans Background Layer -->
        <img src="/images/coffee_bean_3d.png" class="absolute top-10 left-10 w-32 opacity-70 blur-[2px] bean-float-1" alt="">
        <img src="/images/coffee_bean_3d.png" class="absolute bottom-20 right-20 w-40 opacity-80 blur-[4px] bean-float-2" alt="">
        <img src="/images/coffee_bean_3d.png" class="absolute top-1/2 left-1/3 w-24 opacity-60 blur-[1px] bean-float-3" alt="">
        <img src="/images/coffee_bean_3d.png" class="absolute bottom-1/3 left-10 w-28 opacity-90 blur-[3px] bean-float-1" alt="">
    </div>

    <!-- Responsive Navigation Bar (Portfolio Style) -->
    <header class="fixed top-0 left-0 right-0 z-50 py-3 sm:py-4 px-3 sm:px-6 bg-theme-bg/80 backdrop-blur-md border-b border-theme-primary/10 transition-all duration-300" 
            :class="{'shadow-sm': scrolled}">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-3 md:gap-4">
            
            <!-- Top Bar Row for Mobile: Logo & Cart -->
            <div class="w-full md:w-auto flex items-center justify-between">
                <!-- Brand Logo Pill -->
                <a href="#intro" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-theme-primary text-theme-bg font-['Instrument_Serif'] text-xl sm:text-2xl font-bold flex items-center justify-center border-2 border-theme-primary shadow-[2px_2px_0px_#3B2A1A] sm:shadow-[3px_3px_0px_#3B2A1A] group-hover:scale-105 transition-all">
                        C
                    </div>
                    <span class="font-['Instrument_Serif'] text-2xl sm:text-3xl font-bold text-theme-primary tracking-tight group-hover:text-theme-accent transition-colors">
                        MoodBrew
                    </span>
                </a>

                <!-- Mobile Cart Button -->
                <div class="flex md:hidden items-center gap-3">
                    <button @click="$store.cart.cartOpen = true" class="relative group w-10 h-10 rounded-full bg-theme-bg border-2 border-theme-primary text-theme-primary flex items-center justify-center shadow-[2px_2px_0px_currentColor] hover:bg-theme-primary hover:text-theme-bg transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span x-show="$store.cart.cartItems.length > 0" x-text="$store.cart.cartItems.length" class="absolute -top-2 -right-2 bg-theme-accent text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center border border-theme-bg"></span>
                    </button>
                </div>
            </div>

            <!-- Center Horizontal Scrollable Nav Pill for All Devices -->
            <nav class="bg-theme-bg border-2 border-theme-primary shadow-[3px_3px_0px_currentColor] rounded-full px-3 py-1.5 sm:px-6 sm:py-2 max-w-full overflow-x-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] flex items-center gap-3 sm:gap-6 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-theme-primary whitespace-nowrap">
                <a href="#intro" class="hover:text-theme-accent transition-colors py-0.5">Home</a>
                <a href="#coffee" class="hover:text-theme-accent transition-colors py-0.5 cursor-pointer">Coffee</a>
                <a href="#bakery" class="hover:text-theme-accent transition-colors py-0.5 cursor-pointer">Bakery</a>
            </nav>

            <!-- Right Actions Desktop -->
            <div class="hidden md:flex items-center gap-4 text-theme-primary">
                <div class="flex items-center gap-2 bg-theme-bg px-4 py-2 rounded-full border-2 border-theme-primary shadow-[3px_3px_0px_currentColor]">
                    <span class="text-lg">🌱</span>
                    <span class="font-bold text-xs uppercase tracking-widest text-theme-primary">
                        <span>{{ auth()->check() ? auth()->user()->bean_balance : \App\Models\User::first()->bean_balance ?? 0 }} Beans</span>
                    </span>
                </div>
                
                <button @click="$store.cart.cartOpen = true" class="relative group w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-theme-bg border-2 border-theme-primary text-theme-primary flex items-center justify-center shadow-[3px_3px_0px_currentColor] hover:bg-theme-primary hover:text-theme-bg hover:scale-105 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span x-show="$store.cart.cartItems.length > 0" x-text="$store.cart.cartItems.length" class="absolute -top-2 -right-2 bg-theme-accent text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center border border-theme-bg"></span>
                </button>
            </div>

        </div>
    </header>

    <!-- Main Content Wrapper -->
    <div class="relative w-full overflow-hidden bg-theme-bg">
        @yield('content')
    </div>

    <!-- Sliding Cart Drawer -->
    <div class="relative z-[100]" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" x-show="$store.cart.cartOpen" style="display: none;">
        <div class="fixed inset-0 bg-black/30 backdrop-blur-sm transition-opacity" x-show="$store.cart.cartOpen" x-transition.opacity @click="$store.cart.cartOpen = false"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10" x-show="$store.cart.cartOpen" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                    
                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col bg-white shadow-xl border-l border-gray-100">
                            
                            <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-2xl font-bold text-theme-primary font-['Instrument_Serif']" id="slide-over-title">Your Order</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500" @click="$store.cart.cartOpen = false">
                                            <span class="absolute -inset-0.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <div class="flow-root">
                                        <ul role="list" class="-my-6 divide-y divide-gray-100" x-show="!$store.cart.checkoutMode">
                                            <template x-for="item in $store.cart.cartItems" :key="item.id">
                                                <li class="flex py-6">
                                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-xl border border-theme-primary/20 bg-black/5 p-1">
                                                        <img :src="item.image" class="h-full w-full object-cover object-center rounded-lg">
                                                    </div>
                                                    
                                                    <div class="ml-4 flex flex-1 flex-col justify-center">
                                                        <div>
                                                            <div class="flex justify-between text-base font-bold text-theme-primary font-['Instrument_Serif'] text-xl">
                                                                <h3 x-text="item.name"></h3>
                                                                <p class="ml-4 text-theme-accent" x-text="'$' + (item.price * item.quantity).toFixed(2)"></p>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-1 items-end justify-between text-sm mt-2">
                                                            <!-- Real-Time Quantity Adjuster -->
                                                            <div class="flex items-center border border-theme-primary rounded-full overflow-hidden">
                                                                <button @click="$store.cart.updateQuantity(item.id, item.quantity - 1)" class="px-3 py-1 bg-theme-primary/5 hover:bg-theme-primary/20 text-theme-primary font-bold transition-colors">-</button>
                                                                <span class="px-3 font-bold text-theme-primary" x-text="item.quantity"></span>
                                                                <button @click="$store.cart.updateQuantity(item.id, item.quantity + 1)" class="px-3 py-1 bg-theme-primary/5 hover:bg-theme-primary/20 text-theme-primary font-bold transition-colors">+</button>
                                                            </div>
                                                            <div class="flex">
                                                                <button type="button" @click="$store.cart.removeFromCart(item.id)" class="font-bold text-red-500 hover:text-red-700 uppercase tracking-widest text-xs transition-colors">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </template>
                                            
                                            <li x-show="$store.cart.cartItems.length === 0" class="py-12 text-center text-gray-500">
                                                Your cart is empty.
                                            </li>
                                        </ul>

                                        <!-- Checkout Details Form -->
                                        <div x-show="$store.cart.checkoutMode && !$store.cart.checkoutSuccess" class="space-y-6" x-transition.opacity>
                                            <div class="flex items-center gap-2 mb-4 bg-theme-accent/10 border-2 border-theme-accent text-theme-accent px-4 py-3 rounded-xl font-bold">
                                                <span>💵</span>
                                                <span class="text-sm uppercase tracking-widest">Payment: Cash on Delivery</span>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-bold text-theme-primary mb-1 uppercase tracking-widest text-[10px]">Full Name</label>
                                                <input type="text" x-model="$store.cart.customer.name" placeholder="John Doe" class="w-full bg-white border-2 border-theme-primary/20 focus:border-theme-primary rounded-xl px-4 py-3 text-theme-text outline-none transition-colors shadow-sm">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-bold text-theme-primary mb-1 uppercase tracking-widest text-[10px]">Phone Number</label>
                                                <input type="tel" x-model="$store.cart.customer.phone" placeholder="+1 (555) 000-0000" class="w-full bg-white border-2 border-theme-primary/20 focus:border-theme-primary rounded-xl px-4 py-3 text-theme-text outline-none transition-colors shadow-sm">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-bold text-theme-primary mb-1 uppercase tracking-widest text-[10px]">Delivery Address</label>
                                                <textarea x-model="$store.cart.customer.address" rows="3" placeholder="123 Coffee St, Apt 4B" class="w-full bg-white border-2 border-theme-primary/20 focus:border-theme-primary rounded-xl px-4 py-3 text-theme-text outline-none transition-colors shadow-sm resize-none"></textarea>
                                            </div>
                                            
                                            <div class="flex items-center justify-between text-sm pt-4 border-t-2 border-gray-100">
                                                <button @click="$store.cart.checkoutMode = false" class="text-gray-500 font-bold hover:text-theme-primary transition-colors">
                                                    &larr; Back to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 px-4 py-6 sm:px-6 bg-gray-50">
                                <div class="flex justify-between text-lg font-bold text-theme-text font-['Instrument_Serif']">
                                    <p>Subtotal</p>
                                    <p x-text="'$' + $store.cart.cartTotal.toFixed(2)"></p>
                                </div>
                                <div class="flex justify-between text-sm font-semibold text-theme-accent mt-2">
                                    <p>Total Beans Earned</p>
                                    <p x-text="'+' + $store.cart.cartPoints + ' 🌱'"></p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                                <div class="mt-6">
                                    <template x-if="!$store.cart.checkoutMode">
                                        <button @click="$store.cart.checkoutMode = true" :disabled="$store.cart.cartItems.length === 0" 
                                                class="flex items-center justify-center w-full rounded-full border-2 border-theme-primary px-6 py-4 text-sm font-bold shadow-[4px_4px_0px_currentColor] hover:-translate-y-1 hover:shadow-[6px_6px_0px_currentColor] disabled:opacity-50 transition-all uppercase tracking-widest bg-theme-primary text-theme-bg">
                                            <span>Proceed to Checkout</span>
                                        </button>
                                    </template>
                                    
                                    <template x-if="$store.cart.checkoutMode">
                                        <button @click="$store.cart.submitOrder()" :disabled="$store.cart.processingCheckout || $store.cart.checkoutSuccess || !$store.cart.customer.name || !$store.cart.customer.phone || !$store.cart.customer.address" 
                                                class="flex items-center justify-center w-full rounded-full border-2 border-theme-primary px-6 py-4 text-sm font-bold shadow-[4px_4px_0px_currentColor] hover:-translate-y-1 hover:shadow-[6px_6px_0px_currentColor] disabled:opacity-50 transition-all uppercase tracking-widest"
                                                :class="$store.cart.checkoutSuccess ? 'bg-green-500 text-white border-green-600 shadow-[4px_4px_0px_#166534]' : 'bg-theme-accent text-white border-theme-accent'">
                                            <span x-show="!$store.cart.processingCheckout && !$store.cart.checkoutSuccess">Confirm COD Order</span>
                                            <span x-show="$store.cart.processingCheckout && !$store.cart.checkoutSuccess">Processing...</span>
                                            <span x-show="$store.cart.checkoutSuccess" class="flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                Order Complete!
                                            </span>
                                        </button>
                                    </template>
                                </div>
                                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                    <p>
                                        or
                                        <button type="button" class="font-bold text-theme-primary hover:text-theme-primary/80" @click="$store.cart.cartOpen = false">
                                            Continue Shopping
                                            <span aria-hidden="true"> &rarr;</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Script for Cart State -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                cartOpen: false,
                checkoutMode: false,
                cartItems: [],
                cartTotal: 0,
                cartPoints: 0,
                processingCheckout: false,
                checkoutSuccess: false,
                themeClass: '', // Default theme
                customer: {
                    name: '',
                    phone: '',
                    address: ''
                },

                async initCart() {
                    this.fetchCart();
                },

                async fetchCart() {
                    let response = await fetch('{{ route('cart.data') }}');
                    let data = await response.json();
                    
                    this.cartItems = Object.values(data);
                    this.calculateTotals();
                },

                setMoodTheme(moodName) {
                    if (moodName === 'Focus') {
                        this.themeClass = 'theme-focus';
                    } else if (moodName === 'Relaxing') {
                        this.themeClass = ''; // Back to default warm
                    } else if (moodName === 'Energy') {
                        this.themeClass = 'theme-energy';
                    } else {
                        this.themeClass = '';
                    }
                },

                async addToCart(productId) {
                    let response = await fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ product_id: productId })
                    });
                    
                    if (response.ok) {
                        this.fetchCart();
                        this.cartOpen = true;
                    }
                },

                async updateQuantity(rowId, newQuantity) {
                    if (newQuantity < 1) {
                        return this.removeFromCart(rowId);
                    }
                    
                    let response = await fetch('{{ url('/cart/update') }}/' + rowId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ quantity: newQuantity })
                    });
                    
                    if (response.ok) {
                        this.fetchCart();
                    }
                },

                async removeFromCart(rowId) {
                    let response = await fetch('{{ url('/cart/remove') }}/' + rowId, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    
                    if (response.ok) {
                        this.fetchCart();
                    }
                },

                calculateTotals() {
                    this.cartTotal = this.cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
                    this.cartPoints = this.cartItems.reduce((total, item) => total + (item.reward_points * item.quantity), 0);
                },

                async submitOrder() {
                    if (!this.customer.name || !this.customer.phone || !this.customer.address) {
                        alert('Please fill out all delivery details.');
                        return;
                    }
                    
                    this.processingCheckout = true;
                    this.checkoutSuccess = false;
                    
                    try {
                        let response = await fetch('{{ route('checkout.process') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                name: this.customer.name,
                                phone: this.customer.phone,
                                address: this.customer.address
                            })
                        });

                        let data = await response.json();

                        if (response.ok && data.success) {
                            this.checkoutSuccess = true;
                            this.fetchCart();
                            
                            // Reload page after a delay to show success state and update bean balance
                            setTimeout(() => {
                                window.location.reload();
                            }, 3000);
                        } else {
                            alert('Error: ' + (data.message || 'Validation failed.'));
                            this.processingCheckout = false;
                        }
                    } catch (e) {
                        alert('Something went wrong during checkout.');
                        this.processingCheckout = false;
                    }
                }
            });
            
            // Initialize on load
            Alpine.store('cart').initCart();
        });
    </script>
</body>
</html>
