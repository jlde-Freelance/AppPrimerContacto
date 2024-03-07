@php
    use \App\Types\MasterOptionsType;
@endphp
<x-import-library name="Select2"/>
<form method="POST" action="{{route('residential-units.store', $model ?? null)}}">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:col-span-2">

            <x-forms.input-group name="name" :label="ucfirst(__('validation.attributes.name'))" maxlength="100"
                                 value="{{ isset($model) ? $model->name : '' }}"
                                 autofocus required/>

            <x-forms.input-group name="address" :label="ucfirst(__('validation.attributes.address'))" maxlength="200"
                                 value="{{ isset($model) ? $model->address : '' }}" />

            <x-forms.input-group name="year_built" :label="ucfirst(__('validation.attributes.year_built'))"
                                 value="{{ isset($model) ? $model->year_built : '' }}"
                                 maxlength="10"/>

            <x-forms.input-group type="select" name="stratum_id"
                                 :label="ucfirst(__('validation.attributes.stratum'))"
                                 value="{{ isset($model) ? $model->stratum_id : '' }}"
                                 :options="$Options[MasterOptionsType::TYPE_STRATUM->name]"/>

            <x-forms.input-group type="select" name="status" required
                                 :label="ucfirst(__('validation.attributes.status'))"
                                 data-allow-clear="false"
                                 value="{{ isset($model) ? $model->status : '1' }}"
                                 :options="[1=>'Activo',0 =>'Inactivo']"/>

            <div class="md:col-span-2 py-2">
                <x-forms.input-group type="select" name="specifications[]"
                                     :label="ucfirst(__('validation.attributes.specifications'))"
                                     :value="isset($model) ? $model->specifications : []"
                                     :multiple="true"
                                     :options="$Options[MasterOptionsType::TYPE_SPECIFICATIONS->name]->toArray()"/>
            </div>

            <x-forms.input-error class="md:col-span-2 py-2" :messages="$errors->get('default')"/>

            <div class="prc-input-group mt-3 flex flex-col md:flex-row gap-3 md:col-span-2">
                <x-button>
                    <i class="bi bi-save"></i>
                    @if(isset($model)) Actualizar @else Registrar @endif Unidad
                </x-button>
                <x-button secondary link href="{{route('residential-units.index')}}">
                    <i class="bi bi-arrow-left-short"></i>
                    Regresar
                </x-button>
            </div>

        </div>

    </div>

</form>