@php
    use \App\Types\MasterOptionsType;
    use \App\Models\ResourceFile;
    /**
    * @var $realEstate \App\Models\RealEstate
    */
@endphp
<x-import-library name="PhotoSwipe"/>
<x-guest-layout>
    <div class="sticky top-0 z-10 bg-bright-gray/80 p-4 text-center">
        <h4 class="lg:text-2xl text-xl  font-bold uppercase tracking-wider text-blue-green">CÓDIGO: #{{$realEstate->code}}</h4>
    </div>
    <section class="relative md:pb-24 pb-16 mt-4">
        <div class="md:flex pswp-gallery" id="gallery-real-estate">
            @if($realEstate->getImagePrimary(ResourceFile::IMG_SIZE_ORIGINAL))
                <div class="lg:w-1/2 md:w-1/2 p-1">
                    <div class="group relative overflow-hidden">
                        <a href="{{ $realEstate->getImagePrimary(ResourceFile::IMG_SIZE_ORIGINAL) }}"
                           data-pswp-width="2500"
                           data-pswp-height="1668"
                           target="_blank"
                           class="relative block rounded-lg overflow-hidden">
                            <img class="rounded-lg" src="{{ $realEstate->getImagePrimary(ResourceFile::IMG_SIZE_ORIGINAL) }}" alt="">
                            <div class="absolute inset-0 rounded-lg group-hover:bg-slate-900/70 duration-500 ease-in-out"></div>
                            <div class="absolute top-1/2 -translate-y-1/2 start-0 end-0 text-center invisible group-hover:visible">
                                <button class="prc-button prc-button-icon bg-green-600 hover:bg-green-700 text-white rounded-full lightbox">
                                    <i class="bi bi-camera"></i>
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            <div class="lg:w-1/2 md:w-1/2">

                <div class="grid grid-cols-3 gap-2">
                    @foreach($realEstate->getImages(ResourceFile::IMG_SIZE_ORIGINAL) as $k => $Image)
                        <div class="group relative overflow-hidden {{$k > 7 ? 'hidden' :''}}">
                            <a href="{{$Image}}"
                               data-pswp-width="2500"
                               data-pswp-height="1668"
                               class="relative block h-full">
                                <img class="object-cover rounded-lg" src="{{$Image}}" alt="">
                                <div class="absolute inset-0 rounded-lg group-hover:bg-slate-900/70 duration-500 ease-in-out"></div>
                                <div class="absolute top-1/2 -translate-y-1/2 start-0 end-0 text-center invisible group-hover:visible">
                                    <button class="prc-button prc-button-icon bg-green-600 hover:bg-green-700 text-white rounded-full lightbox">
                                        <i class="bi bi-camera"></i>
                                    </button>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!--
                <div class="flex">
                    <div class="w-1/2 p-1">
                        <div class="group relative overflow-hidden">
                            <a href="https://images.pexels.com/photos/534151/pexels-photo-534151.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                               data-pswp-width="2500"
                               data-pswp-height="1668"
                               class="relative block rounded-lg overflow-hidden">
                                <img class="rounded-lg" src="https://images.pexels.com/photos/534151/pexels-photo-534151.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                                <div class="absolute inset-0 rounded-lg group-hover:bg-slate-900/70 duration-500 ease-in-out"></div>
                                <div class="absolute top-1/2 -translate-y-1/2 start-0 end-0 text-center invisible group-hover:visible">
                                    <button class="prc-button prc-button-icon bg-green-600 hover:bg-green-700 text-white rounded-full lightbox">
                                        <i class="bi bi-camera"></i>
                                    </button>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="w-1/2 p-1">
                        <div class="group relative overflow-hidden">
                            <a href="https://images.pexels.com/photos/2343465/pexels-photo-2343465.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                               data-pswp-width="2500"
                               data-pswp-height="1668"
                               class="relative block rounded-lg overflow-hidden">
                                <img class="rounded-lg" src="https://images.pexels.com/photos/2343465/pexels-photo-2343465.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                                <div class="absolute inset-0 rounded-lg group-hover:bg-slate-900/70 duration-500 ease-in-out"></div>
                                <div class="absolute top-1/2 -translate-y-1/2 start-0 end-0 text-center invisible group-hover:visible">
                                    <button class="prc-button prc-button-icon bg-green-600 hover:bg-green-700 text-white rounded-full lightbox">
                                        <i class="bi bi-camera"></i>
                                    </button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/2 p-1">
                        <div class="group relative overflow-hidden">
                            <a href="https://images.pexels.com/photos/3288103/pexels-photo-3288103.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                               data-pswp-width="2500"
                               data-pswp-height="1668"
                               class="relative block rounded-lg overflow-hidden">
                                <img class="rounded-lg" src="https://images.pexels.com/photos/3288103/pexels-photo-3288103.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                                <div class="absolute inset-0 rounded-lg group-hover:bg-slate-900/70 duration-500 ease-in-out"></div>
                                <div class="absolute top-1/2 -translate-y-1/2 start-0 end-0 text-center invisible group-hover:visible">
                                    <button class="prc-button prc-button-icon bg-green-600 hover:bg-green-700 text-white rounded-full lightbox">
                                        <i class="bi bi-camera"></i>
                                    </button>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="w-1/2 p-1">
                        <div class="group relative overflow-hidden">
                            <a href="https://images.pexels.com/photos/3288100/pexels-photo-3288100.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                               data-pswp-width="2500"
                               data-pswp-height="1668"
                               class="relative block rounded-lg overflow-hidden">
                                <img class="rounded-lg" src="https://images.pexels.com/photos/3288100/pexels-photo-3288100.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                                <div class="absolute inset-0 rounded-lg group-hover:bg-slate-900/70 duration-500 ease-in-out"></div>
                                <div class="absolute top-1/2 -translate-y-1/2 start-0 end-0 text-center invisible group-hover:visible">
                                    <button class="prc-button prc-button-icon bg-green-600 hover:bg-green-700 text-white rounded-full lightbox">
                                        <i class="bi bi-camera"></i>
                                    </button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                -->

            </div>
        </div>
        <div class="container px-4 lg:px-10 mx-auto md:mt-24 mt-16">
            <div class="md:flex">
                <div class="lg:w-2/3 md:w-1/2 md:p-4 px-3">
                    <div class="flex items-center lg:me-6 me-4">
                        <svg class="lg:text-3xl text-2xl me-2 text-blue-green" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M21 6.5V14h-2V7.5L14 4L9 7.5V9H7V6.5l7-5zm-5.5.5h-1v1h1zm-2 0h-1v1h1zm2 2h-1v1h1zm-2 0h-1v1h1zm5.5 7h-2c0-1.2-.75-2.28-1.87-2.7L8.97 11H1v11h6v-1.44l7 1.94l8-2.5v-1c0-1.66-1.34-3-3-3M3 20v-7h2v7zm10.97.41L7 18.48V13h1.61l5.82 2.17c.34.13.57.46.57.83c0 0-1.99-.05-2.3-.15l-2.38-.79l-.63 1.9l2.38.79c.51.17 1.04.26 1.58.26H19c.39 0 .74.23.9.56z"/>
                        </svg>
                        <h4 class="text-2xl font-bold uppercase">
                            {{$Options[MasterOptionsType::TYPE_REAL_ESTATE->name][$realEstate->type_id]}}
                            en {{$Options[MasterOptionsType::TYPE_REAL_ESTATE_ACTION->name][$realEstate->action_id]}}
                        </h4>
                    </div>
                    @if($realEstate->location)
                        <div class="flex items-center lg:me-6 me-4 mt-6">
                            <svg class="lg:text-3xl text-2xl me-2 text-blue-green" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-width="2"
                                      d="M17.5 6.5L23 9v13l-7-3l-8 3l-7-3V6l5 2m10 11v-7M8 22V12m4 4.273S6 11.5 6 7c0-3.75 3-6 6-6s6 2.25 6 6c0 4.5-6 9.273-6 9.273ZM13 7a1 1 0 1 0-2 0a1 1 0 0 0 2 0Z"/>
                            </svg>
                            <h4 class="text-xl font-bold">
                                {{$realEstate->location->department_name}}, {{$realEstate->location->municipality_name}}
                            </h4>
                        </div>
                    @endif
                    <div class="flex items-center lg:me-6 me-4 mt-2">
                        <svg class="lg:text-3xl text-2xl me-2 text-blue-green" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 100 100">
                            <path fill="currentColor"
                                  d="M50.001 0C33.65 0 20.25 13.36 20.25 29.666c0 6.318 2.018 12.19 5.433 17.016L46.37 82.445c2.897 3.785 4.823 3.066 7.232-.2l22.818-38.83c.46-.834.822-1.722 1.137-2.629a29.28 29.28 0 0 0 2.192-11.12C79.75 13.36 66.354 0 50.001 0m0 13.9c8.806 0 15.808 6.986 15.808 15.766c0 8.78-7.002 15.763-15.808 15.763c-8.805 0-15.81-6.982-15.81-15.763c0-8.78 7.005-15.765 15.81-15.765"/>
                            <path fill="currentColor"
                                  d="m68.913 48.908l-.048.126c.015-.038.027-.077.042-.115zM34.006 69.057C19.88 71.053 10 75.828 10 82.857C10 92.325 26.508 100 50 100s40-7.675 40-17.143c0-7.029-9.879-11.804-24.004-13.8l-1.957 3.332C74.685 73.866 82 76.97 82 80.572c0 5.05-14.327 9.143-32 9.143c-17.673 0-32-4.093-32-9.143c-.001-3.59 7.266-6.691 17.945-8.174c-.645-1.114-1.294-2.226-1.94-3.341"
                                  color="currentColor"/>
                        </svg>
                        <h4 class="text-xl font-medium">{{$realEstate->address}}</h4>
                    </div>
                    <ul class="py-8 flex items-center list-none">
                        @if($realEstate->total_area)
                            <li class="flex items-center lg:me-6 me-4">
                                <svg class="lg:text-3xl text-2xl me-2 text-blue-green" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                    <path fill="currentColor"
                                          d="M28 2H4c-1.1 0-2 .9-2 2v24c0 1.1.9 2 2 2h15v-2c0-2.8 2.2-5 5-5v-2c-3.9 0-7 3.1-7 7h-3v-4h-2v4H4V4h8v14h2v-5h4v-2h-4V4h14v7h-4v2h4v15h-4v2h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2"/>
                                </svg>
                                <span class="lg:text-xl">{{$realEstate->total_area}}</span>
                            </li>
                        @endif

                        @if($realEstate->bedrooms)
                            <li class="flex items-center lg:me-6 me-4">
                                <svg class="lg:text-3xl text-2xl me-2 text-blue-green" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M7 12.5a3 3 0 1 0-3-3a3 3 0 0 0 3 3m0-4a1 1 0 1 1-1 1a1 1 0 0 1 1-1m13-2h-8a1 1 0 0 0-1 1v6H3v-8a1 1 0 0 0-2 0v13a1 1 0 0 0 2 0v-3h18v3a1 1 0 0 0 2 0v-9a3 3 0 0 0-3-3m1 7h-8v-5h7a1 1 0 0 1 1 1Z"/>
                                </svg>
                                <span class="lg:text-xl">{{$realEstate->bedrooms}} Habitaciones</span>
                            </li>
                        @endif
                        @if($realEstate->bathrooms)
                            <li class="flex items-center">
                                <svg class="lg:text-3xl text-2xl me-2 text-blue-green" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M22 12H5V6.41a1.975 1.975 0 0 1 1.04-1.759a1.995 1.995 0 0 1 1.148-.23a3.491 3.491 0 0 0 .837 3.554l1.06 1.06a1 1 0 0 0 1.415 0L14.035 5.5a1 1 0 0 0 0-1.414l-1.06-1.06a3.494 3.494 0 0 0-4.53-.343A3.992 3.992 0 0 0 3 6.41V12H2a1 1 0 0 0 0 2h1v3a2.995 2.995 0 0 0 2 2.816V21a1 1 0 0 0 2 0v-1h10v1a1 1 0 0 0 2 0v-1.184A2.995 2.995 0 0 0 21 17v-3h1a1 1 0 0 0 0-2M9.44 4.44a1.502 1.502 0 0 1 2.12 0l.354.353l-2.121 2.121l-.354-.353a1.501 1.501 0 0 1 0-2.122ZM19 17a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-3h14Z"/>
                                </svg>
                                <span class="lg:text-xl">{{$realEstate->bathrooms}} Baños</span>
                            </li>
                        @endif
                    </ul>
                    <p class="text-slate-400">{{$realEstate->description}}</p>
                    <ul class="mt-4 text-left text-gray-500">
                        @foreach($realEstate->getSpecificationsDetail() as $specification)
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                </svg>
                                <span>{{$specification->value}}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="w-full leading-[0] border-0 mt-6">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39206.002432144705!2d-95.4973981212445!3d29.709510002925988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c16de81f3ca5%3A0xf43e0b60ae539ac9!2sGerald+D.+Hines+Waterwall+Park!5e0!3m2!1sen!2sin!4v1566305861440!5m2!1sen!2sin"
                                style="border:0" class="w-full h-[500px]" allowfullscreen=""></iframe>
                    </div>
                </div>
                <div class="lg:w-1/3 md:w-1/2 md:p-4 px-3 mt-8 md:mt-0">
                    <div class="sticky top-20">
                        <div class="rounded-md bg-slate-50 shadow">
                            <div class="p-6">
                                <h5 class="text-center text-2xl font-bold">PRECIO</h5>
                                @if($realEstate->sale_value)
                                    <div class="flex justify-between items-center mt-4">
                                        <span class="text-xl font-medium">{{$realEstate->sale_value}}</span>
                                        <span class="bg-green-600/10 text-green-600 font-medium text-sm px-2.5 py-0.75 rounded h-6">Valor renta</span>
                                    </div>
                                @endif
                                @if($realEstate->rental_value)
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-xl font-medium">{{ formatMoney($realEstate->rental_value) }}</span>
                                        <span class="bg-blue-600/10 text-blue-600 font-medium text-sm px-2.5 py-0.75 rounded h-6">Valor arriendo</span>
                                    </div>
                                @endif
                                @if($realEstate->administration)
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-xl font-medium">{{$realEstate->administration}}</span>
                                        <span class="bg-red-600/10 text-red-600 font-medium text-sm px-2.5 py-0.75 rounded h-6">Valor administración</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mt-32 bg-white relative shadow rounded-lg mx-auto">
                            <div class="flex justify-center">
                                <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt=""
                                     class="object-cover rounded-full mx-auto absolute -top-20 w-32 h-32 shadow-md border-4 border-white transition duration-200 transform hover:scale-110">
                            </div>
                            <div class="mt-16">
                                <h1 class="font-bold text-center text-3xl text-gray-900">Jader Diaz</h1>
                                <p class="text-center text-sm text-gray-400 font-medium">Agente</p>
                                <div class="w-full flex flex-col items-center overflow-hidden text-sm mt-6">
                                    <div class="flex flex-row gap-4 items-center w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 hover:bg-gray-100 transition duration-150"
                                         target="_blank">
                                        <i class="bi bi-envelope text-blue-green text-xl"></i>
                                        <span>ejemplo@primercontacto.com</span>
                                    </div>

                                    <div class="flex flex-row gap-4 items-center w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 hover:bg-gray-100 transition duration-150"
                                         target="_blank">
                                        <i class="bi bi-telephone text-blue-green text-xl"></i>
                                        <span>+57 6044482233</span>
                                    </div>

                                    <div class="flex flex-row gap-4 items-center w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 hover:bg-gray-100 transition duration-150"
                                         target="_blank">
                                        <i class="bi bi-phone text-blue-green text-xl"></i>
                                        <span>+57 3164520474</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{--                        <div class="rounded-md bg-slate-50 mt-6 shadow">--}}
                        {{--                            <div class="p-6">--}}
                        {{--                                <h5 class="text-center text-2xl font-bold">AGENTE</h5>--}}
                        {{--                                <div class="w-48 h-48 mx-auto mt-4">--}}
                        {{--                                    <img class="object-cover rounded-full w-full h-full" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Agente">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="mt-12 text-center">
                            <h3 class="mb-6 text-xl leading-normal font-medium text-black">¿Tiene alguna pregunta? ¡Pongase en contacto con nosotros!</h3>
                            <div class="mt-6">
                                <a href="#" class="p-2 bg-transparent hover:bg-blue-green border border-blue-green text-blue-green hover:text-white rounded-md"><i
                                            class="bi bi-telephone-inbound align-middle me-2"></i> Contáctenos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
