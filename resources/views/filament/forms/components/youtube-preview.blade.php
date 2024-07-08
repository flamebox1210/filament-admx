<div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }" class="grid gap-y-2">
    <iframe class="w-full aspect-video rounded-lg overflow-hidden" :src="state.replace('/watch?v=','/embed/')"></iframe>
</div>
