<x-layouts.auth>
    <div class="flex flex-col gap-8">
        <x-auth-header :title="__('Welcome Back')" :description="__('Sign in to access your admin dashboard')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('Email address') }}
                </label>
                <input
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="you@example.com"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                />
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="mb-2 flex items-center justify-between">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                        {{ __('Password') }}
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300" wire:navigate>
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>
                <input
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="{{ __('Enter your password') }}"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                />
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center gap-2">
                <input
                    type="checkbox"
                    name="remember"
                    id="remember"
                    {{ old('remember') ? 'checked' : '' }}
                    class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800"
                />
                <label for="remember" class="text-sm text-slate-600 dark:text-slate-400">
                    {{ __('Remember me') }}
                </label>
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                data-test="login-button"
            >
                {{ __('Sign In') }}
            </button>
        </form>

        @if (Route::has('register'))
            <div class="text-center text-sm text-slate-600 dark:text-slate-400">
                <span>{{ __('Don\'t have an account?') }}</span>
                <a href="{{ route('register') }}" class="ml-1 font-medium text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300" wire:navigate>
                    {{ __('Sign up') }}
                </a>
            </div>
        @endif
    </div>
</x-layouts.auth>
