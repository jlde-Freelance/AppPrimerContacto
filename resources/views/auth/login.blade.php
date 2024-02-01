<x-guest-layout class="grid place-content-center h-screen">
    <x-card class="sm:p-4 md:p-12">
        <div class="content-img flex justify-center">
            <x-logo-black class="max-w-[70%]"/>
        </div>
        <h1 class="text-xl text-center my-5 md:mb-8 ">{{__('Sign in to your account')}}</h1>
        <form method="POST">
            @csrf

            <!-- Email Address -->
            <div class="prc-input-group">
                <x-forms.input-label for="email" :value="ucfirst(__('validation.attributes.username'))"/>
                <x-forms.input-text id="email" name="email" class="md:min-w-[300px]" required autofocus autocomplete="email" value="admin@primercontacto.co" />
                <x-forms.input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="prc-input-group">
                <x-forms.input-label for="password" :value="ucfirst(__('validation.attributes.password'))"/>
                <x-forms.input-text type="password" id="password" name="password"  class="md:min-w-[300px]" required value="PrimerContacto2023.*" />
                <x-forms.input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div class="content-remember-me flex justify-between my-5">
                <x-forms.checkbox name="remember_me" value="1">{{ __('Remember me') }}</x-forms.checkbox>
                {{--@if (Route::has('password.request'))--}}
                {{--    <x-link href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</x-link>--}}
                {{--@endif--}}
            </div>
            <x-button class="w-full">{{ __('Login') }}</x-button>
            <div class="mt-3">
                {{ __('You do not have an account?') }}
                <x-link href="{{ route('register') }}" class="text-vegas-gold font-bold">{{ __('Register') }}</x-link>
            </div>

        </form>
    </x-card>
</x-guest-layout>
