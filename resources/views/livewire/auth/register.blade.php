<x-layouts.auth>
    <div class="flex flex-col gap-8">
        <x-auth-header :title="__('Create Account')" :description="__('Enter your details to create your account')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Name -->
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('Full Name') }}
                </label>
                <input
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="{{ __('John Doe') }}"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                />
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('Email Address') }}
                </label>
                <input
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
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
                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('Password') }}
                </label>
                <input
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('Create a password') }}"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                />
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('Confirm Password') }}
                </label>
                <input
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('Confirm your password') }}"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-all duration-200 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"
                />
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                data-test="register-user-button"
            >
                {{ __('Create Account') }}
            </button>
        </form>

        <div class="text-center text-sm text-slate-600 dark:text-slate-400">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{ route('login') }}" class="ml-1 font-medium text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300" wire:navigate>
                {{ __('Sign in') }}
            </a>
        </div>
    </div>
</x-layouts.auth>
