<x-guest-layout class="grid place-content-center h-screen">
    <x-card class="sm:p-4 md:p-12">

        <div class="content-img flex justify-center">
            <x-logo-black class="max-w-[70%]"/>
        </div>

        <h1 class="text-xl text-center my-5 md:mb-8 ">{{__('Registre su cuenta')}}</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <x-forms.input-group name="name"
                                 :label="ucfirst(__('validation.attributes.name'))"
                                 placeholder="{{__('validation.attributes.name')}}"
                                 required autofocus autocomplete="name"/>

            <x-forms.input-group name="email"
                                 :label="ucfirst(__('validation.attributes.email'))"
                                 placeholder="email@example.com"
                                 required autocomplete="email"/>

            <x-forms.input-group name="phone"
                                 :label="ucfirst(__('validation.attributes.phone'))"
                                 placeholder="(+xx) xxx xxx xx xx"
                                 autocomplete="phone"/>

            <x-forms.input-group name="password"
                                 :label="ucfirst(__('validation.attributes.password'))"
                                 type="password"
                                 placeholder="********"
                                 required/>

            <x-forms.input-group name="password_confirmation"
                                 :label="ucfirst(__('validation.attributes.password_confirmation'))"
                                 type="password"
                                 class="md:min-w-[200px]"
                                 placeholder="********"
                                 required/>

            <x-forms.input-error :messages="$errors->get('default')" class="mt-2" />

            <x-button class="w-full mt-5">{{ __('Registrarse') }}</x-button>

            <div class="mt-3">
                ¿Ya tienes una cuenta?
                <x-link href="{{ route('login') }}" class="text-vegas-gold font-bold">{{ __('Iniciar sesión') }}</x-link>
            </div>

        </form>

    </x-card>
</x-guest-layout>

{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}

{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Name')" />--}}
{{--            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
