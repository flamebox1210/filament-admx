<div>
    @if($page->template == 'home')
        <livewire:components.template.home :page="$page"/>
    @elseif($page->template == 'flexy')
        <livewire:components.template.flexy :page="$page"/>
    @elseif($page->template == 'articles')
        <livewire:components.template.articles :page="$page"/>
    @endif
</div>
