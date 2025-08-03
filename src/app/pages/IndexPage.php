<?php



namespace App\app\pages;

use App\app\layouts\Layout;
use Framework\Http\Context;
use Framework\Http\Enums\HttpContentTypes;
use Framework\Http\PageAbstractClass;
use Framework\Http\Response;

class IndexPage extends PageAbstractClass
{
    public function get(): Response
    {
        $this->arguments['script'] = 'index.js';
        $html = $this->renderPageHtmlWithLayout(new Layout());
        $respone = new Response(200, [], HttpContentTypes::TextHtml,  $html);
        return $respone;
    }

    public function post(): Response
    {
        $html = $this->renderPageHtmlWithLayout(new Layout());
        $respone = new Response(200, [], HttpContentTypes::TextHtml, $html);
        return $respone;
    }

    public function pageHtml()
    {
?>

        <!-- Header -->
        <header id="header" class="sticky top-0 z-50 w-full backdrop-blur-lg transition-all duration-300">
            <div class="container mx-auto flex h-16 items-center justify-between px-4">
                <div class="flex items-center gap-2 font-bold">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-blue-400 flex items-center justify-center text-white">
                        S
                    </div>
                    <span>SaaSify</span>
                </div>
                <nav class="hidden md:flex gap-8">
                    <a href="#features" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Features</a>
                    <a href="#testimonials" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Testimonials</a>
                    <a href="#pricing" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Pricing</a>
                    <a href="#faq" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">FAQ</a>
                </nav>
                <div class="hidden md:flex gap-4 items-center">
                    <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg id="sun-icon" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg id="moon-icon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Log in</a>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full text-sm font-medium transition-colors flex items-center gap-1">
                        Get Started
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center gap-4 md:hidden">
                    <button id="theme-toggle-mobile" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg id="sun-icon-mobile" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg id="moon-icon-mobile" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>
                    <button id="mobile-menu-toggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg id="menu-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="close-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden absolute top-16 inset-x-0 bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg border-b hidden">
                <div class="container mx-auto py-4 px-4 flex flex-col gap-4">
                    <a href="#features" class="py-2 text-sm font-medium mobile-menu-link">Features</a>
                    <a href="#testimonials" class="py-2 text-sm font-medium mobile-menu-link">Testimonials</a>
                    <a href="#pricing" class="py-2 text-sm font-medium mobile-menu-link">Pricing</a>
                    <a href="#faq" class="py-2 text-sm font-medium mobile-menu-link">FAQ</a>
                    <div class="flex flex-col gap-2 pt-2 border-t">
                        <a href="#" class="py-2 text-sm font-medium mobile-menu-link">Log in</a>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full text-sm font-medium transition-colors flex items-center gap-1 justify-center">
                            Get Started
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <!-- Hero Section -->
            <section class="w-full py-20 md:py-32 lg:py-40 overflow-hidden">
                <div class="container mx-auto px-4 md:px-6 relative">
                    <div class="absolute inset-0 -z-10 h-full w-full bg-white dark:bg-black bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#1f1f1f_1px,transparent_1px),linear-gradient(to_bottom,#1f1f1f_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_110%)]"></div>

                    <div class="text-center max-w-3xl mx-auto mb-12 animate-fade-in">
                        <span class="inline-block mb-4 rounded-full px-4 py-1.5 text-sm font-medium bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                            Launching Soon
                        </span>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-6 bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300">
                            Elevate Your Workflow with SaaSify
                        </h1>
                        <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                            The all-in-one platform that helps teams collaborate, automate, and deliver exceptional results.
                            Streamline your processes and focus on what matters most.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-full text-base font-medium transition-colors flex items-center justify-center gap-2">
                                Start Free Trial
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                            <button class="border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 px-8 py-3 rounded-full text-base font-medium transition-colors">
                                Book a Demo
                            </button>
                        </div>
                        <div class="flex items-center justify-center gap-4 mt-6 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>No credit card</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>14-day trial</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Cancel anytime</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative mx-auto max-w-5xl animate-slide-up">
                        <div class="rounded-xl overflow-hidden shadow-2xl border border-gray-200 dark:border-gray-700 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800">
                            <img
                                src="https://cdn.dribbble.com/userupload/12302729/file/original-fa372845e394ee85bebe0389b9d86871.png?resize=1504x1128&vertical=center"
                                alt="SaaSify dashboard"
                                class="w-full h-auto" />
                            <div class="absolute inset-0 rounded-xl ring-1 ring-inset ring-black/10 dark:ring-white/10"></div>
                        </div>
                        <div class="absolute -bottom-6 -right-6 -z-10 h-[300px] w-[300px] rounded-full bg-gradient-to-br from-blue-500/30 to-purple-500/30 blur-3xl opacity-70"></div>
                        <div class="absolute -top-6 -left-6 -z-10 h-[300px] w-[300px] rounded-full bg-gradient-to-br from-purple-500/30 to-blue-500/30 blur-3xl opacity-70"></div>
                    </div>
                </div>
            </section>

            <!-- Logos Section -->
            <section class="w-full py-12 border-y bg-gray-50 dark:bg-gray-900/30">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="flex flex-col items-center justify-center space-y-4 text-center">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Trusted by innovative companies worldwide</p>
                        <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12 lg:gap-16">
                            <img src="/placeholder.svg?height=60&width=120&text=Company1" alt="Company logo 1" class="h-8 w-auto opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all" />
                            <img src="/placeholder.svg?height=60&width=120&text=Company2" alt="Company logo 2" class="h-8 w-auto opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all" />
                            <img src="/placeholder.svg?height=60&width=120&text=Company3" alt="Company logo 3" class="h-8 w-auto opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all" />
                            <img src="/placeholder.svg?height=60&width=120&text=Company4" alt="Company logo 4" class="h-8 w-auto opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all" />
                            <img src="/placeholder.svg?height=60&width=120&text=Company5" alt="Company logo 5" class="h-8 w-auto opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all" />
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="features" class="w-full py-20 md:py-32">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="flex flex-col items-center justify-center space-y-4 text-center mb-12 fade-in-on-scroll">
                        <span class="inline-block rounded-full px-4 py-1.5 text-sm font-medium bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                            Features
                        </span>
                        <h2 class="text-3xl md:text-4xl font-bold tracking-tight">Everything You Need to Succeed</h2>
                        <p class="max-w-[800px] text-gray-600 dark:text-gray-300 md:text-lg">
                            Our comprehensive platform provides all the tools you need to streamline your workflow, boost
                            productivity, and achieve your goals.
                        </p>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="h-full overflow-hidden border border-gray-200 dark:border-gray-700 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur transition-all hover:shadow-md rounded-lg fade-in-on-scroll">
                            <div class="p-6 flex flex-col h-full">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-500 mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Smart Automation</h3>
                                <p class="text-gray-600 dark:text-gray-300">Automate repetitive tasks and workflows to save time and reduce errors.</p>
                            </div>
                        </div>

                        <div class="h-full overflow-hidden border border-gray-200 dark:border-gray-700 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur transition-all hover:shadow-md rounded-lg fade-in-on-scroll">
                            <div class="p-6 flex flex-col h-full">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-500 mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Advanced Analytics</h3>
                                <p class="text-gray-600 dark:text-gray-300">Gain valuable insights with real-time data visualization and reporting.</p>
                            </div>
                        </div>

                        <div class="h-full overflow-hidden border border-gray-200 dark:border-gray-700 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur transition-all hover:shadow-md rounded-lg fade-in-on-scroll">
                            <div class="p-6 flex flex-col h-full">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-500 mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Team Collaboration</h3>
                                <p class="text-gray-600 dark:text-gray-300">Work together seamlessly with integrated communication tools.</p>
                            </div>
                        </div>

                        <div class="h-full overflow-hidden border border-gray-200 dark:border-gray-700 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur transition-all hover:shadow-md rounded-lg fade-in-on-scroll">
                            <div class="p-6 flex flex-col h-full">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-500 mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Enterprise Security</h3>
                                <p class="text-gray-600 dark:text-gray-300">Keep your data safe with end-to-end encryption and compliance features.</p>
                            </div>
                        </div>

                        <div class="h-full overflow-hidden border border-gray-200 dark:border-gray-700 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur transition-all hover:shadow-md rounded-lg fade-in-on-scroll">
                            <div class="p-6 flex flex-col h-full">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-500 mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Seamless Integration</h3>
                                <p class="text-gray-600 dark:text-gray-300">Connect with your favorite tools through our extensive API ecosystem.</p>
                            </div>
                        </div>

                        <div class="h-full overflow-hidden border border-gray-200 dark:border-gray-700 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur transition-all hover:shadow-md rounded-lg fade-in-on-scroll">
                            <div class="p-6 flex flex-col h-full">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-500 mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-2">24/7 Support</h3>
                                <p class="text-gray-600 dark:text-gray-300">Get help whenever you need it with our dedicated support team.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Pricing Section -->
            <section id="pricing" class="w-full py-20 md:py-32 bg-gray-50 dark:bg-gray-900/30 relative overflow-hidden">
                <div class="absolute inset-0 -z-10 h-full w-full bg-white dark:bg-black bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#1f1f1f_1px,transparent_1px),linear-gradient(to_bottom,#1f1f1f_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_50%,#000_40%,transparent_100%)]"></div>

                <div class="container mx-auto px-4 md:px-6 relative">
                    <div class="flex flex-col items-center justify-center space-y-4 text-center mb-12 fade-in-on-scroll">
                        <span class="inline-block rounded-full px-4 py-1.5 text-sm font-medium bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                            Pricing
                        </span>
                        <h2 class="text-3xl md:text-4xl font-bold tracking-tight">Simple, Transparent Pricing</h2>
                        <p class="max-w-[800px] text-gray-600 dark:text-gray-300 md:text-lg">
                            Choose the plan that's right for your business. All plans include a 14-day free trial.
                        </p>
                    </div>

                    <div class="mx-auto max-w-5xl">
                        <div class="flex justify-center mb-8">
                            <div class="bg-gray-100 dark:bg-gray-800 rounded-full p-1">
                                <button id="monthly-tab" class="pricing-tab active rounded-full px-6 py-2 text-sm font-medium transition-colors">
                                    Monthly
                                </button>
                                <button id="annually-tab" class="pricing-tab rounded-full px-6 py-2 text-sm font-medium transition-colors">
                                    Annually (Save 20%)
                                </button>
                            </div>
                        </div>

                        <div id="monthly-pricing" class="pricing-content grid gap-6 lg:grid-cols-3 lg:gap-8">
                            <!-- Starter Plan -->
                            <div class="relative overflow-hidden h-full border border-gray-200 dark:border-gray-700 shadow-md bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur rounded-lg fade-in-on-scroll">
                                <div class="p-6 flex flex-col h-full">
                                    <h3 class="text-2xl font-bold">Starter</h3>
                                    <div class="flex items-baseline mt-4">
                                        <span class="text-4xl font-bold">$29</span>
                                        <span class="text-gray-600 dark:text-gray-400 ml-1">/month</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2">Perfect for small teams and startups.</p>
                                    <ul class="space-y-3 my-6 flex-grow">
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Up to 5 team members</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Basic analytics</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>5GB storage</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Email support</span>
                                        </li>
                                    </ul>
                                    <button class="w-full mt-auto rounded-full border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 py-2 px-4 transition-colors">
                                        Start Free Trial
                                    </button>
                                </div>
                            </div>

                            <!-- Professional Plan -->
                            <div class="relative overflow-hidden h-full border border-blue-500 shadow-lg bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur rounded-lg fade-in-on-scroll">
                                <div class="absolute top-0 right-0 bg-blue-500 text-white px-3 py-1 text-xs font-medium rounded-bl-lg">
                                    Most Popular
                                </div>
                                <div class="p-6 flex flex-col h-full">
                                    <h3 class="text-2xl font-bold">Professional</h3>
                                    <div class="flex items-baseline mt-4">
                                        <span class="text-4xl font-bold">$79</span>
                                        <span class="text-gray-600 dark:text-gray-400 ml-1">/month</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2">Ideal for growing businesses.</p>
                                    <ul class="space-y-3 my-6 flex-grow">
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Up to 20 team members</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Advanced analytics</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>25GB storage</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Priority email support</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>API access</span>
                                        </li>
                                    </ul>
                                    <button class="w-full mt-auto rounded-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 transition-colors">
                                        Start Free Trial
                                    </button>
                                </div>
                            </div>

                            <!-- Enterprise Plan -->
                            <div class="relative overflow-hidden h-full border border-gray-200 dark:border-gray-700 shadow-md bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur rounded-lg fade-in-on-scroll">
                                <div class="p-6 flex flex-col h-full">
                                    <h3 class="text-2xl font-bold">Enterprise</h3>
                                    <div class="flex items-baseline mt-4">
                                        <span class="text-4xl font-bold">$199</span>
                                        <span class="text-gray-600 dark:text-gray-400 ml-1">/month</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2">For large organizations with complex needs.</p>
                                    <ul class="space-y-3 my-6 flex-grow">
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Unlimited team members</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Custom analytics</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Unlimited storage</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>24/7 phone & email support</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Advanced API access</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Custom integrations</span>
                                        </li>
                                    </ul>
                                    <button class="w-full mt-auto rounded-full border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 py-2 px-4 transition-colors">
                                        Contact Sales
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="annually-pricing" class="pricing-content hidden grid gap-6 lg:grid-cols-3 lg:gap-8">
                            <!-- Annual Starter Plan -->
                            <div class="relative overflow-hidden h-full border border-gray-200 dark:border-gray-700 shadow-md bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur rounded-lg fade-in-on-scroll">
                                <div class="p-6 flex flex-col h-full">
                                    <h3 class="text-2xl font-bold">Starter</h3>
                                    <div class="flex items-baseline mt-4">
                                        <span class="text-4xl font-bold">$23</span>
                                        <span class="text-gray-600 dark:text-gray-400 ml-1">/month</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2">Perfect for small teams and startups.</p>
                                    <ul class="space-y-3 my-6 flex-grow">
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Up to 5 team members</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Basic analytics</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>5GB storage</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Email support</span>
                                        </li>
                                    </ul>
                                    <button class="w-full mt-auto rounded-full border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 py-2 px-4 transition-colors">
                                        Start Free Trial
                                    </button>
                                </div>
                            </div>

                            <!-- Annual Professional Plan -->
                            <div class="relative overflow-hidden h-full border border-blue-500 shadow-lg bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur rounded-lg fade-in-on-scroll">
                                <div class="absolute top-0 right-0 bg-blue-500 text-white px-3 py-1 text-xs font-medium rounded-bl-lg">
                                    Most Popular
                                </div>
                                <div class="p-6 flex flex-col h-full">
                                    <h3 class="text-2xl font-bold">Professional</h3>
                                    <div class="flex items-baseline mt-4">
                                        <span class="text-4xl font-bold">$63</span>
                                        <span class="text-gray-600 dark:text-gray-400 ml-1">/month</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2">Ideal for growing businesses.</p>
                                    <ul class="space-y-3 my-6 flex-grow">
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Up to 20 team members</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Advanced analytics</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>25GB storage</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Priority email support</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>API access</span>
                                        </li>
                                    </ul>
                                    <button class="w-full mt-auto rounded-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 transition-colors">
                                        Start Free Trial
                                    </button>
                                </div>
                            </div>

                            <!-- Annual Enterprise Plan -->
                            <div class="relative overflow-hidden h-full border border-gray-200 dark:border-gray-700 shadow-md bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 backdrop-blur rounded-lg fade-in-on-scroll">
                                <div class="p-6 flex flex-col h-full">
                                    <h3 class="text-2xl font-bold">Enterprise</h3>
                                    <div class="flex items-baseline mt-4">
                                        <span class="text-4xl font-bold">$159</span>
                                        <span class="text-gray-600 dark:text-gray-400 ml-1">/month</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2">For large organizations with complex needs.</p>
                                    <ul class="space-y-3 my-6 flex-grow">
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Unlimited team members</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Custom analytics</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Unlimited storage</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>24/7 phone & email support</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Advanced API access</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="mr-2 w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Custom integrations</span>
                                        </li>
                                    </ul>
                                    <button class="w-full mt-auto rounded-full border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 py-2 px-4 transition-colors">
                                        Contact Sales
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FAQ Section -->
            <section id="faq" class="w-full py-20 md:py-32">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="flex flex-col items-center justify-center space-y-4 text-center mb-12 fade-in-on-scroll">
                        <span class="inline-block rounded-full px-4 py-1.5 text-sm font-medium bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                            FAQ
                        </span>
                        <h2 class="text-3xl md:text-4xl font-bold tracking-tight">Frequently Asked Questions</h2>
                        <p class="max-w-[800px] text-gray-600 dark:text-gray-300 md:text-lg">
                            Find answers to common questions about our platform.
                        </p>
                    </div>

                    <div class="mx-auto max-w-3xl">
                        <div class="space-y-4">
                            <div class="border-b border-gray-200 dark:border-gray-700 py-4">
                                <button class="faq-trigger w-full text-left font-medium hover:text-blue-500 transition-colors flex items-center justify-between">
                                    How does the 14-day free trial work?
                                    <svg class="faq-icon w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden mt-4 text-gray-600 dark:text-gray-300">
                                    Our 14-day free trial gives you full access to all features of your selected plan. No credit card is required to sign up, and you can cancel at any time during the trial period with no obligation.
                                </div>
                            </div>

                            <div class="border-b border-gray-200 dark:border-gray-700 py-4">
                                <button class="faq-trigger w-full text-left font-medium hover:text-blue-500 transition-colors flex items-center justify-between">
                                    Can I change plans later?
                                    <svg class="faq-icon w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden mt-4 text-gray-600 dark:text-gray-300">
                                    Yes, you can upgrade or downgrade your plan at any time. If you upgrade, the new pricing will be prorated for the remainder of your billing cycle. If you downgrade, the new pricing will take effect at the start of your next billing cycle.
                                </div>
                            </div>

                            <div class="border-b border-gray-200 dark:border-gray-700 py-4">
                                <button class="faq-trigger w-full text-left font-medium hover:text-blue-500 transition-colors flex items-center justify-between">
                                    Is there a limit to how many users I can add?
                                    <svg class="faq-icon w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden mt-4 text-gray-600 dark:text-gray-300">
                                    The number of users depends on your plan. The Starter plan allows up to 5 team members, the Professional plan allows up to 20, and the Enterprise plan has no limit on team members.
                                </div>
                            </div>

                            <div class="border-b border-gray-200 dark:border-gray-700 py-4">
                                <button class="faq-trigger w-full text-left font-medium hover:text-blue-500 transition-colors flex items-center justify-between">
                                    How secure is my data?
                                    <svg class="faq-icon w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden mt-4 text-gray-600 dark:text-gray-300">
                                    We take security very seriously. All data is encrypted both in transit and at rest. We use industry-standard security practices and regularly undergo security audits. Our platform is compliant with GDPR, CCPA, and other relevant regulations.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="w-full py-20 md:py-32 bg-gradient-to-br from-blue-500 to-blue-600 text-white relative overflow-hidden">
                <div class="absolute inset-0 -z-10 bg-[linear-gradient(to_right,#ffffff10_1px,transparent_1px),linear-gradient(to_bottom,#ffffff10_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>

                <div class="container mx-auto px-4 md:px-6 relative">
                    <div class="flex flex-col items-center justify-center space-y-6 text-center fade-in-on-scroll">
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight">
                            Ready to Transform Your Workflow?
                        </h2>
                        <p class="mx-auto max-w-[700px] text-blue-100 md:text-xl">
                            Join thousands of satisfied customers who have streamlined their processes and boosted productivity with
                            our platform.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 mt-4">
                            <button class="bg-white text-blue-500 hover:bg-gray-100 px-8 py-3 rounded-full text-base font-medium transition-colors flex items-center justify-center gap-2">
                                Start Free Trial
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                            <button class="border border-white text-white hover:bg-white/10 px-8 py-3 rounded-full text-base font-medium transition-colors">
                                Schedule a Demo
                            </button>
                        </div>
                        <p class="text-sm text-blue-100 mt-4">
                            No credit card required. 14-day free trial. Cancel anytime.
                        </p>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="w-full border-t bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm">
            <div class="container mx-auto flex flex-col gap-8 px-4 py-10 md:px-6 lg:py-16">
                <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-4">
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 font-bold">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-blue-400 flex items-center justify-center text-white">
                                S
                            </div>
                            <span>SaaSify</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Streamline your workflow with our all-in-one SaaS platform. Boost productivity and scale your business.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                                <span class="sr-only">Facebook</span>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                    <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                                </svg>
                                <span class="sr-only">Twitter</span>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    <rect width="4" height="12" x="2" y="9"></rect>
                                    <circle cx="4" cy="4" r="2"></circle>
                                </svg>
                                <span class="sr-only">LinkedIn</span>
                            </a>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-sm font-bold">Product</h4>
                        <ul class="space-y-2 text-sm">
                            <li>
                                <a href="#features" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Features
                                </a>
                            </li>
                            <li>
                                <a href="#pricing" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Pricing
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Integrations
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    API
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-sm font-bold">Resources</h4>
                        <ul class="space-y-2 text-sm">
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Documentation
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Guides
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Blog
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Support
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-sm font-bold">Company</h4>
                        <ul class="space-y-2 text-sm">
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Careers
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                                    Terms of Service
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col gap-4 sm:flex-row justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-8">
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                        &copy; 2024 SaaSify. All rights reserved.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="text-xs text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                            Privacy Policy
                        </a>
                        <a href="#" class="text-xs text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                            Terms of Service
                        </a>
                        <a href="#" class="text-xs text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors">
                            Cookie Policy
                        </a>
                    </div>
                </div>
            </div>
        </footer>

<?php
    }
}
