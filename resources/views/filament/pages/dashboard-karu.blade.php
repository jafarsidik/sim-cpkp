<x-filament-panels::page>
    <form wire:submit.prevent="submit">
            {{ $this->form }}
          
        </form>
       
        <div class="mt-8">
            {{ $this->table }}
        </div>

        
</x-filament-panels::page>
