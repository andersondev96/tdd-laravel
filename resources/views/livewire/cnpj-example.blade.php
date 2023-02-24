<div>
    <x-input wire:model="cnpj" />
    @error('cnpj')
        <div class="error">{{ $message }}</div>
    @enderror
    <x-error name="cnpj" />
</div>
