<div>
    <flux:heading size="xl" level="1">Log Index</flux:heading>
    <flux:text class="mb-6 mt-2 text-base">Browse recent system and activity logs.</flux:text>
    <flux:separator variant="subtle" />

    <div class="mt-6 overflow-x-auto">
       <flux:table :paginate="$logs">
            <flux:table.columns>
                <flux:table.column>ID </flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'domain'" :direction="$sortDirection" wire:click="sort('domain')">Domain</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'status'" :direction="$sortDirection" wire:click="sort('status')">Status</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'updated_at'" :direction="$sortDirection" wire:click="sort('updated_at')">Updated At</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'update_count'" :direction="$sortDirection" wire:click="sort('update_count')">Update Count</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
            @foreach($logs as $log)
                <flux:table.row :key="$log->id">
                    <flux:table.cell>
                        {{ $log->id }}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $log->domain }}
                    </flux:table.cell>
                    <flux:table.cell>
                         <flux:badge size="sm" inset="top bottom">{{ $log->status }}</flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $log->updated_at?->format('Y-m-d H:i') }}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $log->update_count }}
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
</div>
